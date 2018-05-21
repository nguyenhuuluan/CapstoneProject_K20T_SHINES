<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Faculty;
use App\Company;
use DataTables;
use Validator;
use App\Tag;
use Auth;
class AdminFacultyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->can('faculties.view')){
            return view('admin.faculties.index');
        }
        else{
            return view('errors.admin_auth');
        }
    }

    function getdata()
    {
        if(Auth::user()->can('faculties.view'))
            {
               $faculties = Faculty::with('tags');
               return DataTables()::of($faculties)->addColumn('action', function($faculty){
                $tmp = '<div style="display:grid; grid-template-columns: repeat(2,1fr);grid-gap: 5px">';
                if(Auth::user()->can('faculties.update')){
                    $tmp .='<a href="#" class="btn btn-xs btn-primary edit" id="'.$faculty->id.'"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Edit</a>';
                }
                if(Auth::user()->can('faculties.delete')){
                    $tmp .='<a href="#" class="btn btn-xs btn-danger delete" id="'.$faculty->id.'"><i class="fa fa-trash" aria-hidden="true"></i> Delete</a>';
                }
                // return '<a href="#" class="btn btn-xs btn-primary edit" id="'.$faculty->id.'"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Edit</a>
                // <a href="#" class="btn btn-xs btn-danger delete" id="'.$faculty->id.'"><i class="fa fa-trash" aria-hidden="true"></i> Delete</a>
                // ';
                $tmp .= '</div>';
                return $tmp;
            })->make(true);
           }else
           {return response()->json('error', 400);}

       }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Auth::user()->can('faculties.create')){
            return view('admin.faculties.create');
        }
        else{return view('errors.admin_auth');}
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Auth::user()->can('faculties.create')){
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
            if($request->tags)
            {
                foreach ($tags as $key => $value) 
                {
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
                }
                return redirect(route('faculties.index'))->with('message','Tạo mới Ngành nghề thành công!');
            }
            else{
             return view('errors.admin_auth');
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
        if(Auth::user()->can('faculties.update')){
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
        else{
            return response()->json('error',400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        if(Auth::user()->can('faculties.delete')){
            if(Faculty::find($request->id)->delete())
                {
                    return response()->json('success');
                }
                else
                {
                 return response()->json('error',400);
             }
         }
         else{return response()->json('error',400);}

     }
 }