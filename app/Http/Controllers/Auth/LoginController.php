<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;


    // if(isset($_POST['email']) && isset($_POST['password'])){
    //     // write the query to check if this username and password exists in our database
    //     $u = $_POST['email'];
    //     $p = $_POST['password'];
    //     $sql = "SELECT * FROM users WHERE username = '$u' AND password = '$p'";

    //     //Execute the query
    //     $result = mysqli_query($conn, $sql);

    //     //check if it returns an empty set
    //     if(mysqli_num_rows($result) !=0 ){
    //         $row = mysql_fetch_array($sql);
    //         $_SESSION["userid"] = $row["id"];

    //             // also you can store other information in session variables, like
    //         $_SESSION["company"] = $row["company"];
    //         $_SESSION["name"] = $row["name"];
    //         $_SESSION["type"] = $row["type"];
    //         $_SESSION["roll"] = $row["roll"];

    //     else{
    //         // echo "Username or Password is wrong";
    //         header("Location: index.php");
    //     }

    // }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
