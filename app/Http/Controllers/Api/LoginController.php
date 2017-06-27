<?php 

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request; 
use App\User;
use Auth;


class LoginController extends Controller
{
	public function postLogin(Request $request)
    {  
    	
        if (Auth::attempt(['email' =>  $request->input('email'), 'password' => $request->input('password'), 'verification' => 1])) {
             
            $user=Auth::user();
            return response()->json(['user'=> $user]);

        } else {

            return response()->json(['error'=>'Your credentials are not correct.']);

        }
        
    }
	public function logout()
    {
        Auth::logout();
    }
};