<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use Image;
use Illuminate\Support\Facades\Auth;
class ProfileController extends Controller
{
    // /**
    //  * Display the user's profile form.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @return \Illuminate\View\View
    //  */
    // public function edit(Request $request)
    // {
    //     return view('profile.edit', [
    //         'user' => $request->user(),
    //     ]);
    // }

    // /**
    //  * Update the user's profile information.
    //  *
    //  * @param  \App\Http\Requests\ProfileUpdateRequest  $request
    //  * @return \Illuminate\Http\RedirectResponse
    //  */
    // public function update(ProfileUpdateRequest $request)
    // {
    //     $request->user()->fill($request->validated());

    //     if ($request->user()->isDirty('email')) {
    //         $request->user()->email_verified_at = null;
    //     }

    //     $request->user()->save();

    //     return Redirect::route('profile.edit')->with('status', 'profile-updated');
    // }

    // /**
    //  * Delete the user's account.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @return \Illuminate\Http\RedirectResponse
    //  */
    // public function destroy(Request $request)
    // {
    //     $request->validateWithBag('userDeletion', [
    //         'password' => ['required', 'current-password'],
    //     ]);

    //     $user = $request->user();

    //     Auth::logout();

    //     $user->delete();

    //     $request->session()->invalidate();
    //     $request->session()->regenerateToken();

    //     return Redirect::to('/');
    // }


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    function editprofile(){
        return view('profile.index');
    }
    function namechange(Request $request){
        $user_id = Auth::id();
        //$user_id = $_SESSION["user_id"];
        User::find($user_id)->update([
            'name'=>$request->name,
        ]);
        return back()->with('success','Name updated!');

    }

        // 	$name = $request['name'];
        //$update = "Update User SET name = '$name' where id = $user_id;
    function popupmodal(Request $request){
        $mail = Auth::user()->email;
        $password = Auth::user()->password;
        //$mail = $_SESSION["mail"];
        //$password = $_SESSION["password"];
        if(Hash::check($request->check_password, $password) and $request->check_email == $mail ){
            return redirect('/profile/edit');
        }
        else{
            return back()->with('editerr' ,'Email or Password is not correct.');
        }
    }
    function passwordchange(Request $request){
        $request->validate([
            'old_password' => 'required',
            'password' => 'required',
            'password' =>'confirmed',
            'password' => Password::min(8)
                        ->letters()
                        ->mixedCase()
                        ->numbers()
                        ->symbols(),


        ]);
        if(Hash::check($request->old_password, Auth::user()->password)){
                    $user_id = Auth::id();

                User::find($user_id)->update([
                    'password'=>bcrypt($request->password),
                ]);
                return back()->with('pass_success','password updated!');
        }
        else{
            return back()->with('wrong_password','Password is incorrect.');
        }


    }


    function photochange(Request $request){
        $request->validate([
            'profile_pic'=>'image',
            'profile_pic'=>'file|max:11112',
        ]);

        if(Auth::user()->profile_pic != 'default_pic.jpg'){
            $delete_path = public_path().'/uploads/profile/'.Auth::user()->profile_pic;
            unlink($delete_path);
        }
        $new_profile_photo = $request ->profile_pic;
        $extension = $new_profile_photo->getClientOriginalExtension();
        $new_photo_name = Auth::id().'.'.$extension;
        Image::make($new_profile_photo)->save(base_path('public/uploads/profile/'.$new_photo_name));
        User::find(Auth::id())->update([
            'profile_pic'=>$new_photo_name,
        ]);
        return back();
    }
}
