<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Addmeal;
use App\Models\User_Purchase_Package;
use App\Models\UserAddMeal;
use Auth;
use Carbon\Carbon;
// session_start();
class AddmealController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        $user_company = Auth::user()->company;
        //$user_company = $_SESSION["company"];
        $date = Carbon::now();
        $month = Carbon::now()->month;
        $monthName = $date->format('F');

        // $date_check = $x."-".$monthName."-".now()->year;
        // $db_dates = Addmeal::all()->where('user_id' ,'==',Auth::user()->id)->where('date', "==", $date_check);
        // $db_dates_lunch = Addmeal::all()->where('user_id' ,'==',Auth::user()->id)->where('date', "==", $date_check);
        $x = 1;
        $total_lunch_ofuser = Addmeal::all()->where('user_id' ,'==',Auth::user()->id)->sum('lunch');
        //$total_lunch_ofuser = Select SUM('lunch') From Addmeal Where company = $user_company;
        $total_dinner_ofuser = Addmeal::all()->where('user_id' ,'==',Auth::user()->id)->sum('dinner');
        //$total_dinner_ofuser = Select SUM('dinner') From Addmeal Where company = $user_company;
        $total_meal_ofuser = $total_lunch_ofuser + $total_dinner_ofuser;
        $total_lunch = Addmeal::all()->where('company' ,'==',$user_company)->sum('lunch');
        //$today_lunch = Select SUM('lunch') From Addmeal Where date = $date;
        $total_dinner = Addmeal::all()->where('company' ,'==',$user_company)->sum('dinner');
        //$today_dinner = Select SUM('dinner') From Addmeal Where date = $date;
        // $today_meal = $today_lunch + $today_dinner;
        $total_meal = $total_lunch + $total_dinner;
        $now = Carbon::now();
        $monthnumber = $now->format('m');
        $date =  Carbon::now()->format('d-m-Y');
        $meal_package = User_Purchase_Package::all()->where('user_id','==',Auth::id())->where('company','==',$user_company);
        //$meal_package = Select * from User_Purchase_Package where id = $user_id and company = $user_company;
        return view('admin.addmeal.index',compact('date','total_meal_ofuser','meal_package','month','monthName','x','total_meal','monthnumber','date','user_company'));
    }

    function addbymanager($user_id){
        $user_company = Auth::user()->company;
        //$user_company = $_SESSION["company"];
        $month = Carbon::now()->month;
        $monthName = Carbon::now()->format('F');
        $x = 1;
        $total_lunch_ofuser = Addmeal::all()->where('user_id' ,'==',$user_id)->sum('lunch');
         //$total_lunch_ofuser = Select SUM('lunch') From Addmeal Where company = $user_company;
        $total_dinner_ofuser = Addmeal::all()->where('user_id' ,'==',$user_id)->sum('dinner');
         //$total_dinner_ofuser = Select SUM('dinner') From Addmeal Where company = $user_company;
        $total_meal_ofuser = $total_lunch_ofuser + $total_dinner_ofuser;
        $total_lunch = Addmeal::all()->where('company' ,'==',$user_company)->sum('lunch');
        //$today_lunch = Select SUM('lunch') From Addmeal Where date = $date;
        $total_dinner = Addmeal::all()->where('company' ,'==',$user_company)->sum('dinner');
        //$today_dinner = Select SUM('dinner') From Addmeal Where date = $date;
        $total_meal = $total_lunch + $total_dinner;
        $now = Carbon::now();
        $monthnumber = $now->format('m');
        $date =  Carbon::now()->format('d-m-Y');
        $meal_package = User_Purchase_Package::all()->where('user_id','==',$user_id)->where('company','==',$user_company);
        //$meal_package = Select * from User_Purchase_Package where id = $user_id and company = $user_company;
        return view('admin.addmeal.bymanager',compact('date','total_meal_ofuser','meal_package','month','monthName','x','total_meal','user_id','monthnumber','user_company'));
    }


    function insert(Request $request){

        $update_meal = Addmeal::all()->where('user_id' ,'==',Auth::user()->id)->where('date', "==", $request->currentdate);

        if(Auth::user()->type == 91){
            if(count($update_meal) == 0){
                // $user =User::find(Auth::user()->id);
                // $addmeal = Addmeal::with('users')->orderby('id', 'desc')->first();
                // $user->addmeals()->attach($addmeal);
                $meal_id = Addmeal::insertGetId([
                'user_id'=>Auth::user()->id,
                'company'=>Auth::user()->company,
                'package_id'=>$request->package_id,
                 'lunch'=>$request->lunch,
                 'dinner'=>$request->dinner,
                 'date'=>$request->currentdate,
                 'month'=>$request->month,
                 'created_at'=>Carbon::now(),
            ]);
            UserAddMeal::insert([
                'user_id'=>Auth::user()->id,
                'company'=>Auth::user()->company,
                'meal_id'=>$meal_id,
                'created_at'=>Carbon::now(),
            ]);
            return back()->with('success','Add meal successfully Done!!');
            }
            else{
                Addmeal::where("user_id","=" ,Auth::id())->where('date',"=" ,$request->currentdate)->update([
                    'lunch'=>$request->lunch,
                 'dinner'=>$request->dinner,
                ]);
                return back()->with('success','Update meal successfully Done!!');
            }
        }

        if(Auth::user()->type == 92){
            if(count($update_meal) == 0){
                // $user =User::find(Auth::user()->id);
                // $addmeal = Addmeal::with('users')->orderby('id', 'desc')->first();
                // $user->addmeals()->attach($addmeal);
                $meal_id = Addmeal::insertGetId([
                'user_id'=>Auth::user()->id,
                'company'=>Auth::user()->company,

                 'lunch'=>$request->lunch,
                 'dinner'=>$request->dinner,
                 'date'=>$request->currentdate,
                 'month'=>$request->month,
                 'created_at'=>Carbon::now(),
            ]);
            UserAddMeal::insert([
                'user_id'=>Auth::user()->id,
                'company'=>Auth::user()->company,
                'meal_id'=>$meal_id,
                'created_at'=>Carbon::now(),
            ]);
            return back()->with('success','Add meal successfully Done!!');
            }
            else{
                Addmeal::where("user_id","=" ,Auth::id())->where('date',"=" ,$request->currentdate)->update([
                    'lunch'=>$request->lunch,
                 'dinner'=>$request->dinner,
                ]);
                return back()->with('success','Update meal successfully Done!!');
            }
        }


    }

        function insertbymanager(Request $request){
            // $user =User::find($request->user_id);
            // $addmeal = Addmeal::with('users',)->orderby('id', 'desc')->first();
            // $user->addmeals()->attach($addmeal);
            print_r($request->all());
            $update_meal = Addmeal::all()->where('user_id' ,'==',$request->user_id)->where('date', "==", $request->currentdate);
            if(Auth::user()->type == 91){
                if(count($update_meal) == 0){
                    $meal_id = Addmeal::insertGetId([
                    'user_id'=>$request->user_id,
                    'company'=>Auth::user()->company,
                    'package_id'=>$request->package_id,
                     'lunch'=>$request->lunch,
                     'dinner'=>$request->dinner,
                     'date'=>$request->currentdate,
                     'month'=>$request->month,
                     'created_at'=>Carbon::now(),
                ]);
                UserAddMeal::insert([
                    'user_id'=>$request->user_id,
                    'company'=>Auth::user()->company,
                    'meal_id'=>$meal_id,
                    'created_at'=>Carbon::now(),
                ]);
                return back()->with('success','Add meal successfully Done!!');
                }
                else{
                    Addmeal::where("user_id","=" ,$request->user_id)->where('date',"=" ,$request->currentdate)->update([
                        'lunch'=>$request->lunch,
                     'dinner'=>$request->dinner,
                    ]);
                    return back()->with('success','Update meal successfully Done!!');
                }
            }

            if(Auth::user()->type == 92){
                if(count($update_meal) == 0){
                    $meal_id = Addmeal::insertGetId([
                    'user_id'=>$request->user_id,
                    'company'=>Auth::user()->company,

                     'lunch'=>$request->lunch,
                     'dinner'=>$request->dinner,
                     'date'=>$request->currentdate,
                     'month'=>$request->month,
                     'created_at'=>Carbon::now(),
                ]);
                UserAddMeal::insert([
                    'user_id'=>$request->user_id,
                    'company'=>Auth::user()->company,
                    'meal_id'=>$meal_id,
                    'created_at'=>Carbon::now(),
                ]);
                return back()->with('success','Add meal successfully Done!!');
                }
                else{
                    Addmeal::where("user_id","=" ,$request->user_id)->where('date',"=" ,$request->currentdate)->update([
                        'lunch'=>$request->lunch,
                     'dinner'=>$request->dinner,
                    ]);
                    return back()->with('success','Update meal successfully Done!!');
                }
            }

        // print_r($db_dates_lunch);
        // if($request->currentdate == )
        // print_r($request->all());

    }
}


//if(count($update_meal)== 0){
//if(isset($_SESSION["user_id"]) &&  isset($_SESSION["company"]) && isset($request['describe']) && isset($request['dailymeal']) && isset($request['phone'])&& isset($request['date']) && isset($request['month'])){
        // 	// write the query to check if this username and password exists in our database
        //  $id = $_SESSION["user_id"],
        // 	$company = $_SESSION["company"];
        // 	$describe = $request['describe'];
        // 	$dailymeal = $request['dailymeal'];
        // 	$marketby = $request['marketby'];
        // 	$date = $request['date];
        // 	$month = $request['month'];
        // 	$created_at = Carbon::now();
        // 	$sql = " INSERT INTO Addmeal VALUES('$id','$company', '$describe', '$dailymeal', '$date','marketby', '$month', '$created_at') ";
        // 	$result = mysqli_query($conn, $sql);
        //}
        //else{
        // 	$describe = $request['describe'];
        // 	$dailymeal = $request['dailymeal'];
        // 	$marketby = $request['marketby'];
        //}
        //$update = "Update Addmeal SET describe = '$describe',dailymeal = '$dailymeal',marketby = '$marketby' Where user_id = $_SESSION["user_id"] and company = $_SESSION["company"] and date = $request['currentdate']";
        //Execute the query
        // 	$result = mysqli_query($conn, $update);

        // 	//check if this insertion is happening in the database


        // }

