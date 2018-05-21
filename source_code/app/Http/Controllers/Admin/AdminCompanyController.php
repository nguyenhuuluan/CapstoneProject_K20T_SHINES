<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Company;
use Auth;
use App\Address;
use App\CompanyRegistration;
use Mail;
use App\Account;
use App\Role;
use App\Representative;


class AdminCompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->can('companies.view'))
            {
             $comps = Company::all();
             return view('admin.companies.index',compact('comps'));
         }
         else{
            return view('errors.admin_auth');
        }

    }

    public function companyRegistration()
    {
        if(Auth::user()->can('companies.update'))
            {
               $compsRegis = CompanyRegistration::all();
               return view('admin.companies.company-registration', compact('compsRegis'));
           }
           else{
            return view('errors.admin_auth');
        }
    } 


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }


    public function show($id)
    {
        //
    }

    public function approveCompany($companyID)
    {   
        if(Auth::user()->can('companies.update')){
            $compRegis = CompanyRegistration::where('id', $companyID)->first();
            $compRegis -> status_id = 7;
            $compRegis -> save();
            $comp = new Company();
            $comp = $this->createCompany($compRegis);
            $account = new Account();
            $account = $this->createAccountRepresentative($compRegis);
            $repre = new Representative();
            $repre = $this->createRepresentative($comp, $compRegis, $account);
            return $repre;
        }
        else{return response()->json('error',400);}
        
    }

    public function sendConfirmEmail($accID, $repreID, $compID)
    {
       $acc = Account::Where('id',$accID)->first();
       $repre = Representative::Where('id',$repreID)->first();
       $comp = Company::Where('id',$compID)->first();
       $this->sendMailToResetPassword($repre,$comp,$acc);
   }

   public function setActiveCompany($id)
   {
    if(Auth::user()->can('companies.update'))
        {
            $comp = Company::Where('id', $id)->first();
            if ($comp->status_id != 3)
               {$comp->status_id = 3;}
           else{$comp->status_id = 4;}
           $comp->save();     
           return $comp;
       }
       else{return response()->json('error',400);}

   }

   public function setIsHotCompany($id)
   {
    if(Auth::user()->can('companies.update'))
        {
            $isHotCompCount = Company::Where('is_hot', true)->count();
            if($isHotCompCount >=8){
                return response()->json('error',400);
            }
            $comp = Company::Where('id', $id)->first();
            if($comp->is_hot == true){$comp->is_hot = false;}
            else{$comp->is_hot = true;}
            $comp->save();     
            return $comp;
        }
        else{return response()->json('error',400);}

    }

    protected function createAccountRepresentative($compRegis)
    {
       $acc = Account::create([
          'username'=>$compRegis["representative_email"],
          'password'=>bcrypt(str_random(40)),
          'status_id'=>5,
      // set active account
          'remember_token'=>str_random(40)
      ]);
      //set role for account
       $role = Role::findOrFail(3);
       $role -> accounts() -> attach($acc["id"]);
       return $acc;
   }


   public function edit($id)
   {

   }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    
    protected function createCompany($compRegis)
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

   protected function createRepresentative($comp, $compRegis, $acc)
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

  protected function sendMailToResetPassword($represen, $com, $acc)
  {
    Mail::send('admin.representatives.email-confirm',
       ['company' => $com, 'representative' => $represen,'account' => $acc],
       function ($message) use($represen){
         $message->to($represen['email'])->subject('Chấp thuận doanh  nghiệp / công ty | Reset password');
     });
}
}
