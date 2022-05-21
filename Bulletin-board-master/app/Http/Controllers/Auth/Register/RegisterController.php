<?php

namespace App\Http\Controllers\Auth\Register;

use App\Models\Users\User;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Auth;

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
    protected $redirectTo = '/top';

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
            'username' => 'required|string|max:30',
            'email' => 'required|email|max:100|unique:users',
            'password' => 'required|string|alpha_num|min:8|max:30|confirmed',
            'password_confirmation' => 'required|string|alpha_num|max:30',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    // public function registerForm(){
    //     return view("auth.register");
    // }

    public function register(Request $request){

        if($request->isMethod('post')){
            $data = $request->input();
            $validator = $this->validator($data);

        if ($validator->fails()) {
            return redirect('/register')
            ->withInput()
            ->withErrors($validator);
        }

            $this->create($data);

            return redirect('added')->with('username',$data['username']);
    }
        return view('auth.register');

    }
    public function added(){
         $username = 'username';

     return view('auth.added');
    }
}
