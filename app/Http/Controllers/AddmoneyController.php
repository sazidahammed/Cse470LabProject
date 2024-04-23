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
        $users = User::all()->where('company' ,'==',$user_company);
        $mambers = Addmoney::all()->where('company' ,'==',$user_company);

        $categories = Addmoney::groupBy('user_id')->pluck('user_id');// individual unique persons of that company (set of users)


        
        $now = Carbon::now();
        $monthnumber = $now->format('m');


        $member_name_list=[];
        foreach ($mambers as $index=>$mamber){

            $member_name=User::find($mamber->user_id)->name;
            array_push($member_name_list,$member_name);
        }





        $value_list=[];
        $category_name_list=[];
        $sum_list=[];

        
        foreach ($categories as $index=>$category){
            
            $value = Addmoney::all()->where('user_id' ,'==',$category)->where('company' ,'==',$user_company)->sum('amount');
            
            array_push($value_list,$value);
            $adds = Addmoney::all()->where('month', '!=',$monthnumber);
            foreach ($adds as $add) {
                    $add->delete();
                }
            
            if ($value  != NUll){
                $category_name=User::find($category)->name;
                array_push($category_name_list,$category_name);

                $sum=Addmoney::all()->where('user_id' ,'==',$category)->where('company' ,'==',$user_company)->sum('amount');
                array_push($sum_list,$sum);

              
                
            }
            else{
                array_push($sum_list,'None');
                array_push($category_name_list,'None');

            }

            
        }
        
        

        $total=Addmoney::all()->where('company' ,'==',$user_company)->sum('amount');


       return view('admin.addmoney.index',compact('value_list','member_name_list','total','category_name_list','sum_list','users','mambers','categories','user_company','monthnumber'));

    }
    function insert(Request $request){
        
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


