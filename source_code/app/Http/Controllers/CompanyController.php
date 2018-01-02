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

		
    $com = $this->createRepresentative($companyID);


  }

  public function index()
  {
    return view('admin.companies.index');
  }

  public function sendMailToResetPassword($represen, $com, $acc)
  {



    Mail::send('representatives.reset', ['company' => $com, 'representative' => $represen,'account' => $acc],  function ($message) use($com)
    {
      $message->to($com['email'])->subject('Chấp thuận doanh  nghiệp / công ty | Reset password');
    });

    return $represen;
  }


  public function createRepresentative($companyID)
  {

   $comp = new Company();
   $comp = $this->setActiveCompany($companyID);

   $acc_result = new Account();
   $acc_result = $this->createAccountRepresentative($comp);


   $repre = Representative::create([
    'name' => "Representative of " .$comp['name'],  				
    'email' => $comp['email'],
    'phone' => $comp['phone'],
    'account_id' => $acc_result['id'],
    'company_id' => $comp['id']
  ]);

   $this->sendMailToResetPassword($repre, $comp, $acc_result);

   return $repre;
 }

 public function setActiveCompany($company_id)
 {
   $comp = Company::Where('id', $company_id)->first();

   $comp->status_id = 3;

   $comp->save();   	

   return $comp;
 }

 public function createAccountRepresentative($comp)
 {

   $number_of_repre = $comp->representatives()->count() + 1;

   $acc_result = Account::create([
     'username'=>$comp['name'] .$number_of_repre,
     'password'=>bcrypt(str_random(40)),
		'status_id'=>5, // set active account
    'remember_token'=>str_random(40)
  ]);

   return $acc_result;
 }

 public function getCompanies(){
  $comps = Company::all();

  return datatables()->of($comps)->addColumn('action', function ($comps) {
    return '<input type="checkbox" id="something" unchecked data-toggle="toggle" data-onstyle="success" data-size="mini">';
  })->toJson();
}


}
