<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Addmoney;
use App\Models\Addmeal;
use App\Models\Package;
use App\Models\User_Purchase_Package;
use App\Models\UserAddMeal;
use App\Models\OrderRequest;
use Auth;
use Carbon\Carbon;
use App\Mail\SendMail;
use Mail;
class HomeController extends Controller

// session_start();

{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user_id = Auth::id();
        //$user_id = $_SESSION["user_id"];
        $user_company = Auth::user()->company;
        //$user_company = $_SESSION["company"];
        // $users = User::where('id' ,'!=',$user_id)->orderBy('created_at','desc')->paginate(2);
        $users = User::orderBy('created_at','desc')->simplePaginate(3);
        //$users = Select * From Users order by created_at desc;
        $total_user = User::all()->count();
        //$total_user = Select count(*) From Users;
        $total_company = User::groupBy('company')->pluck('company')->count();
        //$total_company = Select count('id') From Users Group By company;
        $usersbym = User::all()->where('company' ,'==',$user_company);
        //$usersbym = Select * From Users Where company = $user_company;
        $total_userbym = User::all()->where('company' ,'==',$user_company)->count();
        //$total_userbym = Select count('id') From Users Where company = $user_company;
        $logged_user = Auth::user()->name;
        //$logged_user = $_SESSION["name"];
        $general_user = Addmoney::all()->where('user_id' ,'==',$user_id);
        //$general_user = Select * From Addmoneys Where user_id = $user_id;
        $date = Carbon::now();
        $month = Carbon::now()->month;
        $monthName = $date->format('F');
        $order_requests = OrderRequest::all();
        //order_requests = Select * From OrderRequest ;
        $our_package = Package::all()->where('company','==',$user_company);
        //$our_package = Select * From Packages Where company = $user_company;
        return view('home',compact('users','date','monthName','our_package','month','usersbym','total_user','total_userbym','logged_user','user_company','general_user','total_company','order_requests'));
    }

    function insertbymanager(Request $request){
        print_r($request->all());
        $user_id = User::insertGetId([
            'company'=>(Auth::user()->company),
            'name'=>$request->name,
             'email'=>$request->email,
             'phone'=>$request->phone,
             'password'=>bcrypt($request->password),
             'role'=>$request->role,
             'type'=>Auth::user()->type,
             'created_at'=>Carbon::now(),
        ]);

        // if(isset($_SESSION["user_id"]) &&  isset($_SESSION["company"]) && isset($request['name']) && isset($request['email']) && isset($request['phone'])&& isset($request['password']) && isset($request['role']) && isset($request['type'])){
        // 	// write the query to check if this username and password exists in our database
        //  $id = $_SESSION["user_id"],
        // 	$company = $_SESSION["company"];
        // 	$name = $request['name'];
        // 	$email = $request['email'];
        // 	$phone = $request['phone'];
        // 	$password = $request['password];
        // 	$role = $request['role'];
        // 	$type = $request['type'];
        // 	$created_at = Carbon::now();

        // 	$sql = " INSERT INTO User VALUES('$id','$company', '$name', '$email', '$phone', '$password', '$role', '$type','$created_a' ) ";

        // 	//Execute the query
        // 	$result = mysqli_query($conn, $sql);

        // 	//check if this insertion is happening in the database


        // }

        if(Auth::user()->type == 91){
            User_Purchase_Package::insert([
                'user_id'=>$user_id,
                'company'=>Auth::user()->company,
                'package_id'=>$request->package_id,
                'created_at'=>Carbon::now(),
            ]);
        }
        //if($_SESSION["type"] == 91 ){
            // if(isset($_SESSION["user_id"]) &&  isset($_SESSION["company"]) && isset($request['package_id'])){
            // 	// write the query to check if this username and password exists in our database
            //  $id = $_SESSION["user_id"],
            // 	$company = $_SESSION["company"];
            // 	$'package_id = $request['package_id'];
            // 	$created_at = Carbon::now();

            // 	$sql = " INSERT INTO User_Purchase_Package VALUES('$id','$company', '$'package_id','$created_a' ) ";

        //}
        $data = array(
            'Mail'   =>   $request->email,
            'Password'   =>   $request->password,
            'Role'   =>   $request->role,
        );
        Mail::to($request->email)->send(new SendMail($data));
        return back();

        // $data = array(
        //     'Mail'   =>   $request['email'],
        //     'Password'   =>   $request['password'],
        //     'Role'   =>   $request['role'],
        // );
        // Mail::to($request->email)->send(new SendMail($data));



    }
    function delete($user_id){
        User::find($user_id)->forceDelete();
        $user_company = Auth::user()->company;
        $delete_addmoney = Addmoney::all()->where('user_id','==',$user_id)->where('company','==',$user_company);
        foreach($delete_addmoney as $value){
            Addmoney::find($value->id)->forceDelete();
        }
        $delete_addmeal = Addmeal::all()->where('user_id','==',$user_id)->where('company','==',$user_company);
        foreach($delete_addmeal as $value){
            Addmeal::find($value->id)->forceDelete();
        }
        $delete_userpackage = User_Purchase_Package::all()->where('user_id','==',$user_id)->where('company','==',$user_company);
        foreach($delete_userpackage as $value){
            User_Purchase_Package::find($value->id)->forceDelete();
        }
        $delete_useraddmeal = UserAddMeal::all()->where('user_id','==',$user_id)->where('company','==',$user_company);
        foreach($delete_useraddmeal as $value){
            UserAddMeal::find($value->id)->forceDelete();
        }
        return back()->with('delsuccess','User delete successfully Done!');
    }
    //$delete = "Delete From Users Where id = $user_id";
    //$delete_addmoney = Select * From Addmoney Where company = $user_company and id = $user_id;
    // foreach($delete_addmoney as $value){
    //     Delete From Addmoney Where id = $value['id'];
    // }
    //$delete_addmeal = Select * From Addmeal Where company = $user_company and id = $user_id;
    // foreach($delete_addmeal as $value){
    //     Delete From Addmeal Where id = $value['id'];
    // }
    //$delete_userpackage = Select * From User_Purchase_Package Where company = $user_company and id = $user_id;
    // foreach($delete_userpackage as $value){
    //     Delete From User_Purchase_Package Where id = $value['id'];
    // }
    //$delete_userpackage = Select * From User_Purchase_Package Where company = $user_company and id = $user_id;
    // foreach($delete_userpackage as $value){
    //     Delete From User_Purchase_Package Where id = $value['id'];
    // }

    function requestdelete($request_id){
        OrderRequest::find($request_id)->forceDelete();
        return back()->with('requestdelsuccess','Request delete successfully Done!');
    }
    //$delete = "Delete From OrderRequest Where id = $request_id";


    function insertbyadmin(Request $request){
        User::insert([
            'company'=>$request->company,
            'name'=>$request->name,
             'email'=>$request->email,
             'phone'=>$request->phone,
             'password'=>bcrypt($request->password),
             'role'=>$request->role,
             'type'=>$request->type,
             'created_at'=>Carbon::now(),
        ]);
        return back();

    }
        // if(isset($request['company']) && isset($request['name']) && isset($request['email']) && isset($request['phone'])&& isset($request['password']) && isset($request['role']) && isset($request['type'])){
        // 	// write the query to check if this username and password exists in our database
        // $company = $request['company'];
        // 	$name = $request['name'];
        // 	$email = $request['email'];
        // 	$phone = $request['phone'];
        // 	$password = $request['password];
        // 	$role = $request['role'];
        // 	$type = $request['type'];
        // 	$created_at = Carbon::now();

        // 	$sql = " INSERT INTO User VALUES('$company', '$name', '$email', '$phone', '$password', '$role', '$type','$created_a' ) ";

        // 	//Execute the query
        // 	$result = mysqli_query($conn, $sql);

        // 	//check if this insertion is happening in the database


        // }


    // function insertbymanager(Request $request){
    //     $sazid = User::all()->where('id',$user_id);
    //     Mail::to(User::find($user_id)->email)->send(new SendMail($sazid));
    //     return back()->with('checkmail','Please Check Your Mail.');
    // }
    // function mailsend($user_id){
    //     $sazid = User::all()->where('id',$user_id);
    //     Mail::to(User::find($user_id)->email)->send(new SendMail($sazid));
    //     return back()->with('checkmail','Please Check Your Mail.');
    // }



}
