<?php

namespace App\Http\Controllers\Student;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Cv;
use Auth;
use Response;

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
                $cvs[] = $cv;
                $file->move('cvs', $name);

                // return response($cv);
                return ['cvs'=>view('ajax.cvList')->with(compact('cvs'))->render()];
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

    public function download($name)
    {   
        //return $name;
        $cv = CV::where('file',$name)->first();

               //chay tren host
      //  return response()->file(base_path().'/public_html/cvs/'.$cv->file, [
      //     'Content-Disposition' => 'inline; filename="'. $cv->name .'"'
      // ]);

        return response()->file(public_path().'\\cvs\\'.$cv->file, [
          'Content-Disposition' => 'inline; filename="'. $cv->name .'"'
      ]);
        

    }
    public function preview($name)
    {
       $cv = CV::where('file',$name)->first();

       return view('students.cv-preview',compact('cv'));
   }

    /**
     * Show the form for editin gthe specified resource.
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
    public function destroy(Request $request)
    {
        $cv = CV::findOrFail($request['id']);
        if(Auth::user()->student->id == $cv->student_id){

            //unlink(base_path().'/public_html'.'/cvs/'.$cv->file);

            unlink(public_path().'\\cvs\\'.$cv->file);
            $cv->delete();

            return response()->json('success');
        }else
        {return response()->json('error');}
        

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
