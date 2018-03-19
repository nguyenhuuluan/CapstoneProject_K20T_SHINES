<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Request\StudentRequests;
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




use Mail;
function renameKey($oldkey, $newkey, $array) {
	$val = $array[$oldkey];
	$tmp_A = array_flip($array);
	$tmp_A[$val] = $newkey;
	return array_flip($tmp_A);

}
class StudentController extends Controller
{


	public function validateEmailDomain($email, $domains) {
		foreach ($domains as $domain) {
			$pos = strpos($email, $domain, strlen($email) - strlen($domain));

			if ($pos === false)
				continue;

			if ($pos == 0 || $email[(int) $pos - 1] == "@" || $email[(int) $pos - 1] == ".")
				return true;
		}

		return false;
	}


	public function register(Request $request)
	{   
		$whitelist = array("vanlanguni.vn"); //You can add basically whatever you want here because it checks for one of these strings to be at the end of the $email string.

		$validatedData = $request->validate([
			'email' => 'required',
		]);

		if (!$this->validateEmailDomain($request["email"], $whitelist)) {
			$request->session()->flash('email-invalid', '<strong>Email không hợp lệ</strong>, hiện tại website chỉ cung cấp dịch vụ cho sinh viên học tại ĐH Văn Lang.');
			return redirect()->route("home")->withInput();
		}

		if ($acc = Account::where('username', '=', $request["email"])->first()) {
			$request->session()->flash('email-exist', '<strong>Email đã được sử dụng</strong>');

			return redirect()->route("home")->withInput();
		}

		
		$acc = Account::create([
			"username" => $request["email"],
			"remember_token" => str_random(40),
			"status_id" => 6
		]);

		//set role for account
		$role = Role::findOrFail(4);
		$role -> accounts() -> attach($acc["id"]);

		$request->session()->flash('resigter-success', '<strong>Đăng ký thành công</strong>, vui lòng kiểm tra Email để cập nhật thông tin tài khoản. Cảm ơn');

		$this->sendMail($acc);

		return redirect()->route("home");
	}


	public function isExistEmail($arrayEmail, $email)
	{
		foreach ($arrayEmail as $key => $value) {
			if ($value == $email) {
				break;
				return true;
			}
		}

		return false;
	}


	public function sendMail($account)
	{
		Mail::send('students.email-confirm', ['account' => $account],  function ($message) use($account)
		{
			$message->to($account['username'])->subject('Xác Nhận');
		});

	}

	public function confirm($token)
	{
		$acc = Account::where('remember_token', '=', $token)->first();

		if (!$acc) {
			return view('layouts2.custom-error-message')->with('errorMessage', 'Địa chỉ hiện tại không tồn tại');
		}

		$faculs = Faculty::pluck('name', 'id');

		return view('students.confirm')->with(compact('acc','faculs'));
	}

	public function confirmInfomation(\App\Http\Requests\StudentRequest $request)
	{

		$acc = Account::where('id', $request['account_id'])->first();
		$acc->password = bcrypt($request['password']);
		$acc->status_id = 5;
		$acc->remember_token = null;
		$acc->save();

		$stud = Student::create([
			"name" => $request["name"],
			"phone" => $request["phone"],
			"dateofbirth" => $request["dateofbirth"],
			"gender" => $request["gender"],
			"account_id" => $acc["id"],
			"faculty_id" => $request["faculty_id"],
			"email" => $acc["username"]
		]);

		return redirect()->route('student.update-success');		

	}

	public function updateSuccess()
	{
		return view('layouts2.update-success');
	}

	public function profile()
	{	
		$student = Auth::user()->student;
		$exps = Experience::where('student_id', $student->id)->get();
		$skills = Skill::where('student_id', $student->id)->get();
		//$cvs = Cv::where('')
		return view('students.profile', compact('student', 'exps', 'skills'));
	}


	public function editProfile(Request $request, $id)
	{	
		//kiểm tra tag tồn tại trong hệ thống
		$tags1 = explode(',', request('tags')); 
		$request->request->add(['tags1' => $tags1]); 

		//return $request;
		$this->validate($request,[
			'name'=>'required',
			'dateofbirth'=>'required',
			'phone'=>'required',
			'faculty_id'=>'required|exists:faculties,id',
            //'hidden-tags'=>'required|array|exists:tags,name',
			'tags2.*'=>'required|exists:tags,name',
            //'hidden-tags'=>'required',
		]);

		//update thông tin sinh viên cơ bản
		$input = $request->except(['tags', 'exTitle', 'position', 'datestart', 'dateend', 'skills', 'valueofskill', 'tags1']);
		$student = Student::findOrFail($id);
		$student->update($input);

		
		$tags2;
		//change right id key tags
		foreach ($tags1 as $key => $value) {
			$id = Tag::where('name', $value)->first(['id'])['id'];
			$tags2[$id] = $tags1[$key];
		}
		//update tags
		$student->tags()->sync(array_keys($tags2));
		//update Experience
		$student->experiences()->delete();

		foreach (request('exTitle') as $key => $value) {
			if(request('exTitle')[$key]){
				$exp = new Experience([
					'title'=>$value,
					'role'=>request('position')[$key],
					'from'=>request('datestart')[$key],
					'to'=>request('dateend')[$key]
				]);
				$student->experiences()->save($exp);
			}
		}

		//Update SKills
		$student->skills()->delete();
		foreach (request('skills') as $key => $value) {
			if(request('skills')[$key]){
				$exp = new Skill([
					'name'=>$value,
					'rating'=>request('rating')[$key],
				]);
				$student->skills()->save($exp);
			}
		}

		return redirect()->back();
	}

	public function editPhoto(Request $request,$id)
	{

		if($file = $request->file('photo'))
		{
			$validator = Validator::make($request->all(), [
				'photo' => 'required|image|mimes:jpeg,png,jpg|max:1024',
			]);

			if ($validator->passes()) 
			{	
				$student = Student::findOrFail($id);
                $name  = time().$file->getClientOriginalName();

                unlink(public_path().$student->photo);

                $student['photo']=$name;
                $student->update();
                $file->move('images/students/avatas', $name);
                return response($student);

				// return response()->json(['success'=>'success']);
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

	public function editCv(Request $request, $id)
	{	
		if($file = $request->file('cv'))
		{
			$validator = Validator::make($request->all(), [
				'cv' => 'required|mimes:jpeg,png,jpg,pdf,docx,application/vnd.openxmlformats-officedocument.wordprocessingml.document|max:1024',
			]);

			if ($validator->passes()) 
			{
				return response()->json(['success'=>'success1']);

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


		


    //   if ($validator->passes()) {


    //     $input = $request->all();
    //     $input['image'] = time().'.'.$request->image->getClientOriginalExtension();
    //     $request->image->move(public_path('images'), $input['image']);


    //     AjaxImage::create($input);


    //     return response()->json(['success'=>'done']);
    //   }

    //   return response()->json(['error'=>$validator->errors()->all()]);
    // }

	}

	public function updateProfile()
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


	public function find(Request $request) {
		$tags = Tag::where('name', 'like', '%' . $request->get('q') . '%')->get();
    	//$tags = Tag::where('name', 'like', '%' . $request->get('q') . '%')->get(['name']);

    	// $tags2[] ='';


    	// foreach ($tags as $key => $value) {
    	// 	$tags2[] = $value["name"];
    	// }
    	//return response()->json($tags2);
		return response()->json($tags);
	}
	

}
