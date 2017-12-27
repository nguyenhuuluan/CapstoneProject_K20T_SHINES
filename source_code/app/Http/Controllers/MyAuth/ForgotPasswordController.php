<?php

namespace App\Http\Controllers\MyAuth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

//Trait
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

class ForgotPasswordController extends Controller
{
    //Sends Password Reset emails
	use SendsPasswordResetEmails;

	//Show form request password reset
	public function showLinkRequestForm($value='')
	{
		return view('account.passwords.email');
	}

	//Password Broker for Seller Account
    public function broker()
    {
         return Password::broker('accounts');
    }


}
