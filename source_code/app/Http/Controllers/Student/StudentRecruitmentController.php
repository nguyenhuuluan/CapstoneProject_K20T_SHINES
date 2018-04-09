<?php

namespace App\Http\Controllers\Student;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Student;
use App\Recruitment;
use Exception;

class StudentRecruitmentController extends Controller
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
    public function store(Request $request, $slug)
    {
        //

        $this->validate($request,[
            'mycv'=>'required',
        ]);

        $student = Auth::user()->student;

        try {
            $student->recruitments()->save(Recruitment::findBySlugOrFail($slug), ['cv_id'=>$request['mycv'], 'description'=>$request['description']]);
            return redirect()->back()->with('success', 'Nộp hồ sơ CV thành công!');
        }
        catch (Exception $e){
                return back()->with('fail', 'Bạn đã ứng tuyển vị trí này!');

            // $errorCode = $e->errorInfo[1];
            // if($errorCode == 1062 ){
            //     return 'fail2';
            // }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showApply()
    {   
        $student = Auth::user()->student;
        $applies = $student->recruitments;
        return view('students.apply-recruitment', compact('applies'));  
    }
    public function saveRecruitment($slug)
    {
        $recruitment = Recruitment::findBySlugOrFail($slug);
        $student = Auth::user()->student;
        try{
        $student->saves()->save($recruitment);
        return response('success');
        }
        catch (Exception $e){
            return response('fail');
        }
    }
    public function showRecruitment()
    {
        $student = Auth::user()->student;
        $recruitments = $student->saves;
        return view('students.save-recruitment', compact('recruitments'));
    }

    public function apply($id)
    {   
        $student = Auth::user()->student;
        $recruitment = Recruitment::findBySlugOrFail($id);
        return view('recruitments.apply', compact('recruitment', 'student'));
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
