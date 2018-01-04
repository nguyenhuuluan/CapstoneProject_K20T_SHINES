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

        $input = $request->all();
        $user = Account::find(3);
        $tags = explode(',', $input['hidden-tags']); 
        $data = [
            'title'=>$request->title,
            'salary'=>$request->salary,
            'number_of_view'=>'0',
            'expire_date'=>date("Y-m-d", strtotime($request->date)),
            'is_hot'=>'0',
            'status_id'=>'1',
            'company_id'=>$user->representative->company->id,
        ];

        switch ($request->submitbutton) {
            case 'Xem trước':
            $company = Company::findOrFail($data['company_id']);
            $categories = Category::find($input['category_id']);
            foreach ($tags as $key => $value) {
                $tags2[]= Tag::where('name', $value)->first();
            }

            $sections[1] = Section::find(1);
            $sections[2] = Section::find(2);
            $sections[3] = Section::find(3);
            $sections[4] = Section::find(4);
            foreach ($sections as $key => $value) {
                $value['content'] = $input[$key];
            }
            return view('recruitments.preview', compact('data', 'categories', 'tags2', 'company', 'sections'));
            break;
            case 'Đăng tin':
            /* Create Recruitment */
            $recruitment = Recruitment::create($data);
            $recruitment->sections()->save(Section::find(1), ['content'=>$input['1']]);
            $recruitment->sections()->save(Section::find(2), ['content'=>$input['2']]);
            $recruitment->sections()->save(Section::find(3), ['content'=>$input['3']]);
            $recruitment->sections()->save(Section::find(4), ['content'=>$input['4']]);
            /*Save categories*/
            foreach ($input['category_id'] as $key => $value) {
                $recruitment->categories()->save(Category::find($value));
            }
            /*Save tagss*/
            foreach ($tags as $key => $value) {
                $recruitment->tags()->save(Tag::where('name',$value)->first());
            }
            /* Create successful*/
            $request->session()->flash('comment_message','Create Successfull');

            return redirect()->back();
            break;
        }
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
