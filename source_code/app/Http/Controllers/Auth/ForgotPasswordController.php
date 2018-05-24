<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
// use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

use App\Account;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    // use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function forgotPassword()
    {
       return View('auth.passwords.reset');
   }

   public function sendForgotPassword(Request $request)
   {

     $request->validate([
        'email' => 'required|email'
    ]);

    $isExistAccount = Account::where('username' , '=', $request->email)->first();

    

    

     return View('auth.passwords.reset');
 }


}
