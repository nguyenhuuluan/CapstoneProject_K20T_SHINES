<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Recruitment;
use App\Category;
//use App\City;
use App\Section;
use App\Account;
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
        return '2';
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $categories  = Category::pluck('name', 'id')->all();
        //$cities  = City::pluck('name', 'id')->all();
        $sections = Section::all();
        return view('recruitments.create',compact('categories', 'sections'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        // return $request;
        $input = $request->all();
        $tmps =  explode( ",",  $input['tags']);

        $user = Account::find(3);
        $data = [
            'title'=>$request->title,
            'salary'=>$request->salary,
            'number_of_view'=>'0',
            'expire_date'=>date("Y-m-d", strtotime($request->date)),
            'is_hot'=>'0',
            'status_id'=>'1',
            'company_id'=>$user->representative->company->id,

        ];

        Recruitment::create($data);
        $request->session()->flash('reply_message','Create Successfull');
        return redirect()->back();

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
}
