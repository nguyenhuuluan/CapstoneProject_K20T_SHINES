<?php

namespace App\Http\Controllers\Representative;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Tag;
use App\Category;
use App\Recruitment;
use App\Section;
use App\Company;
use App\Account;

class RepresentativeRecruitmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct(){
        //$this->middleware('auth')->only(['create','store']);

        //$this->middleware('auth');
    }
    public function index()
    {
        //
        $recruitments = Recruitment::where('company_id', Auth::user()->representative->company->id )->get();
        return view('representative.recruitments.index',compact('recruitments'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $categories  = Category::pluck('name', 'id')->all();
        $sections = Section::all();
        return view('representative.recruitments.create',compact('categories', 'sections', 'places'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {    

        //return $request;
        $tags = explode(',', request('hidden-tags')); 
        $request->request->add(['tags' => $tags]); 
        $sections =  request('sections');

        $this->validate($request,[
            'title'=>'required',
            'salary'=>'required',
            'expire_date'=>'required',
            'category_id'=>'required|array|exists:categories,id',
            //'hidden-tags'=>'required|array|exists:tags,name',
            'tags.*'=>'required|exists:tags,name',
            //'hidden-tags'=>'required',
        ]);


        $user = Account::find(auth()->id());
        //$user = Account::find(auth()->id());
        //$tags = request('hidden-tags');


        $data = [
            'title'=>request('title'),
            'salary'=>request('salary'),
            'number_of_view'=>'0',
            'expire_date'=>date("Y-m-d", strtotime(request('expire_date'))),
            'is_hot'=>'0',
            'status_id'=>'8',
            'company_id'=>$user->representative->company->id,
        ];

        switch (request('submitbutton')) {
            case 'Xem trước':
            $company = Company::findOrFail($data['company_id']);
            $categories = Category::find(request('category_id'));
            foreach ($tags as $key => $value) {
                $tags2[]= Tag::where('name', $value)->first();
            }
            foreach ($sections as $key => $value) {
                $sections[$key] = Section::find($key);
                $sections[$key]['content'] = $value;
            }
            return view('representative.recruitments.preview', compact('data', 'categories', 'tags2', 'company', 'sections'));
            break;
            case 'Đăng tin':
            /* Create Recruitment */

            $recruitment = Recruitment::create($data);

            foreach ($sections as $key => $value) {
                $sections[$key] = Section::find($key);
                 $recruitment->sections()->save(Section::find($key), ['content'=>$value]);
            }

            /*Save categories*/
            foreach (request('category_id') as $key => $value) {
                $recruitment->categories()->save(Category::find($value));
            }

            /*Save tagss*/

            foreach ($tags as $key => $value) {
                $recruitment->tags()->save(Tag::where('name',$value)->first());
            }

            /* Create successful*/
            $request->session()->flash('comment_message','Tạo mới tin tuyển dụng thành công');

            return redirect(route('recruitments.index'));
            //return redirect($recruitment->path());
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
}
