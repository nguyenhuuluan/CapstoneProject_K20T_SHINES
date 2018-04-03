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

use DB;
use Auth;


class RecruitmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $per_page_number = 3;
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

        // $text = explode(" ", $request['searchtext']);
        // return $text;

        $recruitments = DB::table('recruitments')
                        ->join('companies', 'recruitments.company_id', '=', 'companies.id')
                        ->join('addresses', 'addresses.company_id', '=', 'companies.id')
                        ->join('districts', 'addresses.district_id', '=', 'districts.id')
                        ->join('cities', 'districts.city_id', '=', 'cities.id')
                        ->join('section_recruitment', 'recruitments.id', '=', 'section_recruitment.recruitment_id')
                        ->join('tag_recruitment', 'recruitments.id', '=', 'tag_recruitment.recruitment_id')
                        ->join('tags', 'tags.id', '=', 'tag_recruitment.tag_id')
                        ->select('recruitments.*', 'section_recruitment.content as content','companies.name as company', 'districts.name as district' ,'addresses.address as address', 'cities.name as city')
                        ->where('section_recruitment.section_id', '=', '1')
                        ->where('recruitments.status_id', '=', '1')
                        ->where(function($q) use ($request){
                                $q->where('recruitments.slug', 'like', '%'.$request['searchtext'].'%')
                                    ->orWhere('tags.name', 'like', '%'.$request['searchtext'].'%');
                                 })
                        ->groupBy(
                            'recruitments.title', 'recruitments.id', 'recruitments.salary', 'recruitments.number_of_view',
                            'recruitments.expire_date','recruitments.is_hot','recruitments.status_id','recruitments.company_id',
                            'recruitments.created_at','recruitments.updated_at','recruitments.slug','section_recruitment.content',
                            'luan_tdvl.companies.name','addresses.address','districts.name', 'cities.name'
                                        )
                        ->orderBy('recruitments.id','ASC')
                        ->paginate($this->per_page_number);

        $total = $recruitments->total();
        if($request->ajax())
        {
            return ['recruitments'=>view('ajax.recruitmentList')->with(compact('recruitments'))->render(),
                    'next_page'=>$recruitments->nextPageUrl()
                    ];
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
    public function detailrecruitment($slug){

        $recruitment = Recruitment::findBySlugOrFail($slug);
        if($recruitment->status_id==1)
        {   
            return view('recruitments.detail',compact('recruitment'));

        }else{
            abort(404);

        }

    }

    public function increaseView($recruitmentID)
    {

        $recruitment = Recruitment::where('id', $recruitmentID)->first();

        if (Auth::user()->isStudent()) {
           $recruitment->number_of_view = $recruitment->number_of_view + 1;
        }else{
             $recruitment->number_of_anonymous_view = $recruitment->number_of_anonymous_view + 1;
        }
        
        $recruitment->update();

        return response()->json(200);
       
    }

}
