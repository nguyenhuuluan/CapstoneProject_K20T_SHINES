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

class AdminController extends Controller
{
  public function index()
  {   

    $startDate = Carbon::now()->subYear(2);
    $endDate = Carbon::now();

   // $analyticsData = Analytics::fetchUserTypes(Period::days(150));
  // $analyticsData = Analytics::fetchTopBrowsers(Period::days(150));


  //  return $analyticsData;

    $studentCount = Student::get()->count();
    $companyCount = Company::get()->count();
    $cvCount = Cv::get()->count();
    $recruitmentCount = Recruitment::get()->count();

    return view('admin.index')->with(compact('recruitmentCount','companyCount','cvCount','studentCount'));
  }

  //[13] Loại trình duyệt

  public function fetchTopBrowsers(Request $request)
  {

    $currentDate = date_create(date("Y/m/d"));
    $oldDate = date_create($request->oldDate);

    $diff = date_diff($currentDate,$oldDate)->format("%a");

    return Analytics::fetchTopBrowsers(Period::days($diff));
  }


//[12] Loại người dùng.

  public function fetchUserTypes(Request $request)
  {

    $currentDate = date_create(date("Y/m/d"));
    $oldDate = date_create($request->oldDate);

    $diff = date_diff($currentDate,$oldDate)->format("%a");

    return Analytics::fetchUserTypes(Period::days($diff));
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


public function statisticsNumberOfView()
{

  $array1 = array('viewType' => 'SV Văn Lang','numberOfView' => $this->statisticsNumberOfStudentView(),);
  $array2 = array('viewType' => 'Không là SV Văn Lang','numberOfView' => $this->statisticsNumberOfAnonymousView());

  $arrResult = array($array1, $array2);
  return $arrResult;
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

// [7] [9]
public function statisticsStudentAndCVByFaculty()
{
  $array = array();

  array_push($array, $this->statisticsStudentByFaculty());
  array_push($array, $this->statisticsCVByFaculty());

  return $array;

}

// [7] Thống kê ứng viên theo chuyên ngành đào tạo - Chart hàng ngang hoặc bảng có 2 cột (tên nghành, số lượng ứng viên)

public function statisticsStudentByFaculty()
{
  $arrayResult = array();

  $faculties = Faculty::all();

  foreach ($faculties as $faculty) {
    $facultyName = $faculty->name;
    $studentCount = $faculty->students->count();
    $arrayTmp = array('facultyName' => $facultyName, 'studentCount'=> $studentCount);

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

    $arrayTmp = array('facultyName' => $facultyName, 'cvCount' => 0);

    $students = $faculty->students;

    foreach ($students as $student) {
     $arrayTmp['cvCount'] += $student->cvs->count();
   }

   array_push($arrayResult, $arrayTmp);
 }
 return $arrayResult;

}


private  function orderBy($data, $field)
{
  $code = "return strnatcmp(\$b['$field'],\$a['$field']);";
  usort($data, create_function('$a,$b', $code));
  return $data;
}

// [10] Thống kê 10 (dynamic) Tag phổ biến nhất (được sử dụng nhiều nhất bởi ứng viên) ttrong khoang thoi gian

public function statisticsTagsInStudentByRangeDate(Request $request)
{

  $from = $request->from;
  $to = $request->to;
  $limit = $request->limit;


  if ($limit == '') {
    $limit = Tag::count();
  }
  $tags = new Tag();
  $tags = $tags->with(array('students' => function($sQuery) use($from, $to, $limit){
    $sQuery->whereBetween('students.created_at', array($from, $to));
  }))->take($limit)->get();

  $array2 = array();

  foreach ($tags as $tag) {

    $tagName = $tag->name;
    $usedCount = $tag->students->count();

    $array1 = array('tagName' => $tagName, 'usedCount' =>  $usedCount);

    array_push($array2, $array1);
  }

  $sorted_data = $this->orderBy($array2, 'usedCount');

  return $sorted_data;
}

 //[11] Thống kê 10 (dynamic) Tag được xem nhiều nhất (được gán vào tin tuyển dụng) trong khoang thoi gian - Chart tròn hoặc cột (DONE)
public function statisticsTagsInRecruitmentByRangeDate(Request $request)
{

  $from = $request->from;
  $to = $request->to;
  $limit = $request->limit;

  if ($limit == '') {
    $limit = Tag::count();
  }

  $tags = new Tag();
  $tags = $tags->with(array('recruitments' => function($sQuery) use($from, $to, $limit){
    $sQuery->whereBetween('recruitments.created_at', array($from, $to));
  }))->take($limit)->get();

  $array2 = array();

  foreach ($tags as $tag) {

    $tagName = $tag->name;
    $usedCount = $tag->students->count();

    $array1 = array('tagName' => $tagName, 'usedCount' =>  $usedCount);

    array_push($array2, $array1);
  }

  $sorted_data = $this->orderBy($array2, 'usedCount');

  return $sorted_data;
}



//retrieve visitors and pageview data for the current day and the last seven days


}

