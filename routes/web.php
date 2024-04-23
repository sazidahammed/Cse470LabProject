<?php
use App\Http\Controllers\HomeController;
use App\Http\Controllers\FrontendController;
use App\Models\User;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AddmoneyController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\OrderRequestController;
use App\Http\Controllers\AddmealController;
use App\Http\Controllers\AddcostController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SslCommerzPaymentController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/',[FrontendController::class, 'index']);

// Route::get('/dashboard', function () {
//     $cars = ['a','s','d','f','g'];
//     return view('dashboard',compact('cars'));
// })->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/dashboard',[HomeController::class, 'index'])->middleware(['auth','verified'])->name('name');
Route::post('/user/insertbymanager',[HomeController::class, 'insertbymanager']);
Route::post('/user/insertbyadmin',[HomeController::class, 'insertbyadmin']);
Route::get('/user/delete/{user_id}',[HomeController::class, 'delete']);
Route::get('/request/delete/{request_id}',[HomeController::class, 'requestdelete']);


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::get('/check',[FrontendController::class, 'index']);


//Edit routes

Route::get('/profile/edit',[ProfileController::class, 'editprofile']);
Route::post('/profile/popupmodal', [ProfileController::class, 'popupmodal']);
Route::post('/profile/popupmodal/editname',[ProfileController::class, 'namechange']);
Route::post('/profile/popupmodal/editpassword',[ProfileController::class, 'passwordchange']);
Route::post('/profile/popupmodal/photochange',[ProfileController::class, 'photochange']);

//ADD MONEY

Route::get('/addmoney',[AddmoneyController::class, 'index'])->name('addmoney');
Route::post('/addmoney/insert',[AddmoneyController::class, 'insert']);

// ADD MEAL
Route::get('/addmeal',[AddmealController::class, 'index'])->name('addmeal');
Route::get('/addmeal/bymanager/{user_id}',[AddmealController::class, 'addbymanager']);
Route::post('/general/addmeal',[AddmealController::class, 'insert']);
Route::post('/bymanager/addmeal',[AddmealController::class, 'insertbymanager']);


<<<<<<< HEAD
//ADD Daily Cost
Route::get('/addcost',[AddcostController::class, 'index'])->name('addcost');
Route::post('/cost/insert',[AddcostController::class, 'insert']);
=======
//ADD MONEY
>>>>>>> 0be18580eb9602488629a4aa4abc70954cd33ea8

Route::get('/addmoney',[AddmoneyController::class, 'index'])->name('addmoney');
Route::post('/addmoney/insert',[AddmoneyController::class, 'insert']);

// ADD MEAL
Route::get('/addmeal',[AddmealController::class, 'index'])->name('addmeal');
Route::get('/addmeal/bymanager/{user_id}',[AddmealController::class, 'addbymanager']);
Route::post('/general/addmeal',[AddmealController::class, 'insert']);
Route::post('/bymanager/addmeal',[AddmealController::class, 'insertbymanager']);

//ADD Daily Cost
Route::get('/addcost',[AddcostController::class, 'index'])->name('addcost');
Route::post('/cost/insert',[AddcostController::class, 'insert']);


//Package
Route::get('/package',[PackageController::class, 'index'])->name('package');
Route::post('/addpackage',[PackageController::class, 'insert']);
Route::get('/package/delete/{package_id}',[PackageController::class, 'packagedelete']);


//Order Request
Route::get('/order/{package_id}',[OrderRequestController::class, 'index'])->name('order');
Route::post('/orderrequest',[OrderRequestController::class, 'insert']);

//Package
Route::get('/package',[PackageController::class, 'index'])->name('package');
Route::post('/addpackage',[PackageController::class, 'insert']);
Route::get('/package/delete/{package_id}',[PackageController::class, 'packagedelete']);


//Order Request
Route::get('/order/{package_id}',[OrderRequestController::class, 'index'])->name('order');
Route::post('/orderrequest',[OrderRequestController::class, 'insert']);

//check
Route::get('/check', function () {
    return view('check');
});


//send invoice

Route::get('/mail/send/{user_id}', [HomeController::class, 'mailsend']);

//send mail 
Route::get('/sendmail', [AddmealController::class, 'sendmail']);
Route::get('/sendmail/send/{user_id}/{a}/{b}/{c}/{d}/{e}/{f}/{g}/{h}/{i}', [AddmealController::class, 'mail']);



//email verify

Route::get('/email/verify', function () {
    return view('auth.passwords.verify-email');
})->middleware('auth')->name('verification.notice');


Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/dashboard');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');


Route::get('/posts',function(){
//    $user = App\Models\User::first();
//    $addmeal = App\Models\Addmeal::last();
//    $user->addmeals()->attach($addmeal);


});
require __DIR__.'/auth.php';

<<<<<<< HEAD


=======
>>>>>>> 0be18580eb9602488629a4aa4abc70954cd33ea8
// SSLCOMMERZ Start
Route::get('/example1', [SslCommerzPaymentController::class, 'exampleEasyCheckout']);
Route::get('/example2', [SslCommerzPaymentController::class, 'exampleHostedCheckout']);

Route::post('/pay', [SslCommerzPaymentController::class, 'index']);
Route::post('/pay-via-ajax', [SslCommerzPaymentController::class, 'payViaAjax']);

Route::post('/success', [SslCommerzPaymentController::class, 'success']);
Route::post('/fail', [SslCommerzPaymentController::class, 'fail']);
Route::post('/cancel', [SslCommerzPaymentController::class, 'cancel']);

Route::post('/ipn', [SslCommerzPaymentController::class, 'ipn']);
<<<<<<< HEAD
//SSLCOMMERZ END
=======
//SSLCOMMERZ END
>>>>>>> 0be18580eb9602488629a4aa4abc70954cd33ea8
