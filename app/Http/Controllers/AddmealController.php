<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Addmeal;
use App\Models\Addmoney;
use App\Models\Package;
use App\Models\User_Purchase_Package;
use App\Models\UserAddMeal;
use Auth;
use Carbon\Carbon;
use App\Mail\SendMail;
use App\Mail\SendMailForDuePayment;

use Mail;
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
        if (Auth::user()->type == 91) {

            foreach ($meal_package as $value ){
            $x = Package::find($value->package_id)->package_price;

            }
     }else{
        if($total_meal != 0 ){
            $meal_round = Addcost::all()->where('company' ,'==',$user_company)->sum('dailycost')/$total_meal;
        $x = round($meal_round, 2);
        }
        else{
            $x =0;
        }


     }
     $y = $total_meal_ofuser;
     $z = $x*$y;
        return view('admin.addmeal.index',compact('date','total_meal_ofuser','meal_package','month','monthName','x','total_meal','monthnumber','date','user_company','z'));
    }

    function addbymanager($user_id){
        $user_company = Auth::user()->company;
        //$user_company = $_SESSION["company"];
        $month = Carbon::now()->month;
        $user_name = User::find($user_id)->name;
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
        $total_bill = Addmoney::all()->where('user_id' ,'==',$user_id)->sum('amount');

        if (User::find($user_id)->type == 91){
            foreach ($meal_package as $value ){
                $package_name = Package::find($value->package_id)->package_name;
                $package_price = Package::find($value->package_id)->package_price;

            }
        }
        
    //$meal_package = Select * from User_Purchase_Package where id = $user_id and company = $user_company;
        if (Auth::user()->type == 91) {

        foreach ($meal_package as $value ){
        $x = Package::find($value->package_id)->package_price;

        }
        }else{
        if($total_meal != 0 ){
        $meal_round = Addcost::all()->where('company' ,'==',$user_company)->sum('dailycost')/$total_meal;
        $x = round($meal_round, 2);
        }
        else{
        $x =0;
        }


        }
        $y = $total_meal_ofuser;
        $z = $x*$y;
        return view('admin.addmeal.bymanager',compact('date','total_meal_ofuser','meal_package','month','monthName','x','total_meal','user_id','monthnumber','user_company','z','user_name','package_name','package_price','total_bill'));
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


        }

        public function sendmail(){
            $user_id = Auth::id();
            $user_company = Auth::user()->company;
            $users = User::all()->where('company' ,'==',$user_company);
            $mambers = Addmeal::all()->where('company' ,'==',$user_company);
            $meal_package = User_Purchase_Package::all()->where('user_id','==',Auth::id())->where('company','==',$user_company);
            $user_name_list=[];
            $user_total_lunch = [];
            $user_total_dinner = [];
            $user_total_meal = [];
            $user_package_name = [];
            $user_package_price = [];
            $user_paid = [];
            $user_due = [];
            $user_deposit = [];
            foreach ($users as $user){
                    
                $user_name=User::find($user->id)->name;
                array_push($user_name_list,$user_name);
                $total_lunch_ofuser = Addmeal::all()->where('user_id' ,'==',$user->id)->sum('lunch');
                array_push($user_total_lunch,$total_lunch_ofuser);
                $total_dinner_ofuser = Addmeal::all()->where('user_id' ,'==',$user->id)->sum('dinner');
                array_push($user_total_dinner,$total_dinner_ofuser);
                $total_meal_ofuser = $total_lunch_ofuser + $total_dinner_ofuser;
                array_push($user_total_meal,$total_meal_ofuser);
                $package = User_Purchase_Package::where('user_id', $user->id)->first();
                
                $package_name = '';
                $package_price = 0;
                if ($package) {
                    $package = $package->package_id;
                    $package_name =Package::find($package)->package_name;
                    $package_price =Package::find($package)->package_price;
                } else {
    
                }
                array_push($user_package_name,$package_name);
                array_push($user_package_price,$package_price);
                $paid = Addmoney::all()->where('user_id' ,'==',$user->id)->sum('amount');
                array_push($user_paid,$paid);
                $x = $paid - $package_price*$total_meal_ofuser;
                if(0 < $x){
                    array_push($user_deposit,$x);  
                }else{
                    $x=0;
                    array_push($user_deposit,$x);
                }
                $y= $package_price*$total_meal_ofuser - $paid;
                if(0 < $y){
                    array_push($user_due,$y);  
                }else{
                    $y=0;
                    array_push($user_due,$y);
                }


                
    
            }
            
        
           
            return view('admin.sendmail.index',compact('users','user_name_list','user_total_lunch','user_total_dinner','user_total_meal','user_package_name','user_package_price','user_paid','user_due','user_deposit'));

        }
        public function mail($user_id,$a,$b,$c,$d,$e,$f,$g,$h,$i){
            $user_mail = User::find($user_id)->email;
            $total_bill = $d*$f;
            $data = array(
                'Mail'   =>  $user_mail ,
                'name'   =>   $a,
                'lunch'   =>   $b,
                'dinner'   =>   $c,
                'total_meal'   => $d,
                'package_name'   => $e,
                'package_price'   => $f,
                'total_bill' =>$total_bill , 
                'paid'=>$h,
                'Deposit'=>$i,
                'Due' => $g,
            );
            Mail::to($user_mail)->send(new SendMail($data));
            return back();
        }
}


