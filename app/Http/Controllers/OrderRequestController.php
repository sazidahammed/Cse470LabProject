<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrderRequest;
use App\Models\Package;
use App\Models\User;
use Carbon\Carbon;
use App\Mail\SendMailCustomer;
use App\Mail\SendMailManager;
use Mail;
// session_start();
class OrderRequestController extends Controller
{
    //
    public function index($package_id){
        return view('admin.frontend.order',compact('package_id'));
    }

    function insert(Request $request){
        OrderRequest::insert([
            'package_id'=>$request->package_id,
            'customer_name'=>$request->customer_name,
            'customer_email'=>$request->customer_email,
            'customer_phone'=>$request->customer_phone,
            'location'=>$request->customer_location,
            'created_at'=>Carbon::now(),
        ]);

        // $sql="Insert INTO Request (package_id,customer_name, customer_email, customer_phone,location,created_at)
       // values ($request->package_id,$request-> customer_name, $request->customer_email, $request->customer_phone, $request->customer_location, Carbon :: now ())";
      //Execute the query
     // mysqli_query($conn, $sql);
        $packages = Package::all();
        // $packages = SELECT * FROM Package;
        $data = array(
            'name'   =>   $request->customer_name,
            // 'Password'   =>   $request->customer_name,
            // 'Role'   =>   $request->customer_phone,
        );
        Mail::to($request->customer_email)->send(new SendMailCustomer($data));

        $order_company = Package::find($request->package_id)->company;
        // $sql = "Select company from Package where $request->package_id == $package_id";
        // $order_company =  mysqli_query($conn, $sql);
        $managermail = User::all()->where('company','==',$order_company)->where('role','==', 22);
        // $sql =  "SELECT managermail FROM User WHERE 'company' == $order_company AND 'role' == '22'";
        // $managermail =  mysqli_query($conn, $sql);
        foreach ($managermail as  $value) {
            $data = array(
                'Name'   =>   $request->customer_name,
                'Email'   =>   $request->customer_email,
                'Phone'   =>   $request->customer_phone,
                'Address'   =>   $request->customer_location,
            );
            Mail::to($value->email)->send(new SendMailManager($data));
        }

        // $data = array(
        //     'name'   =>   $request['name'],
        //     'email'   =>   $request['email'],
        //     'Phone'   =>   $request['Phone'],
         //     'Address'   =>   $request['Address'],
        // );
        // Mail::to($request->email)->send(new SendMail($data));


        return view('admin.frontend.index',compact('packages'))->with('success','Request successfully Done!!');


    }
}
