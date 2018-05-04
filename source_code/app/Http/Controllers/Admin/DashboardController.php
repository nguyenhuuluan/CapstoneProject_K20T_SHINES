<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Recruitment;
use App\Tag;
use App\Company;
use App\Student;
use App\CV;
use Response;
use DB;


use Carbon\Carbon;
require '../vendor/autoload.php';
class DashboardController extends Controller
{

    public function index()
    {   

        $to = Carbon::now();

        return $this->statisticsNumberOfRecruitmentByYear(2018);

       // return $this->statisticsTagsInStudentByRangeDate('2017-05-01 23:55:36.281479',$to,4);
    }

    public function statisticsTagsInRecruitmentByRangeDate($from, $to, $limit)
    {

       $tags = new Tag();
       $tags = $tags->with(array('recruitments' => function($sQuery) use($from, $to, $limit){
        $sQuery->whereBetween('recruitments.created_at', array($from, $to));
    }))->take($limit)->get();

       return $tags;
   }

   public function statisticsTagsInStudentByRangeDate($from, $to, $limit)
    {

       $tags = new Tag();
       $tags = $tags->with(array('students' => function($sQuery) use($from, $to, $limit){
        $sQuery->whereBetween('students.created_at', array($from, $to));
    }))->get();

       return $tags;
   }


    // Thống kê số lượng tin tuyển dụng được tạo theo thời gian -  Chart Cột hoặc đường
   public function statisticsNumberOfRecruitmentByYear($year)
   {

    $recruitments = Recruitment::select('id', 'created_at')->whereYear('created_at', $year)
    ->get()
    ->groupBy(function($date) {
            //return Carbon::parse($date->created_at)->format('Y'); // grouping by years
            return Carbon::parse($date->created_at)->format('m'); // grouping by months
        });

    $recruitCount = [];
    $recruitArr = [];

    foreach ($recruitments as $key => $value) {
        $recruitCount[(int)$key] = count($value);
    }

    for($i = 1; $i <= 12; $i++){
        if(!empty($recruitCount[$i])){
            $recruitArr[$i] = $recruitCount[$i];    
        }else{
            $recruitArr[$i] = 0;    
        }
    }

    return $recruitArr;
}

    // Thống kê tổng số lượt xem tin tuyển dụng đối với ứng viên
public function statisticsNumberOfStudentView()
{
    return Recruitment::sum('number_of_view');
}

    // Thống kê tổng số lượt xem tin tuyển dụng đối với KHÔNG là ứng viên
public function statisticsNumberOfAnonymousView()
{
    return Recruitment::sum('number_of_anonymous_view');
}

public function statisticsCVByFaculty($value='')
{
    
}


}
