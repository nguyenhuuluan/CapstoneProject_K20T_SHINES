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
        $recruitments = Recruitment::all();
        return view ('admin.recruitments.index',compact('recruitments'));
    }
    public function status(Request $request, $id){
        Recruitment::findOrFail($id)->update($request->all());
        return redirect()->back();
    }
    public function preview($id){
        $recruitment = Recruitment::findOrFail($id);
        return view('admin.recruitments.preview',compact('recruitment'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        
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
    public function detailrecruitment($id){

        $recruitment = Recruitment::findOrFail($id);

        return view('recruitments.index',compact('recruitment'));

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
