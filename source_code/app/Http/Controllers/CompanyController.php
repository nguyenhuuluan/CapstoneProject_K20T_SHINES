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

  public function edit(CompanyRequest $request)
  // public function edit(Request $request)
  { 
    // return '123';
    // return '11'.trim($request->facebook).'123';
 // if (!empty(trim($request->facebook)) ) {
    // if ($request->facebook){
    //   return '123';
    // }
    // else{return '321';}

    // return '111';
    $comp = Company::with('address')->withCount('address')->findOrFail($request->id);
    $comp->name = $request->name;
    $comp->website = $request->website;
    $comp->email = $request->compEmail;
    $comp->phone = $request->phone;
    $comp->working_day = $request->working_day;
    $comp->field = $request->field;
    $comp->business_code = $request->business_code;
    $comp->introduce = $request->introduce;
    $comp->save();

    $currenttags = array_map('strtolower', Tag::pluck('name')->toArray());
    $tags = array_map('strtolower', array_map('trim', explode(",", $request->tags)));
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
 // return $tags;
 // return $comp;

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


    // $comp = Company::with('address')->withCount('address')->findOrFail($request->id);
$compaddress = $comp->address;
if(!$comp->address_count)
{
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


if ($request->socialnetworkfbID && $request->facebook){
  // return 'cập nhật';
  $social = CompaniesSocialNetwork::findOrFail($request->socialnetworkfbID);
  $social->url = $request->facebook;
  $social->company_id = $request->id;
  $social->save();
}elseif(!$request->socialnetworkfbID && $request->facebook){
  // return 'dky mới';
  $social = CompaniesSocialNetwork::create([
    "name" => "Facebook",
    "url" => $request->facebook,
    "company_id" => $request->id
  ]); 
}elseif($request->socialnetworkfbID && !$request->facebook){
  // return 'xóa fb';
  $social = CompaniesSocialNetwork::findOrFail($request->socialnetworkfbID);
  $social->delete();
}
// elseif(!$request->socialnetworkfbID && !$request->facebook){
//   return 'chưa có gì';  
// }


if ($request->socialnetworkinID && $request->linkedin){
  // return 'cập nhật';
  $social = CompaniesSocialNetwork::findOrFail($request->socialnetworkinID);
  $social->url = $request->linkedin;
  $social->company_id = $request->id;
  $social->save();
}elseif(!$request->socialnetworkinID && $request->linkedin){
  // return 'dky mới';
  $social = CompaniesSocialNetwork::create([
    "name" => "Facebook",
    "url" => $request->linkedin,
    "company_id" => $request->id
  ]); 
}elseif($request->socialnetworkinID && !$request->linkedin){
  // return 'xóa fb';
  $social = CompaniesSocialNetwork::findOrFail($request->socialnetworkinID);
  $social->delete();
}
// elseif(!$request->socialnetworkinID && !$request->linkedin){
//   return 'chưa có gì';  
// }


return redirect()->route("company.details",$comp->slug);

}


public function details($slug)
{


  //$currentURL = $request->url();

 // $company = Company::findBySlugOrFail($slug);
 $company = Company::with(['recruitments' => function ($query) {
   $query->with('sections', 'categories', 'tags')
   ->where('recruitments.status_id', 1)->orderBy('created_at','desc');
 },'sections', 'socialNetworks', 'tags', 'photos'])
 ->where('slug', '=', $slug)->first();

// return $company;
 if($company->status_id==3)
 {
   // $socials = CompaniesSocialNetwork::where('company_id',$company->id)->get()->sortBy('name');
   // $recruitments = $company->recruitments()->where('status_id', 1)->orderBy('created_at','desc')->get();
   return view('companies.details')->with(compact('company'));
   //return view('companies.details',compact('company', 'currentURL'));

 }
 else{abort(404);}

}

public function updateImages(Request $request)
{

  if($files = $request->file('Images'))
  {


   $validator = Validator::make($request->all(), [
     'imagefile' => 'image|mimes:jpeg,png,jpg|max:5120',
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



public function deleteImage($imageName)
{

  // cài này trên host
 // unlink(base_path()."/public_html/images/companies/".$imageName);



  // cái này ở local
 unlink(public_path()."/images/companies/".$imageName);
 
 $photo = Photo::where('name', $imageName);

 $photo->delete();

 return response()->json(200);
}

public function updateLogo(Request $request)
{

  if($request->id == Auth::user()->representative->company->id ){
    $data = $request->image;
    list($type, $data) = explode(';', $data);
    list(, $data)      = explode(',', $data);
    $data = base64_decode($data);
    $imageName = time().'.png';
    try{
      if(file_put_contents('images/companies/logos/'.$imageName, $data))
      {
                //Kiểm tra ảnh có phải ảnh mặc định không
       $comp = Company::findOrFail($request['id']);
       if(!strpos($comp->logo, 'default-company-logo.jpg'))
       {
        //chay tren host
        //unlink(base_path().'/public_html/'.$comp->logo);
         unlink(public_path().$comp->logo);
       }
       $comp->logo = $imageName;
       $comp->update();
       return response()->json($comp->logo);
     }else{
        //Lưu Ảnh không thành công
      return response()->json(['error'=>'Lưu ảnh không thành công']);
    }
  }
  catch(Exception $e)
  {return $e;}
}

}

public function index()
{

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