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
        return 'dsadas';
        
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
    public function detailrecruitment($slug){

        $recruitment = Recruitment::findBySlugOrFail($slug);
        if($recruitment->status_id==1)
        {
        return view('recruitments.index',compact('recruitment'));

    }else{
        abort(404);

    }

    }
    public function searchtag(Request $request){
        $term = $request['query'];
        $tags = Tag::where('name', 'LIKE', '%'.$term.'%')->get();
        if(count($tags) ==0){
            return 'not tag';
        }else{
            foreach ($tags as $key => $value) {
               $result[] = $value->name;
           }
       }
       return json_encode($result);
   }
}
