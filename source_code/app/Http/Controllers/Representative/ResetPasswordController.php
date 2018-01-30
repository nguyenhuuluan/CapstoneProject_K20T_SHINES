<?php

namespace App\Http\Controllers\Representative;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Request\AccountRequest;


use App\Http\Request\StudentRequests;
use Response;

use App\Account;
use App\Faculty;
use App\Company;
use App\Student;
use App\Role;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

  //  use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
   // protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('guest');
    // }

    public function resetPassword(\App\Http\Requests\AccountRequest $request)
    {

        $acc = Account::where('id', $request['account_id'])->first();
        $acc->password = bcrypt($request['password']);
        $acc->status_id = 5;
        $acc->remember_token = null;
        $acc->save();

        return redirect()->route('representative.update-success');     

    }

    public function updateSuccess()
    {
        return view('layouts2.update-success');
    }
}
