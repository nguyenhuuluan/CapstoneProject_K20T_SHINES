<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Recruitment;
use App\Tag;
use App\Company;
use App\Category;
use App\Faculty;
use App\Student;
use App\CV;
use Response;
use DB;

// google analytics
use Analytics;
use Spatie\Analytics\Period;

 use Carbon\Carbon;

class DashboardController extends Controller
{
  public function index()
  { 
$analytdicsData = Analytics::fetchMostVisitedPages(Period::days(7));
     return $analytdicsData;


  }



//[1] Thống kê số lượng tin tuyển dụng được tạo theo thời gian -  Chart Cột hoặc đường
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

// [2] Thống kê số lượng tin tuyển dụng được tạo theo chuyên nghành đào tạo - Chart bảng hoặc hàng ngang (DONE)
public function statisticsNumberOfRecruitmentByAllFaculties(){

  $faculties = Faculty::all();

  $arr1 = array();

  foreach ($faculties as $faculty) {
     $recruitmentIDs = $faculty->tags()
     ->join('tag_recruitment', 'tags.id', '=', 'tag_recruitment.tag_id')
     ->join('recruitments', 'recruitment_id', '=', 'recruitments.id')
     ->pluck('recruitments.id');

     $count = count(array_unique($recruitmentIDs->toArray()));

     $arr2 = array('FacultyName' => $faculty->name, 'RecruitmentCount' => $count);

     array_push($arr1, $arr2);
 }

 return $arr1;
}

//[3] Thống kê số lượng tin tuyển dụng theo loại tin tuyển dụng (full-time hoặc part-time hoặc full-time và part-time) - Chart tròn (DONE)
public function statisticsCategiesOfRecruitments()
{

    $array1 = array('CategoryName' => 'Full-time', 'RecruitmentCount' => 0);
    $array2 = array('CategoryName' => 'Part-time', 'RecruitmentCount' => 0);
    $array3 = array('CategoryName' => 'Intership', 'RecruitmentCount' => 0);
    $array4 = array('CategoryName' => 'Full-time & Part-time', 'RecruitmentCount' => 0);
    $array5 = array('CategoryName' => 'Full-time & Intership', 'RecruitmentCount' => 0);
    $array6 = array('CategoryName' => 'Part-time & Intership', 'RecruitmentCount' => 0);
    $array7 = array('CategoryName' => 'Full-time & Part-time & Intership', 'RecruitmentCount' => 0);

    $recruitments = Recruitment::all();
    foreach ($recruitments as $recruitment) {
      $categories = $recruitment->categories;
      $categoriesCount = $categories->count();

      if ($categoriesCount == 3) {
          $array7['RecruitmentCount'] ++;
      }

      if ($categoriesCount == 2) {

          if (($categories[0]->id == 1 || $categories[0]->id == 2) && ($categories[1]->id == 2 || $categories[1]->id == 1) ) {
            $array4['RecruitmentCount'] ++;
        } 

        if (($categories[0]->id == 1 || $categories[0]->id == 3) && ($categories[1]->id == 3 || $categories[1]->id == 1)) {
          $array5['RecruitmentCount'] ++;
      }   

      if (($categories[0]->id == 2 || $categories[0]->id == 3) && ($categories[1]->id == 3 || $categories[1]->id == 2)) {
          $array6['RecruitmentCount'] ++;
      }       
  }

  if ($categoriesCount == 1) {
   if ($categories[0]->id == 1) {
       $array1['RecruitmentCount'] ++;
   }
   if ($categories[0]->id == 2) {
       $array2['RecruitmentCount'] ++;
   }
   if ($categories[0]->id == 3) {
       $array3['RecruitmentCount'] ++;
   }
}

}

$arrayReturn = array($array1, $array2, $array3, $array4, $array5, $array6, $array7);

return $arrayReturn;
}

//[4] Thống kê tổng số lượt xem tin tuyển dụng đối với ứng viên
public function statisticsNumberOfStudentView()
{
  return Recruitment::sum('number_of_view');
}

//[5] Thống kê tổng số lượt xem tin tuyển dụng đối với KHÔNG là ứng viên
public function statisticsNumberOfAnonymousView()
{
  return Recruitment::sum('number_of_anonymous_view');
}

// [7] Thống kê ứng viên theo chuyên ngành đào tạo - Chart hàng ngang hoặc bảng có 2 cột (tên nghành, số lượng ứng viên)

public function statisticsStudentByFaculty()
{
    $arrayResult = array();

    $faculties = Faculty::all();

    foreach ($faculties as $faculty) {
        $facultyName = $faculty->name;
        $studentCount = $faculty->students->count();
        $arrayTmp = array('facultyName' => $facultyName, 'studentCount '=> $studentCount);

        array_push($arrayResult, $arrayTmp);
    }

    return $arrayResult;
}

// [9] Thống kê số lượng CV của ứng viên theo chuyên nghành đào tạo - Chart hàng ngang hoặc bảng có 2 cột (tên nghành, số lượng CV) (DONE)
public function statisticsCVByFaculty()
{
    $arrayResult = array();

    $faculties = Faculty::all();

    foreach ($faculties as $faculty) {
        $facultyName = $faculty->name;

        $arrayTmp = array('facultyName' => $facultyName, 'studentCount' => 0);

        $students = $faculty->students;

        foreach ($students as $student) {
         $arrayTmp['studentCount'] += $student->cvs->count();
     }

     array_push($arrayResult, $arrayTmp);
 }
 return $arrayResult;

}



// [10] Thống kê 10 (dynamic) Tag phổ biến nhất (được sử dụng nhiều nhất bởi ứng viên) ttrong khoang thoi gian
public function statisticsTagsInStudentByRangeDate($from, $to, $limit)
{

   $tags = new Tag();
   $tags = $tags->with(array('students' => function($sQuery) use($from, $to, $limit){
      $sQuery->whereBetween('students.created_at', array($from, $to));
  }))->get();

   return $tags;
}

 //[11] Thống kê 10 (dynamic) Tag được xem nhiều nhất (được gán vào tin tuyển dụng) trong khoang thoi gian - Chart tròn hoặc cột (DONE)
public function statisticsTagsInRecruitmentByRangeDate($from, $to, $limit)
{

   $tags = new Tag();
   $tags = $tags->with(array('recruitments' => function($sQuery) use($from, $to, $limit){
      $sQuery->whereBetween('recruitments.created_at', array($from, $to));
  }))->take($limit)->get();

   return $tags;
}

//retrieve visitors and pageview data for the current day and the last seven days




}
