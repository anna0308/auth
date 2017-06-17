<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\User;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name'      =>  $data['name'],
            'email'     =>  $data['email'],
            'password'  =>  bcrypt($data['password']),
        ]);
    
    }

    public function getRegisterForm()
    {
        return view('auth.register');
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
        ];
        if (User::create($response)) {

            $email = $request->input('email');
            $code = User::where('email', $email)->value('code');
            $url = env('APP_URL').'/register/verify/'. $code.'/'. $request->input('email');

            Mail::send('auth.confirm_email', ['url' => $url], function ($message) use ($email)
                {
                    $message->from('adaanna.1994@mail.ru', 'Petra');
                    $message->to($email);
                    $message->subject('Please confirm your email address!!!');
                });
            if (count(Mail::failures()) > 0) {

                return redirect('/login')->with('status', 'There are problem with sent verification mail, please try again.');

            } else {

                return redirect('/login')->with('status', 'We sent you an activation code. Check your email.');
            }
        } else {
            return redirect('/login')->with('status', 'Something went wrong try again.');
        }
    }

    public function verify($code, $email)
    {
        if (User::where('email', $email)->value('code') === $code) {

            if (User::where('email', $email)->update(['verification' => true])) {

                return redirect('/login')->with('status', 'Hello from Petra !!!');

            } else {

                return redirect('/login')->with('status', 'Something went wrong try again.');
            }
        }
        
    }
}
