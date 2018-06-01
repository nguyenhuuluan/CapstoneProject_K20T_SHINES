<?php

namespace App\Http\Controllers\Student;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;


use Response;
use App\Account;
use App\Faculty;
use App\Company;
use App\Student;
use App\Role;
use App\Tag;
use App\Experience;
use App\Skill;
use App\Cv;
use Auth;

class StudentProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $student =  Auth::user()->student;
        $exps =     Experience::where('student_id', $student->id)->get();
        $skills =   Skill::where('student_id', $student->id)->get();
        //$cvs = Cv::where('')
        return view('students.profile', compact('student', 'exps', 'skills'));
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $student = Auth::user()->student;
        $faculties = Faculty::pluck('name','id')->all();
        $exps = Experience::where('student_id', $student->id)->get();
        $skills = Skill::where('student_id', $student->id)->get();
        //$cvs = Cv::where('')

        $tags = '';
        foreach ($student->tags as $tag) {
            $tags = $tags.$tag->name.',';
        }
        
        return view('students.profile-update', compact('faculties', 'student', 'tags', 'exps', 'skills'));
    }

    public function editPhoto(Request $request)
    {
        if($request->id == Auth::user()->student->id ){
            $data = $request->image;
            list($type, $data) = explode(';', $data);
            list(, $data)      = explode(',', $data);
            $data = base64_decode($data);
            $imageName = time().'.png';
            try{
                if(file_put_contents('images/students/avatas/'.$imageName, $data))
                {
                //Kiểm tra ảnh có phải ảnh mặc định không
                    $student = Student::findOrFail($request['id']);
                    if(!strpos($student->photo, 'avatar.jpg'))
                    {
                    // unlink(base_path().'/public_html/'.$student->photo);
                        unlink(public_path().$student->photo);
                    }
                    $student['photo']=$imageName;
                    $student->update();
                    return response()->json($student['photo']);
                }else{
                //Lưu Ảnh không thành công
                   return response()->json(['error'=>'Lưu ảnh không thành công']);
               }
           }
           catch(Exception $e)
           {return $e;}
       }

   }




//    if($file = $request->file('photo'))
//    {
//     $validator = Validator::make($request->all(), [
//         'photo' => 'required|image|mimes:jpeg,png,jpg|max:1024',
//     ]);

//     if ($validator->passes()) 
//     {   
//         $student = Student::findOrFail($request['id']);
//         $name  = time().$file->getClientOriginalName();

//         if(!strpos($student->photo, 'avatar.jpg'))
//         {
//                     // unlink(base_path().'/public_html/'.$student->photo);
//             unlink(public_path().$student->photo);
//         }


//         $student['photo']=$name;
//         $student->update();
//         $file->move('images/students/avatas', $name);
//         return response()->json($student['photo']);

//                 // return response()->json(['success'=>'success']);
//     }
//     else
//     {
//         return response()->json(['error'=>$validator->errors()->all()]);
//     }
// }
// else
// {
//     return response()->json(['error'=>'error']);
// }
// }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // return count($request['skills']);
        if($request->std_id == Auth::user()->student->id )
            {
                //Tạo mảng chứa tag
                $tags1 = explode(',', $request->tags); 

                $this->validate($request,[
                    'name'=>'required',
                    'dateofbirth'=>'required',
                    'phone'=>'required',
                    'faculty_id'=>'required|exists:faculties,id',
                ]);

                //update thông tin sinh viên cơ bản
                $input = $request->except(['std_id','tags', 'exTitle', 'position', 'datestart', 'dateend', 'skills', 'valueofskill', 'tags1']);
                $student = Student::findOrFail($request->std_id);
                $student->update($input);

                $tags2;
                //change right id key tags
                foreach ($tags1 as $key => $value)
                {
                    $id = Tag::where('name', $value)->first(['id'])['id'];
                    $tags2[$id] = $tags1[$key];
                }
                //update tags
                $student->tags()->sync(array_keys($tags2));

                //update Experience
                $student->experiences()->delete();
                if(count($request['exTitle'])>0)
                {
                    foreach ($request['exTitle'] as $key => $value) 
                    {
                        if($request->exTitle[$key]){
                            $exp = new Experience([
                                'title'=>$value,
                                'role'=>request('position')[$key],
                                'from'=>request('datestart')[$key],
                                'to'=>request('dateend')[$key]
                            ]);
                            $student->experiences()->save($exp);
                        }
                    }
                }
                
                //Update SKills
                $student->skills()->delete();
                // if($request['skills'])
                if(count($request['skills'])>0)
                {
                    foreach ($request['skills'] as $key => $value) 
                    {
                        if($request->skills[$key]){
                            $exp = new Skill([
                                'name'=>$value,
                                'rating'=>request('rating')[$key],
                            ]);
                            $student->skills()->save($exp);
                        }
                    }
                }

                return response()->json('success');
            }
            else{ return response()->json('error');}
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
