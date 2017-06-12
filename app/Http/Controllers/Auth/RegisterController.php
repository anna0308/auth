<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

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
            'name'      => $data['name'],
            'email'     => $data['email'],
            'password'  => bcrypt($data['password']),
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
        $response = User::create([
                                'name'      => $request->input('name'),
                                'email'     => $request->input('email'),
                                'password'  => bcrypt($request->input('password')),
                                'code'      => md5(uniqid(rand(),1)),
                            ]);
        $email = $request->input('email');
        $code = DB::table('users')->where('email', $email)->value('code');
        $url = env('APP_URL').'/register/verify/'. $code.'/'. $request->input('email');
        Mail::send('auth.confirm_email', ['url' => $url], function ($message) use ($email)
            {
                $message->from('adaanna.1994@mail.ru', 'Petra');
                $message->to($email);
                $message->subject('Please confirm your email address!!!');
            });
        return redirect('/login')->with('status', 'We sent you an activation code. Check your email.');
    }

    public function verify($code, $email)
    {
        if(DB::table('users')->where('email', $email)->value('code')===$code)
        {
            DB::table('users')
            ->where('email', $email)
            ->update(['verification' => true]);
        }
        return redirect('/login')->with('status', 'Hello from Petra !!!');
    }
}
