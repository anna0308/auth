<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request; 
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


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

        $verif = DB::table('users')->where('email', $request->input('email'))->value('verification');
        if($verif)
        {
            $user_id = DB::table('users')->where('email', $request->input('email'))->value('id');
            Auth::loginUsingId($user_id);
            return redirect('/home');
        }
        else
        {
          return redirect('/login')->with('status', 'You need to confirm your account. We have sent you an activation code, please check your email.');
        }
    }

}
