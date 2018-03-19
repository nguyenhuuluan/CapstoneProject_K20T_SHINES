<?php

namespace App\Http\Controllers\Student;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Cv;
use Auth;


class StudentCvController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        if($file = $request->file('cv'))
        {
            $validator = Validator::make($request->all(), [
                'cv' => 'required|mimes:jpeg,png,jpg,pdf,docx,application/vnd.openxmlformats-officedocument.wordprocessingml.document|max:1024',
            ]);
            if ($validator->passes()) 
            {
                $input = $request->except(['cv']);
                $name  = time().$file->getClientOriginalName();
                $input['name'] = $file->getClientOriginalName();
                $input['file'] = $name;
                $input['student_id'] = $id;
                $cv = CV::create($input);
                $file->move('cvs', $name);
                return response($cv);
            }
            else
            {
                return response()->json(['error'=>$validator->errors()->all()]);
            }
        }
        else
        {
            return response()->json(['error'=>'error']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
        $cvs = CV::where('student_id', Auth::user()->student->id)->get();

        return view('ajax.cvList', compact('cvs'));
        // return response($cvs);
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
        $cv = CV::findOrFail($id);
        if(Auth::user()->student->id == $cv->student_id){
            unlink(public_path().'\\cvs\\'.$cv->file);
            $cv->delete();

            return redirect()->back();
        }else
        {return ('123');}
        

    //   if($request->ajax())
    //   {
    //     $cv = CV::findOrFail($request->id);
    //     unlink(public_path().$cv->file);
    //     $cv->delete();
    //     return response(['message'=>'cv deleted successfully!']);
    // }
    // else
    // {
    //     return response(['message'=>'cv deleted error!']);
    // }
    }
}
