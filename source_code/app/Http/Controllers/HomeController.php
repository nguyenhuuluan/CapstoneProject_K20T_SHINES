<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Recruitment;
use App\Tag;
use App\Company;
use App\Student;
use App\Cv;
use Response;
use DB;
use App\Blog;
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

        $recruitments= Recruitment::with('categories', 'company', 'tags')
                                    ->join('companies','recruitments.company_id', '=', 'companies.id')
                                    ->where('recruitments.status_id', 1)
                                    ->where('companies.status_id', '=', '3')
                                    ->select('recruitments.*')
                                    ->orderBy('recruitments.created_at','desc')
                                    ->take(5)->get();

        $blogs = Blog::with('tags','owner.staff')->orderBy('created_at','desc')->take(3)->get();



        // $recruitments = DB::table('recruitments')
        //                 ->join('companies','recruitments.company_id', '=', 'companies.id')
        //                 ->select('recruitments.*', 'companies.logo')
        //                 ->where('companies.status_id', '=', '3')
        //                 ->where('recruitments.status_id', '=', '1')
        //                 ->orderBy('created_at','desc')->take(5)->get();



        // $companies =Company::where('status_id', 3)->orderBy('created_at','desc')->take(8)->get();
        $companies = Company::with('address.district.city')->where('is_hot', true)->get();
        // $companies =Company::with (['address.district.city' => function ($query) {
        //      $query->where('companies.status_id', 3)->orderBy('created_at','desc')->take(8);
        //     }])->get();


        $totalRecruitments = Recruitment::where('status_id', 1)->count();
        $totalStudents = Student::count();
        $totalCVs = Cv::count();
        $totalCompanies = Company::count();

        // $companies = Company::where('status_id', 3)->orderBy('created_at','desc')->take(8)->get();

        return view('welcome', compact('recruitments','blogs','companies','totalRecruitments','totalStudents','totalCVs','totalCompanies'));
    }

    public function contact()
    {
        return view('contact');
    }
    public function detailblog($slug)
    {
        $blog = Blog::findBySlugOrFail($slug);
        return view('blogs.detail', compact('blog'));
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
        $total = $recruitments->total();
        if($request->ajax())
        {
            return ['recruitments'=>view('ajax.recruitmentList')->with(compact('recruitments'))->render(),
                    'next_page'=>$recruitments->nextPageUrl()
                    ];
        }
        return view('recruitments.list', compact('recruitments', 'total'));
    }

    public function loadListRecruitments()
    {

    }

}
