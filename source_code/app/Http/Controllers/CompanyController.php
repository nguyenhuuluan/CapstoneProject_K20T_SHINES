<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Representative;
use App\Account;
use App\Company;

use Mail;

class CompanyController extends Controller
{

	public function test($companyID)
	{

		
        $com = $this->CreateRepresentative($companyID);

        Mail::send('verify', ['company' => $com], function ($message) use($com)
        {
            $message->to($com['email'])->subject('Welcome to Expertphp.in!');

        });

        return "OK";
    }


    public function CreateRepresentative($companyID)
    {

    	$comp = new Company();
    	$comp = $this->SetActiveCompany($companyID);

      $acc_result = new Account();
      $acc_result = $this->CreateAccountRepresentative($comp);


      $repre = Representative::create([
        'name' => "Representative of " .$comp['name'],  				
        'email' => $comp['email'],
        'phone' => $comp['phone'],
        'account_id' => $acc_result['id'],
        'company_id' => $comp['id']
    ]);

      return $repre;
  }

  public function SetActiveCompany($company_id)
  {
     $comp = Company::Where('id', $company_id)->first();

     $comp->status_id = 3;

     $comp->save();   	

     return $comp;
 }

 public function CreateAccountRepresentative($comp)
 {

     $number_of_repre = $comp->representatives()->count() + 1;

     $acc_result = Account::create([
         'username'=>$comp['name'] .$number_of_repre,
         'password'=>bcrypt(str_random(40)),
			    		'status_id'=>5 // set active account
			    	]);

     return $acc_result;
 }





}
