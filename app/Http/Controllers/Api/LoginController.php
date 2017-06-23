<?php 

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request; 
use App\User;
use Auth;


class LoginController extends Controller
{
	public function __construct()
    {
        // $this->middleware('guest')->except('logout');
    }
	public function postLogin(Request $request)
    {  
    	
        if (Auth::attempt(['email' =>  $request->input('email'), 'password' => $request->input('password'), 'verification' => 1])) {
             
            //return redirect('/home');
            $user=Auth::user();
            return response()->json(['user'=> $user]);

        // } elseif (Auth::attempt(['email' =>  $request->input('email'), 'password' => $request->input('password')])) {

        //     Auth::logout();

            // return redirect('/login')->with('status', 'You need to confirm your account. We have sent you an activation code, please check your email.');


        } else {

            return response()->json(['error'=>'Your credentials are not correct.']);

        }
        
    }
	
};