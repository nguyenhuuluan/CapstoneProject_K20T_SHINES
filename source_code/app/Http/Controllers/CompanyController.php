<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Representative;
use App\Account;
use App\Company;
use App\CompanyRegistration;

use Mail;

class CompanyController extends Controller
{


  public function companyRegistration()
  {
    $compsRegis = CompanyRegistration::all();
    return view ('admin.companies.company-registration',compact('compsRegis'));
  }

  public function createCompany($compRegis)
  {

    $comp = Company::create([
      "name" => $compRegis["company_name"],
      "website" => $compRegis["company_website"],
      "status_id" => 3
    ]);

    return $comp;
  }

  public function approveCompany($companyID)
  {   
    // $this->createRepresentative($companyID);
    // return response()->json(['isSuccess' => true]);

    $compRegis = CompanyRegistration::where('id', $companyID)->first();

    $comp = new Company();
    $comp = $this->createCompany($compRegis);

    $account = new Account();
    $account = $this->createAccountRepresentative($compRegis);

    $repre = new Representative();
    $repre = $this->createRepresentative($comp, $compRegis, $account);


    $this->sendMailToResetPassword($repre, $comp, $account);
    
  //  return $repre;

    return response()->json(['isSuccess' => true]);

  }






  public function index()
  {
    $comps = Company::all();
    return view ('admin.companies.index',compact('comps'));
  }

  public function sendMailToResetPassword($represen, $com, $acc)
  {

    Mail::send('representatives.reset', ['company' => $com, 'representative' => $represen,'account' => $acc],  function ($message) use($represen)
    {
     $message->to($represen['email'])->subject('Chấp thuận doanh  nghiệp / công ty | Reset password');
   });

  }


  public function createRepresentative($comp, $compRegis, $acc)
  {

    $repre = Representative::create([
     "name" => $compRegis["representative_name"],        
     "email" => $compRegis["representative_email"],
     "phone" => $compRegis["representative_phone"],
     "account_id" => $acc["id"],
     "company_id" => $comp["id"]
   ]);

    return $repre;
  }

  public function setApproveCompany($companyID){
    $comp = Company::Where('id', $companyID)->first();

    $comp->status_id = 3;

    $comp->save();

    return $comp;     
  }

  public function setActiveCompany($company_id){
    $comp = Company::Where('id', $company_id)->first();

    if ($comp->status_id != 3) {
     $comp->status_id = 3;
   }else {
     $comp->status_id = 4;
   }

   $comp->save();     

   return $comp;
 }

 public function createAccountRepresentative($compRegis)
 {

   $acc = Account::create([
    'username'=>$compRegis["representative_email"],
    'password'=>bcrypt(str_random(40)),
      'status_id'=>5, // set active account
      'remember_token'=>str_random(40)
    ]);

   return $acc;
 }

 public function getCompanies()
 {
  $comps = Company::all();

  return datatables()->of($comps)->addColumn('action', function ($comps) {
   $btn;

   $btn = $comps['status_id'] == 3? '<td><input type="checkbox" id="something" checked data-toggle="toggle" data-onstyle="success" data-size="mini"  value="'.$comps['id'].'"></td>' : '<td><input type="checkbox" id="something" data-toggle="toggle" data-onstyle="success" data-size="mini" value="'.$comps['id'].'"></td>';
   return $btn;
 })->toJson();
}


public function store(Request $request)
{
 $input = $request->all();

 // Validation
 $this->validate($request, [
  'name'=>'required',
  'email'=>'required|email',
  'website'=>'required',
  'phone'=>'required'
]);

 $input['status_id'] = 7;

 Company::create($input);

 $request->session()->flash('resigter-success', '<strong>Đăng ký thành công</strong>, chúng tôi sẽ liên lạc với bạn sớm để xác nhận, cảm ơn.');

 return redirect()->route("home");

}
}