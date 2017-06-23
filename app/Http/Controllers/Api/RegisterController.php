<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\User;
use Auth;

class RegisterController extends Controller
{

	 public function __construct()
    {
        $this->middleware('guest');
    }
    
    public function postRegister(Request $request)
    {
        $this->validate($request, [
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
        $response = [
            'name'      => $request->input('name'),
            'email'     => $request->input('email'),
            'password'  => bcrypt($request->input('password')),
            'code'      => md5(uniqid(rand(),1)),
            'verification' => 1
        ];
        if (User::create($response)) {

            // $email = $request->input('email');
            // $code = User::where('email', $email)->value('code');
            // $url = env('APP_URL').'/register/verify/'. $code.'/'. $request->input('email');

            // Mail::send('auth/confirm_email', ['url' => $url], function ($message) use ($email)
            //     {
            //         $message->from('adaanna.1994@mail.ru', 'Petra');
            //         $message->to($email);
            //         $message->subject('Please confirm your email address!!!');
            //     });
            // if (count(Mail::failures()) > 0) {

            //     return redirect('/login')->with('status', 'There are problem with sent verification mail, please try again.');

            // } else {

            // return redirect('/login')->with('status', 'We sent you an activation code. Check your email.';
           	return response()->json(['name'=> $request->input('name')]);

            }
       
    }



};