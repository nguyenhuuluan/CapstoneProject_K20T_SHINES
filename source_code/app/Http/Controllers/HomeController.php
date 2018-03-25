<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Recruitment;
use App\Tag;
use Response;
use DB;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $recruitments = Recruitment::where('status_id', 1)->orderBy('created_at','desc')->take(5)->get();
        return view('welcome', compact('recruitments'));
    }
    public function listRecruitments()
    {   
        $recruitments = DB::table('recruitments')
                        ->join('companies', 'recruitments.company_id', '=', 'companies.id')
                        ->join('addresses', 'addresses.company_id', '=', 'companies.id')
                        ->join('districts', 'addresses.district_id', '=', 'districts.id')
                        ->join('cities', 'districts.city_id', '=', 'cities.id')
                        ->join('section_recruitment', 'recruitments.id', '=', 'section_recruitment.recruitment_id')
                        ->select('recruitments.*', 'section_recruitment.content as content','companies.name as company', 'districts.name as district' ,'addresses.address as address', 'cities.name as city')
                        ->where('section_recruitment.section_id', '=', '1')
                        ->where('recruitments.status_id', '=', '1')
                        ->get();

        // return $recruitments;

        return view('recruitments.list', compact('recruitments'));
    }

}
