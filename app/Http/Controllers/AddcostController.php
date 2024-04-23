<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Addcost;
use App\Models\Addmeal;
use App\Models\Addmoney;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
// session_start();
class AddcostController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){

        $month = Carbon::now()->month;
        $monthName = Carbon::now()->format('F');
        $monthnumber = Carbon::now()->format('m');
        $user_company = Auth::user()->company;
        $date =  Carbon::now()->subDay()->format('d-m-Y');
        //$user_company = $_SESSION["company"];
        $members = User::all()->where('company' ,'==',$user_company);
        //$members = Select * From Users Where company = $user_company;
        // $now = Carbon::now();
        $total_lunch = Addmeal::all()->where('company' ,'==',$user_company)->sum('lunch');
        //$total_lunch = Select SUM('lunch') From Addmeal Where company = $user_company;
        $total_dinner = Addmeal::all()->where('company' ,'==',$user_company)->sum('dinner');
        //$total_dinner = Select SUM('dinner') From Addmeal Where company = $user_company;
        $total_meal = $total_lunch + $total_dinner;
        $today_lunch = Addmeal::all()->where('company' ,'==',$user_company)->where('date' ,'==',$date)->sum('lunch');
        //$today_lunch = Select SUM('lunch') From Addmeal Where date = $date and company = $user_company;
        $today_dinner = Addmeal::all()->where('company' ,'==',$user_company)->where('date' ,'==',$date)->sum('dinner');
        //$today_dinner = Select SUM('dinner') From Addmeal Where date = $date and company = $user_company;
        $today_meal = $today_lunch + $today_dinner;
        $total_money=Addmoney::all()->where('company' ,'==',$user_company)->sum('amount');
        $cost=Addcost::all()->where('company' ,'==',$user_company)->sum('dailycost');
        $rest_money=Addmoney::all()->where('company' ,'==',$user_company)->sum('amount') - Addcost::all()->where('company' ,'==',$user_company)->sum('dailycost');
        $meal_round = Addcost::all()->where('company' ,'==',$user_company)->sum('dailycost')/$total_meal;
        $meal_rate = round($meal_round, 2);


        $date_check_array=[];
        $costs_array=[];
        $db_dates_array=[];
        $marketby_name_array=[];
        
        for ($x = 01; $x <=30 ; $x++){
            if($x < 10){
                $date_check = "0".$x."-".$monthnumber."-".now()->year;
            }else{
                $date_check = $x."-".$monthnumber."-".now()->year;
            }
            

            array_push($date_check_array,$date_check);

            $db_dates = Addcost::all()->where('user_id' ,'==',Auth::user()->id)->where('date', "==", $date_check)->where('company', "==", Auth::user()->company);
            array_push($db_dates_array,$db_dates);

            $costs = Addcost::all()->where('month', '!=',$monthnumber);
            array_push($costs_array,$costs);

            $loop_ran=False;
            foreach ($db_dates as $db_date){
                if ($date_check == $db_date->date){
                    $loop_ran=True;
                    $marketby_name=User::find($db_date->marketby)->name;

                    array_push($marketby_name_array,$marketby_name);
                }
                

            }
            if ($loop_ran==False){
                array_push($marketby_name_array,'Select Member');
            }
        
                
            

        }
        

  
        return view('admin.addcost.index',compact('marketby_name_array','db_dates_array','costs_array','date_check_array','total_money','cost','date','month','monthName','members','monthnumber','user_company','total_meal','today_meal','meal_rate','rest_money'));
    }


    function insert(Request $request){
        $update_cost = Addcost::all()->where('user_id' ,'==',Auth::user()->id)->where('company', "==", Auth::user()->company)->where('date',"==",$request->currentdate);
        if(count($update_cost) == 0){
            Addcost::insert([
            'user_id'=>Auth::user()->id,
            'company'=>Auth::user()->company,
             'describe'=>$request->describe,
             'dailycost'=>$request->dailycost,
             'marketby'=>$request->marketby,
             'date'=>$request->currentdate,
             'month'=>$request->month,
             'created_at'=>Carbon::now(),
        ]);
        return back()->with('success','Add meal successfully Done!!');
        }
        else{
            Addcost::where("user_id","=" ,Auth::id())->where('company',"=" ,Auth::user()->company)->where('date',"=" ,$request->currentdate)->update([
                'describe'=>$request->describe,
             'dailycost'=>$request->dailycost,
             'marketby'=>$request->marketby,
            ]);
            return back()->with('success','Update meal successfully Done!!');
        }

    }

}


//if(count($update_cost)== 0){
//if(isset($_SESSION["user_id"]) &&  isset($_SESSION["company"]) && isset($request['describe']) && isset($request['dailycost']) && isset($request['phone'])&& isset($request['date']) && isset($request['month'])){
        // 	// write the query to check if this username and password exists in our database
        //  $id = $_SESSION["user_id"],
        // 	$company = $_SESSION["company"];
        // 	$describe = $request['describe'];
        // 	$dailycost = $request['dailycost'];
        // 	$marketby = $request['marketby'];
        // 	$date = $request['date];
        // 	$month = $request['month'];
        // 	$created_at = Carbon::now();
        // 	$sql = " INSERT INTO Addcost VALUES('$id','$company', '$describe', '$dailycost', '$date','marketby', '$month', '$created_at') ";
        // 	$result = mysqli_query($conn, $sql);
        //}
        //else{
        // 	$describe = $request['describe'];
        // 	$dailycost = $request['dailycost'];
        // 	$marketby = $request['marketby'];
        //}
        //$update = "Update Addcost SET describe = '$describe',dailycost = '$dailycost',marketby = '$marketby' Where user_id = $_SESSION["user_id"] and company = $_SESSION["company"] and date = $request['currentdate']";
        //Execute the query
        // 	$result = mysqli_query($conn, $update);

        // 	//check if this insertion is happening in the database


        // }
