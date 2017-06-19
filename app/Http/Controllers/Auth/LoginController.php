<?php 

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request; 
use App\User;
use Auth;


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
    protected $redirectTo = '/home';
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function postLogin(Request $request)
    {  
        if (Auth::attempt(['email' =>  $request->input('email'), 'password' => $request->input('password'), 'verification' => 1])) {
             
            return redirect('/home');

        } elseif (Auth::attempt(['email' =>  $request->input('email'), 'password' => $request->input('password')])) {

            Auth::logout();
            return redirect('/login')->with('status', 'You need to confirm your account. We have sent you an activation code, please check your email.');

        } else {

            return redirect('/login')->with('status', 'Your credentials are not correct.');

        }
        
    }

    public function redirectToProvider()
    {
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * Obtain the user information from facebook.
     *
     * @return Response
     */
    public function handleProviderCallback()
    {
        $user = Socialite::driver('facebook')->user();

    }

}
