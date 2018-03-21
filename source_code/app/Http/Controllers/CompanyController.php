<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Representative;
use App\Account;
use App\Company;
use App\CompanyRegistration;
use App\Role;
use App\SocialNetwork;
use App\City;
use App\District;
use App\Address;
use App\Tag;

use Mail;
use GuzzleHttp\Client;

class CompanyController extends Controller
{

  public function detail($id)
  {
    $comp = Company::where('id', '=', $id)->first();

    return view('companies.detail')->with(compact('comp'));
  }

  public function update($id)
  {
    $company = Company::findOrFail($id);

    $cities = City::all();
    $tags = Tag::all();

    $districts = District::where('city_id' , count($company->address) != 0 ? $company->address->district->city->id :$cities[0]->id )->get()->sortBy('name');

    return view('companies.update')->with(compact('company','cities','districts','tags'));

  }

  public function edit($id, Request $request)
  { 

    $client = new Client();

    $res = $client->request('GET', 'http://maps.google.com/maps/api/geocode/json?address='.$request->address. $request->districtname. $request->cityname);

    $jsonObj  = json_decode($res->getBody());

    $address = $jsonObj->results[0]->formatted_address;

    $lat = $jsonObj->results[0]->geometry->location->lat;
    $lng = $jsonObj->results[0]->geometry->location->lng;


    $comp = Company::Where('id', $request->id)->first();
    $comp->name = $request->name;
    $comp->website = $request->website;
    $comp->email = $request->email;
    $comp->phone = $request->phone;
    $comp->working_day = $request->working_day;
    $comp->field = $request->field;
    $comp->business_code = $request->business_code;
    $comp->introduce = $request->introduce;

    $comp->save();

    $compaddress = $comp->address;

    if (count($compaddress) == 0) {

      $address = Address::create([
        "address" => $request->address,
        "latitude" => $lat,
        "longtitude" => $lng,
        "district_id" => $request->district,
        "company_id" => $comp->id
      ]);
    }else{
      $compaddress->address = $request->address;
      $compaddress->latitude = $lat;
      $compaddress->longtitude = $lng;
      $compaddress->district_id = $request->district;
      $compaddress->company_id = $comp->id;

      $compaddress->save();
    }

    $currenttags = array_map('strtolower', Tag::pluck('name')->toArray());
    $tags = array_map('strtolower', array_map('trim', explode(",", $request->tags)));


    $diff = array_diff($tags,$currenttags);
    $intersect = array_intersect($tags,$currenttags);


    foreach ($intersect as $value) {
     $tag2 = new Tag();
     $tag2 = Tag::where('name', $value)->first();
     $tag2 -> companies() -> attach($request->id);     
   }

   foreach ($diff as $value) {
    $tag = Tag::create([
      "name" => $value
    ]);

    $tag -> companies() -> attach($request->id);

  }



}

public function updateimage(Request $request)
{
  if ($file = $request->file('imagefile')) {
    $name = $file->getClientOriginalName();

    $file->move('images/companies/logos', $name);

    $input['path'] = $name;

    $comp = Company::Where('id', $request->id)->first();
    $comp->logo = $name;
    $comp->save();

    return response()->json(200);
  }

  return response()->json(500);
}



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
    "logo" => 'default-company-logo.jpg',
    "status_id" => 3
  ]);

  return $comp;
}

public function approveCompany($companyID)
{   
    // $this->createRepresentative($companyID);
    // return response()->json(['isSuccess' => true]);

  $compRegis = CompanyRegistration::where('id', $companyID)->first();

  $compRegis -> status_id = 7;

  $compRegis -> save();

  $comp = new Company();
  $comp = $this->createCompany($compRegis);

  $account = new Account();
  $account = $this->createAccountRepresentative($compRegis);

  $repre = new Representative();
  $repre = $this->createRepresentative($comp, $compRegis, $account);

    // $address = Role::findOrFail(3);
    // $role -> accounts() -> attach($acc["id"]);


   //$this->sendMailToResetPassword($repre, $comp, $account);

  return $repre;

   // return response()->json($repre);

}


public function index()
{
  $comps = Company::all();
  return view ('admin.companies.index',compact('comps'));
}

public function sendMailToResetPassword($represen, $com, $acc)
{

  Mail::send('admin.representatives.email-confirm', ['company' => $com, 'representative' => $represen,'account' => $acc],  function ($message) use($represen)
  {
   $message->to($represen['email'])->subject('Chấp thuận doanh  nghiệp / công ty | Reset password');
 });

}

public function sendConfirmEmail($accID, $repreID, $compID)
{
  $acc = Account::Where('id', $accID)->first();
  $repre = Representative::Where('id', $repreID)->first();
  $comp = Company::Where('id', $compID)->first();

  $this->sendMailToResetPassword($repre, $comp, $acc);

}


public function createRepresentative($comp, $compRegis, $acc)
{

  $repre = Representative::create([
   "name" => $compRegis["representative_name"],        
   "email" => $compRegis["representative_email"],
   "phone" => $compRegis["representative_phone"],
   "position" => $compRegis["representative_position"],
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

      //set role for account
 $role = Role::findOrFail(3);
 $role -> accounts() -> attach($acc["id"]);

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