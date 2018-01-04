<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use App\Account;

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
    protected $redirectTo = 'admin/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }


    public function register(Request $request)
    {

        $this->validation($request);

        // if($this->validation($request)){
        //     $errors()->add('username', 'dsadsa');
        // }
        Account::create([
            'username'=> $request->email,
            'password'=>bcrypt($request->password),
            'status_id'=> 6,
        ]);

        return redirect('/');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function validation($request)
    {      
        return $this->validate($request,[
                    'email'=>'required|string|email|max:255|unique:accounts,username',
                    'password' => 'required|string|min:6|confirmed',
        ]);

        // return Validator::make($data, [
        //     'name' => 'required|string|max:255|unique:users',
        //     // 'email' => 'required|string|email|max:255|unique:users',
        //     'password' => 'required|string|min:6|confirmed',
        // ]);
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
            'username' => $data['name'],
            'password' => bcrypt($data['password']),
        ]);
    }

    
}
