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

Route::get('/',[FrontendController::class, 'index'])->name('home');

// Route::get('/dashboard', function () {
//     $cars = ['a','s','d','f','g'];
//     return view('dashboard',compact('cars'));
// })->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/dashboard',[HomeController::class, 'index'])->middleware(['auth','verified'])->name('dashboard');
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













//check
Route::get('/check', function () {
    return view('check');
});


//send invoice

Route::get('/mail/send/{user_id}', [HomeController::class, 'mailsend']);




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
