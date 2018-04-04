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
use Auth;

class RecruitmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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

       $currentURL = $request->url();

       $recruitment = Recruitment::findBySlugOrFail($slug);

       if($recruitment->status_id==1)
       {
        return view('recruitments.detail',compact('recruitment', 'currentURL'));

    }else{
        abort(404);

    }

}

public function totalRecruitments()
{
 $total = Recruitment::where('status_id', 1)->get()->count();

 return response()->json($total);
}

public function increaseView($recruitmentID)
{

    $recruitment = Recruitment::where('id', $recruitmentID)->first();

    if (Auth::user() == null ) {
     $recruitment->number_of_anonymous_view = $recruitment->number_of_anonymous_view + 1;
 }elseif (Auth::user()->isStudent()) {
     $recruitment->number_of_view = $recruitment->number_of_view + 1;
 }else{
   $recruitment->number_of_anonymous_view = $recruitment->number_of_anonymous_view + 1;
}

$recruitment->update();

return response()->json(200);

}

}
