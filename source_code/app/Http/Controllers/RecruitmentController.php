<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Recruitment;
use App\Category;
//use App\City;
use App\Section;
use App\Account;
use App\Tag;
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
        $places = ["PHP", "JS"];
        $categories  = Category::pluck('name', 'id')->all();
        //$cities  = City::pluck('name', 'id')->all();
        $sections = Section::all();
        return view('recruitments.create',compact('categories', 'sections', 'places'));

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

        // $recruitment = Recruitment::find(3);

        return $input;

        // $data = [
        //     'title'=>$request->title,
        //     'salary'=>$request->salary,
        //     'number_of_view'=>'0',
        //     'expire_date'=>date("Y-m-d", strtotime($request->date)),
        //     'is_hot'=>'0',
        //     'status_id'=>'1',
        //     'company_id'=>$user->representative->company->id,
        // ];
        // $recruitment = Recruitment::create($data);

        // $recruitment->sections()->save(Section::find(1), ['content'=>$input['1']]);
        // $recruitment->sections()->save(Section::find(2), ['content'=>$input['2']]);
        // $recruitment->sections()->save(Section::find(3), ['content'=>$input['3']]);
        // $recruitment->sections()->save(Section::find(4), ['content'=>$input['4']]);

        // $recruitment->categories()->save(Category::find($input['category_id']));

        // $request->session()->flash('comment_message','Create Successfull');

        // return redirect()->back();

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
