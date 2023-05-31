<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\Admin;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;



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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
        $this->middleware('guest:admin');
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
            'email' => ['required', 'string', 'email', 'max:100', 'unique:users'],
            'user_name' => ['required', 'string', 'max:100','unique:users'],
            'birthday' => ['required', 'date'],
            'first_name' => ['required', 'string', 'max:100'],
            'status' => ['required', 'string', 'max:100'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],

        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'email' => $data['email'],
            'user_name' => $data['user_name'],
            'birthday' => $data['birthday'],
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'status' => $data['status'],
            'password' => Hash::make($data['password']),
        ]);
    }

    public function showAdminRegisterForm()
    {
        return view('auth.register', ['route' => route('admin.register-view'), 'title'=>'Admin']);
    }

    protected function createAdmin(Request $request)
    {
        $this->validator($request->all())->validate();
        $admin = Admin::create([
            'email' => $request['email'],
            'user_name' => $request['user_name'],
            'birthday' =>   $request['birthday'],
            'first_name' => $request['first_name'],
            'last_name' => $request['last_name'],
            'status' => $request['status'],
            'password' => Hash::make($request['password']),
        ]);
        return redirect()->intended('admin');
    }
}
