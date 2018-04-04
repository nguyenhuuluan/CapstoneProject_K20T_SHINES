<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\Collection;

use App\Representative;
use App\Account;
use App\Company;
use App\Recruitment;
use App\CompanyRegistration;
use App\Role;
use App\SocialNetwork;
use App\City;
use App\District;
use App\Address;
use App\Tag;
use App\CompaniesSocialNetwork;
use App\Photo;
use File;

use Auth;


use App\Http\Requests\CompanyRequest;
use Mail;
use GuzzleHttp\Client;



class CompanyController extends Controller
{

  public function detail($id)
  {
    $comp = Company::where('id', '=', $id)->first();
    $recruitments = $comp->recruitments()->where('status_id', 1)->orderBy('created_at','desc')->get();
    
    return view('companies.detail')->with(compact('comp', 'recruitments'));
}

public function update()
{
    $id = Auth::user()->representative->company->id;
    $company = Company::findOrFail($id);

    $cities = City::all();
    $tags = $company->tags()->pluck('name')->toArray();

    $districts = District::where('city_id' , count($company->address) != 0 ? $company->address->district->city->id :$cities[0]->id )->get()->sortBy('name');

    return view('companies.update')->with(compact('company','cities','districts','tags'));

}

public function edit($id, CompanyRequest $request)
{ 


    $client = new Client();

    $res = $client->request('GET', 'https://maps.google.com/maps/api/geocode/json?key=AIzaSyBTKdxpxRWTD9UnpMVrGfdnNCmFZLde8Rw&address='.$request->address. $request->districtname. $request->cityname);

    $jsonObj  = json_decode($res->getBody());  

    if ($jsonObj->status != 'OK') {
      $request->session()->flash('address-invalid', '<span> Địa chỉ không tồn tại </span>');
      return redirect()->route("company.update")->withInput();
  }


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

   // $intersect = array_intersect($tags,$currenttags);
  $diff = array_diff($tags,$currenttags);

  if (count($diff) != 0) {
     foreach ($diff as $value) {
      $tag = Tag::create([
        "name" => $value
    ]);
  }
}

$collectionTags = collect();
// $collectionTags = collect([]);

foreach ($tags as $tag) {
   $collectionTags->push(Tag::where('name', $tag)->first());
}


$comp->tags()->sync((Tag::all()->intersect($collectionTags)));

if ( !empty(trim($request->facebook)) ) {
  if ($request->socialnetworkfbID) {
    $social = CompaniesSocialNetwork::findOrFail($request->socialnetworkfbID);
    $social->url = $request->facebook;
    $social->company_id = $request->id;

    $social->save();
}else{
   $social = CompaniesSocialNetwork::create([
    "name" => "Facebook",
    "url" => $request->facebook,
    "company_id" => $request->id
]); 
}
}else{
  $social = CompaniesSocialNetwork::findOrFail($request->socialnetworkfbID);
  $social->delete();
}


if (!empty(trim($request->linkedin))) {
  if ($request->socialnetworkinID) {
    $social = CompaniesSocialNetwork::findOrFail($request->socialnetworkinID);
    $social->url = $request->linkedin;
    $social->company_id = $request->id;

    $social->save();
}else{
   $social = CompaniesSocialNetwork::create([
    "name" => "LinkedIn",
    "url" => $request->linkedin,
    "company_id" => $request->id
]); 
}

}else{
  $social = CompaniesSocialNetwork::findOrFail($request->socialnetworkinID);
  $social->delete();
}

return redirect()->route("company.details",['id' => $comp->id]);

}


public function details($id)
{
  $company = Company::findOrFail($id);
  $socials = CompaniesSocialNetwork::where('company_id',$company->id)->get()->sortBy('name');
  $recruitments = $company->recruitments()->where('status_id', 1)->orderBy('created_at','desc')->get();

  return view('companies.details')->with(compact('company','socials', 'recruitments'));
}

public function updateImages(Request $request)
{

  if($files = $request->file('Images'))
  {


   $validator = Validator::make($request->all(), [
     'imagefile' => 'image|mimes:jpeg,png,jpg|max:1024',
 ]);


   if ($validator->passes()) {

    $comp = Company::Where('id', $request->id)->first();

    $arrayFileNames = array();

    foreach ($files as $file) {

      $fileName = time().'_'.$file->getClientOriginalName();

      $photo = Photo::create([
        "name" => $fileName
    ]);

      array_push($arrayFileNames, $fileName);

      $comp->photos()->attach($photo->id);

      $file->move('images/companies', $fileName);

  }

  return response()->json($arrayFileNames);

}else  {
   return response()->json(['error'=>$validator->errors()->all()]);
}
return response()->json(200);
}

}

public function deleteImage(Request $request)
{
    // unlink(base_path()."/images/companies/public_html/'.$ImageName);
     unlink(public_path()."/images/companies/".$request->ImageName);

    $photo = Photo::where('name', $request->ImageName);

    $photo->delete();

    return response()->json(200);
}

public function updateLogo(Request $request)
{

  if($file = $request->file('imagefile'))
  {
    $validator = Validator::make($request->all(), [
      'imagefile' => 'required|image|mimes:jpeg,png,jpg|max:1024',
  ]);

    if ($validator->passes()) 
    { 

      $comp = Company::Where('id', $request->id)->first();
      $name  = time().'_'.$file->getClientOriginalName();

      if( strpos($comp->logo, 'default-company-logo.jpg') == false )
      {
          // unlink(base_path().'/public_html/'.$student->photo);
        unlink(public_path().$comp->logo);

        //  return "OK";
    }

    $comp->logo = $name;
    $comp->update();

    $file->move('images/companies/logos', $name);

    return response()->json(200);
}
else
{
  return response()->json(['error'=>$validator->errors()->all()]);
}
}
else
{
   return response()->json(500);
}
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

      //tao du lieu address tam thoi
  $address = Address::create(
    [
      "address"=> '45 Nguyễn Khắc Nhu',
      "latitude"=> 11111,
      "longtitude"=> 11111,
      "company_id"=> $comp->id,
      "district_id"=> 1,
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

public function statistic()
{
  $currentcompID = Auth::user()->representative->company->id;
  $recruitcount = Recruitment::where('company_id', $currentcompID)->count();

  $studentview = Recruitment::where('company_id', $currentcompID)->pluck('number_of_view')->sum();

  $anonymousview = Recruitment::where('company_id', $currentcompID)->pluck('number_of_anonymous_view')->sum();

  return view ('representative.index',compact('$recruitcount', '$studentview', '$anonymousview'));

}


}