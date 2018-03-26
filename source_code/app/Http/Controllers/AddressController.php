<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\City;
use App\District;

class AddressController extends Controller
{
	public function getDistricts($cityID)
	{		

		$districts = District::where('city_id', $cityID)->get()->sortBy('name');

		return response()->json(
			$districts
		);

		//return view('companies.update')->with(compact('company','cities'));

	}
}
