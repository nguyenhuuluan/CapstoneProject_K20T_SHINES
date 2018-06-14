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
use Carbon;
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
        $mytime = Carbon\Carbon::today()->format('Y-m-d');
        $mytime2 = Carbon\Carbon::today()->subMonth()->format('Y-m-d');


        $recruitments= Recruitment::with('categories', 'company', 'tags')
        ->join('companies','recruitments.company_id', '=', 'companies.id')
        ->where('recruitments.expire_date','>', $mytime)
        ->where('recruitments.status_id', 1)
        ->where('companies.status_id', '=', '3')
        ->whereBetween('recruitments.created_at', [$mytime2,$mytime])
        ->select('recruitments.*')
        ->orderBy('recruitments.created_at','desc')
        ->take(5)->get();

        // return $recruitments;
        $blogs = Blog::with('tags','owner.staff')->orderBy('created_at','desc')->take(3)->get();
        $companies = Company::with('address.district.city')
        ->where('is_hot', true)
        ->where('status_id','=',3)
        ->get();

        $totalRecruitments = Recruitment::where('status_id', 1)
        ->where('expire_date','>', $mytime)
        ->whereBetween('created_at', [$mytime2,$mytime])
        ->count();
        $totalStudents = Student::count();
        $totalCVs = Cv::count();
        $totalCompanies = Company::count();

        return view('welcome', compact('recruitments','blogs','companies','totalRecruitments','totalStudents','totalCVs','totalCompanies'));
    }

    public function contact()
    {
        return view('contact');
    }
    public function detailblog($slug)
    {
        $blog = Blog::findBySlugOrFail($slug);
        $blogs = Blog::where('slug','!=', $slug)->orderBy('created_at','desc')->take(3)->get();
        return view('blogs.detail', compact('blog','blogs'));
    }

    
    public function listRecruitments(Request $request)
    {   
     $mytime = Carbon\Carbon::today()->format('Y-m-d');
     $mytime2 = Carbon\Carbon::today()->subMonth()->format('Y-m-d');

     $recruitments = Recruitment::with('categories','company', 'sections')
     ->leftjoin('companies', 'company_id', '=', 'companies.id')
     ->leftjoin('section_recruitment', 'recruitments.id', '=', 'section_recruitment.recruitment_id')
     ->select('recruitments.*', 'section_recruitment.content as content')
     ->where('companies.status_id', '=', '3')
     ->where('recruitments.expire_date','>', $mytime)
     ->whereBetween('recruitments.created_at', [$mytime2,$mytime])
     ->where('recruitments.expire_date','>', $mytime)
     ->where('section_recruitment.section_id', '=', '1')
     ->where('recruitments.status_id', '=', '1')
     ->orderBy('recruitments.created_at','desc')
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

public function testupload(Request $request)
{
    // return $request->all();
    $data = $request->image;
    list($type, $data) = explode(';', $data);
    // return $type;
    list(, $data)      = explode(',', $data);
    // return '123';
    // return $data;
    $data = base64_decode($data);
    $imageName = time().'.png';
    return file_put_contents('assets/'.$imageName, $data);
    if(file_put_contents('assets/'.$imageName, $data))
        {return '123';}
    else
        {return 'false';}
            // echo "Image Uploaded";
}

}
