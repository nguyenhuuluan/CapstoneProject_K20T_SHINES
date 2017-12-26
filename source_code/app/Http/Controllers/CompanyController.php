<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Representative;
use App\Account;
use App\Company;

class CompanyController extends Controller
{

	public function CreateRepresentative($companyID)
    {

    	$comp = Company::Where('id', $companyID)->firstOrFail();

    	$number_of_repre = $comp->representatives()->count() + 1;

    	$acc_result = Account::create([
			    		'username'=>$comp['name'] .$number_of_repre,
			    		'password'=>bcrypt(str_random(40)),
			    		'status_id'=>2
			    	]);

    	$repre = new Representative();
		    	$repre["name"] = "Representative of " .$comp['name'];
				$repre["phone"] = $comp['phone'];
				$repre["email"] = $comp['email'];
				$repre["account_id"] = $acc_result['id'];
				$repre["company_id"] = $comp['id'];


    	//Representative::create($repre);

		return $repre;  	
    }



	public function test($companyID)
	{
		return $this->CreateRepresentative($companyID);
	}

    
}
