<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Package;
use App\Models\Addmeal;
use App\Models\OrderRequest;
use App\Models\User_Purchase_Package;
use Auth;
use Image;
// session_start();

class PackageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        $user_company = Auth::user()->company;
        //$user_company = $_SESSION["company"];
        $packages = Package::all()->where('company' ,'==',$user_company);
        // $packages = Select * From Package where company = $user_company;
        $now = Carbon::now();
        $monthnumber = $now->format('m');
        // $date =  Carbon::now()->format('d-m-Y');

        return view('admin.package.index',compact('packages','monthnumber'));
    }

    function insert(Request $request){
        $package_id = Package::insertGetId([
            'user_id'=>Auth::user()->id,
            'company'=>Auth::user()->company,
            'package_name'=>$request->package_name,
            'package_des'=>$request->package_des,
            'package_price'=>$request->package_price,
            'month'=>$request->month,
            'created_at'=>Carbon::now(),
        ]);

        // if(isset($_SESSION["package_id"]) && isset($_SESSION["user_id"]) && isset($_SESSION["company"] && isset($request["package_name"]) && isset($request['package_des']) && isset($request['package_price']) && isset($request['month'])){
            // //
            // $id = $_SESSION["user_id"]
            // $company = $_SESSION["company"];
            // $package_name = $request['package_name'];
            // $package_des = $request['package_des'];
            // $package_price = $request['package_price'];
            // $month = $request['month'];
            // $created_at = Carbon::now();

        $new_package_img = $request ->package_img;
        // $new_package_img = $request["package_img"];
        $extension = $new_package_img->getClientOriginalExtension();
        $new_package_name = $package_id.'.'.$extension;
        Image::make($new_package_img)->save(base_path('public/uploads/package/'.$new_package_name));

        package::find($package_id)->update([
            'package_img'=>$new_package_name,
        ]);

        return back()->with('success','Add Package successfully Done!!');
    }

    function packagedelete($package_id){
        Package::find($package_id)->forceDelete();
        $user_company = Auth::user()->company;
        $delete_user_package = User_Purchase_Package::all()->where('package_id','==',$package_id)->where('company','==',$user_company);
        foreach($delete_user_package as $value){
            User_Purchase_Package::find($value->id)->forceDelete();
        }
        $delete_addmeal = Addmeal::all()->where('package_id','==',$package_id)->where('company','==',$user_company);
        foreach($delete_addmeal as $value){
            Addmeal::find($value->id)->forceDelete();
        }
        $delete_orderrequest = OrderRequest::all()->where('package_id','==',$package_id);
        foreach($delete_orderrequest as $value){
            OrderRequest::find($value->id)->forceDelete();
        }


       // $packagedelete = "Delete from user id = $package_id";
       // $delete_user_package = Select * from User_Purchase_Package where company = $user_company and id = $package_id;
       // foreach($delete_package as $value){
       // Delete from Package where id = $value['id'];
       // }
       // $delete_addmeal = Select * From Addmeal Where company = $user_company and id = $user_id;
       // foreach($delete_addmeal as $value){
       //     Delete From Addmeal Where id = $value['id'];
       // }

        return back()->with('delsuccess','User delete successfully Done!');
    }
}
