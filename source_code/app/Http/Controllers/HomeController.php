<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Recruitment;
use App\Tag;
use App\Company;
use Response;
use DB;
class HomeController extends Controller
{   
    protected $per_page_number = 1; 
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

        $recruitments= Recruitment::join('companies','recruitments.company_id', '=', 'companies.id')
                                    ->where('recruitments.status_id', 1)
                                    ->where('companies.status_id', '=', '3')
                                    ->select('recruitments.*')
                                    ->orderBy('recruitments.created_at','desc')
                                    ->take(5)->get();


        // $recruitments = DB::table('recruitments')
        //                 ->join('companies','recruitments.company_id', '=', 'companies.id')
        //                 ->select('recruitments.*', 'companies.logo')
        //                 ->where('companies.status_id', '=', '3')
        //                 ->where('recruitments.status_id', '=', '1')
        //                 ->orderBy('created_at','desc')->take(5)->get();



        // $companies =Company::where('status_id', 3)->orderBy('created_at','desc')->take(8)->get();
        $companies =Company::with('address.district.city')->where('status_id', 3)->orderBy('created_at','desc')->take(8)->get();
        // $companies =Company::with (['address.district.city' => function ($query) {
        //      $query->where('companies.status_id', 3)->orderBy('created_at','desc')->take(8);
        //     }])->get();

        return view('welcome', compact('recruitments', 'companies'));
    }

    
    public function listRecruitments(Request $request)
    {   

        $recruitments = Recruitment::with('categories','company', 'sections')
                        ->leftjoin('companies', 'company_id', '=', 'companies.id')
                        ->leftjoin('section_recruitment', 'recruitments.id', '=', 'section_recruitment.recruitment_id')
                        ->select('recruitments.*', 'section_recruitment.content as content')
                        ->where('companies.status_id', '=', '3')
                        ->where('section_recruitment.section_id', '=', '1')
                        ->where('recruitments.status_id', '=', '1')
                        ->orderBy('recruitments.id','ASC')
                        ->paginate($this->per_page_number);

        // $recruitments = DB::table('recruitments')
        //                 ->leftjoin('companies', 'recruitments.company_id', '=', 'companies.id')
        //                 ->leftjoin('addresses', 'addresses.company_id', '=', 'companies.id')
        //                 ->leftjoin('districts', 'addresses.district_id', '=', 'districts.id')
        //                 ->leftjoin('cities', 'districts.city_id', '=', 'cities.id')
        //                 ->leftjoin('section_recruitment', 'recruitments.id', '=', 'section_recruitment.recruitment_id')
        //                 ->select('recruitments.*', 'section_recruitment.content as content','companies.name as company', 'districts.name as district' ,'addresses.address as address', 'cities.name as city')
        //                 ->where('section_recruitment.section_id', '=', '1')
        //                 ->where('companies.status_id', '=', '3')
        //                 ->where('recruitments.status_id', '=', '1')
        //                 ->orderBy('recruitments.id','ASC')
        //                 ->paginate($this->per_page_number);

       // return $recruitments;
        $total = $recruitments->total();
        if($request->ajax())
        {
            return ['recruitments'=>view('ajax.recruitmentList')->with(compact('recruitments'))->render(),
                    'next_page'=>$recruitments->nextPageUrl()
                    ];
        }

        return view('recruitments.list', compact('recruitments', 'total'));
    }

}
