<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Package;

class FrontendController extends Controller
{
    public function index()
    {
        $cars = ['a','s','d','f','g'];
        // $user_company = Auth::user()->company;
        $packages = Package::all();
        return view('admin.frontend.index',compact('cars','packages'));
    }
}
