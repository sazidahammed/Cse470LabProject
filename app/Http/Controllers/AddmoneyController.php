<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Addmoney;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
// session_start();
class AddmoneyController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
       $user_company = Auth::user()->company;
       //$user_company = $_SESSION["company"];
        //  $users = User::where('company' ,'==',$user_company)->get()->toArray();
        $users = User::all()->where('company' ,'==',$user_company);
        //$users = Select * From Users Where company = $user_company;
        //    print_r($users);
        $mambers = Addmoney::all()->where('company' ,'==',$user_company);
        //$mambers = Select * From Addmoney Where company = $user_company;
        // print_r($mambers);
        $categories = Addmoney::groupBy('user_id')->pluck('user_id');
        //$categories = Select * From Addmoney Group By user_id;
        $now = Carbon::now();
        $monthnumber = $now->format('m');
       return view('admin.addmoney.index',compact('users','mambers','categories','user_company','monthnumber'));

    }
    function insert(Request $request){
        print_r($request->all());
        Addmoney::insert([
            'user_id'=>$request->user_id,
            'company'=>Auth::user()->company,
            'amount'=>$request->amount,
            'month'=>$request->month,
            'created_at'=>Carbon::now(),
        ]);
        return back()->with('success','Add money successfully Done!!');
    }
}


// if(isset($request["user_id"]) &&  isset($_SESSION["company"]) && isset($request['amount']) && isset($request['month'])){
        // 	// write the query to check if this username and password exists in our database
        //  $id = $request['user_id'],
        // 	$company = $_SESSION["company"];
        // 	$amount = $request['amount'];
        // 	$month = $request['month'];
        // 	$created_at = Carbon::now();

        // 	$sql = " INSERT INTO User VALUES('$id','$company', '$amount', '$month','$created_at' ) ";

        // 	//Execute the query
        // 	$result = mysqli_query($conn, $sql);

        // 	//check if this insertion is happening in the database


        // }
