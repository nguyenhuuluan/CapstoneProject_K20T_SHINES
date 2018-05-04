<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Faculty;
use App\Company;
use DataTables;
use Validator;
use App\Tag;
class AdminFacultyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $faculties = Faculty::with('tags')->get();
        // $faculties = Faculty::all();
        // foreach ($faculties as $faculty) {
        //     return $faculty;
        // }
        // return view('admin.faculties.index', compact('faculties'));
        return view('admin.faculties.index');
    }

    function getdata()
    {
       $faculties = Faculty::with('tags');
       return DataTables()::of($faculties)->addColumn('action', function($faculty){
        return '<a href="#" class="btn btn-xs btn-primary edit" id="'.$faculty->id.'"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Edit</a>
        <a href="#" class="btn btn-xs btn-danger delete" id="'.$faculty->id.'"><i class="fa fa-trash" aria-hidden="true"></i> Delete</a>
        ';
    })
        //  ->addColumn('tag', function($faculty)
        //   {
        //     $tmp = '';
        //     foreach ($faculty->tags as $tag)
        //     {
        //         $tmp .=  '<span class="label label-default">'.$tag->name.'</span>';
        //     }
        //     return $tmp;
        // })->rawColumns(['tag', 'action']) 
       ->make(true);
   }

   public function removedata(Request $request)
   {
    return '123';
}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.faculties.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required|unique:faculties,name',
            'description'=>'required',
        ]);
        $tags = explode(',', request('tags')); 
        $data = [
            'name'=>request('name'),
            'description'=>request('description'),
        ];

        $faculty = Faculty::create($data);

        /*Save tagss*/
        foreach ($tags as $key => $value) {
            if(count(Tag::Where('name',$value)->get()) !=0)
                {
                    $faculty->tags()->save(Tag::where('name',$value)->first());
                }
                else
                {
                    $tg = Tag::create(['name'=>$value]);
                    $faculty->tags()->save($tg);
                }
            }
            return redirect(route('faculties.index'))->with('message','Tạo mới Ngành nghề thành công!');
        }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Faculty::with('tags')->find($id);
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
    public function update(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'name' => 'required',
            'description'  => 'required',
        ]);
        
        $error_array = array();
        $success_output = '';
        if ($validation->fails())
        {
            foreach ($validation->messages()->getMessages() as $field_name => $messages)
            {
                $error_array[] = $messages; 
            }
        }
        else
        {
            if($request->get('button_action') == 'insert')
            {

            }

            if($request->get('button_action') == 'update')
            {
                $faculty = Faculty::find($request->get('faculty_id'));
                $faculty->name = $request->get('name');
                $faculty->description = $request->get('description');
                $tags1 = explode(',', request('tags')); 
                $tags2;
                    //change right id key tags
                foreach ($tags1 as $key => $value) {
                    $tmpTag = Tag::where('name', $value)->get();
                        // return $tmpTag->first()['id'];
                        // $tmpTag = Tag::where('name', $value)->first(['id'])['id'];
                    if(count($tmpTag) !=0)
                    {
                        $id =  $tmpTag->first()['id'];
                        $tags2[$id] = $tags1[$key];
                    }
                    else
                    {
                        $tg = Tag::create(['name'=>$value]);
                        $tags2[$tg->id] = $tags1[$key];
                    }
                }
                    //update tags
                $faculty->tags()->sync(array_keys($tags2));
                $faculty->save();
                $success_output = '<div class="alert alert-success">Data Updated</div>';
            }
            
        }
        
        $output = array(
            'error'     =>  $error_array,
            'success'   =>  $success_output,
            'faculty'   =>  $faculty,
            'tag'       => $tags2
        );
        return response()->json($output);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        if(Faculty::find($request->id)->delete())
            {
                return response()->json('success');
            }
            else
            {
             return response()->json('error');
         }
     }
 }