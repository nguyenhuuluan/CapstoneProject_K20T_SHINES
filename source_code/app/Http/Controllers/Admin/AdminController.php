<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Recruitment;
use App\Tag;
use App\Company;
use App\Faculty;
// use Response;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $companies = Company::with('tags','recruitments')->get()->pluck('tags', 'name');
        $faculties = Faculty::with('tags')->get()->pluck('tags', 'name');
        //tao mang chua tag cua faculty, company
        $tagFal = array();
        $tagCom = array();
        //Chay vong lap tung faculty de lay danh sach tag
        foreach ($faculties as $key1 => $value1) {
            //Tao mang tam chua gia tri tag cua faculty
            $tmp2 = array_column($faculties[$key1]->all(), 'name');
            //Tao mang chua danh sach id company co chung tag voi faculty
            $company_id = array();
            
            foreach ($companies as $key2 => $value2) {
                //Tao mang tam chua gia tri tag cua company
                $tmp3 = array_column($companies[$key2]->all(), 'name');
                //Tao mang tam chua gia tri phan tu chung cua Company hien tai voi Faculty hien tai
                $tmp4 = array_intersect($tmp3,$tmp2);
                //Nếu có phần tử chung thì push vào mảng danh sach cong ty id công ty trùng;
                if(count($tmp4)>0)
                {
                    //Push mảng chứa key là id, value là tên công ty 
                    $company_id[$value2->first()->pivot->company_id] = $key2;
                }
            } 
           //Push gia trị tên Faculty vào mảng tạm tmp2
            $tmp2[] = $key1;
           //Push danh sach Company id vao mảng tạm tmp2 chưa danh sach tag Faculty;
            $tmp2['company_list'] = $company_id;
            $tmp2['total'] = count($company_id);
           //Push giá trị mảng tạm tmp2 vào danh sach tag của Faculty
            $tagFal[] = $tmp2;
        }
        return $tagFal;
        
        return view('admin.index');
    }

}
