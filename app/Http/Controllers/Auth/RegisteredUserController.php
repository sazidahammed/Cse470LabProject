<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'company' => ['required', 'string', 'max:255'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'phone' => ['required', 'string', 'max:14'],
            'type' => ['required', 'string', 'max:14'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'company' => $request->company,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'type' => $request->type,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }

}


// if(isset($request['company']) && isset($request['name']) && isset($request['email']) && isset($request['phone'])&& isset($request['password']) && isset($request['role']) && isset($request['type'])){
// 	// write the query to check if this username and password exists in our database
// 	$a = $request['company'];
// 	$b = $request['name'];
// 	$c = $request['email'];
// 	$d = $request['phone'];
// 	$e = $request['password];
// 	$f = $request['role'];
// 	$g = $request['type'];
// 	$h = Carbon::now();

// 	$sql = " INSERT INTO student VALUES( '$a', '$b', '$c', '$d', '$e', '$f', '$g','$h' ) ";

// 	//Execute the query
// 	$result = mysqli_query($conn, $sql);

// 	//check if this insertion is happening in the database


// }



