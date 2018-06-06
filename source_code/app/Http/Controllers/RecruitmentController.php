<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Recruitment;
use App\Category;
//use App\City;
use App\Section;
use App\Account;
use App\Tag;
use App\Company;
use App\Faculty;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\View;
use Carbon;
use DB;
use Auth;


class RecruitmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $per_page_number = 1;
    public function index()
    {
        //
        // $recruitments = Recruitment::all();
        // return view ('admin.recruitments.index',compact('recruitments'));
    }

    public function store(Request $request)
    {   
        //

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }


    public function search(Request $request)
    {       
        //Cắt chuối search
        $texts = explode(",", $request['searchtext']);
        $mytime = Carbon\Carbon::today()->format('Y-m-d');
        $mytime2 = Carbon\Carbon::today()->subMonth()->format('Y-m-d');
        // return $texts;
        $recruitments = Recruitment::with('categories','company', 'sections')
        ->leftjoin('companies', 'company_id', '=', 'companies.id')
        ->leftjoin('section_recruitment', 'recruitments.id', '=', 'section_recruitment.recruitment_id')
        ->select('recruitments.*', 'section_recruitment.content as content')
        ->where('companies.status_id', '=', '3')
        ->where('recruitments.expire_date','>', $mytime)
        ->whereBetween('recruitments.created_at', [$mytime2,$mytime])
        ->where('section_recruitment.section_id', '=', '1')
        ->where('recruitments.status_id', '=', '1')
        ->where(function($q) use ($texts){
            foreach ($texts as $key => $value) {
                $q->orWhere('recruitments.searching', 'like', '%'.$value.'%');
            }
        })
        ->orderBy('recruitments.created_at','desc')
        ->paginate($this->per_page_number);
        //Tổng số kq tìm được
        $total = $recruitments->total();
        //Kiểm tra yều cầu nếu ajax thì trả ra dữ liệu kiểu view
        if($request->ajax()){
            return ['recruitments'=>view('ajax.recruitmentList')->with(compact('recruitments'))->render(),
            'next_page'=>$recruitments->nextPageUrl()];
        }
        
        return view('recruitments.search', compact('recruitments', 'total'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function detailrecruitment($slug, Request $request){

        $mytime = Carbon\Carbon::today()->format('Y-m-d');
        $mytime2 = Carbon\Carbon::today()->subMonth()->format('Y-m-d');
        $currentURL = $request->url();
        $recruitment = Recruitment::where('slug','=',$slug)
        ->where('status_id', '=', 1)
        ->where('expire_date','>', $mytime)
        ->whereBetween('created_at', [$mytime2,$mytime])->get()->first();
        // return $recruitment;

        if($recruitment)
        {
            $tmp = $recruitment->tags->pluck('name');
            $recruitment2 = Recruitment::with('company')
            ->leftjoin('companies', 'company_id', '=', 'companies.id')
            ->select('recruitments.*')
            ->where(function($q) use ($tmp){
                foreach ($tmp as $key => $value) {
                    $q->orWhere('recruitments.searching', 'like', '%'.$value.'%');
                }
            })
            ->where('companies.status_id', '=', '3')
            ->where('recruitments.status_id', '=', '1')
            ->where('recruitments.expire_date','>', $mytime)
            ->whereBetween('recruitments.created_at', [$mytime2,$mytime])
            ->orderBy('recruitments.created_at','DESC')
            ->take(4)->get();
            $tmp = $recruitment->tags->pluck('name');
            Event::fire('recruitment.view', $recruitment);
            return view('recruitments.detail',compact('recruitment', 'currentURL', 'recruitment2'));
        }else{
            abort(404);
        }
    }


//    public function increaseView($recruitmentID)
//    {

//      $recruitment = Recruitment::where('id', $recruitmentID)->first();

//      if (Auth::user() == null ) {
//          $recruitment->number_of_anonymous_view = $recruitment->number_of_anonymous_view + 1;
//      }elseif (Auth::user()->isStudent()) {
//          $recruitment->number_of_view = $recruitment->number_of_view + 1;
//      }else{
//        $recruitment->number_of_anonymous_view = $recruitment->number_of_anonymous_view + 1;
//    }

//    $recruitment->update();


//    return response()->json(200);


// }

}
