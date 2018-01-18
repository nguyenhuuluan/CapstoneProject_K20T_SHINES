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



use Mail;

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

			$request->session()->flash('email-invalid', '<strong>Email không hợp lệ</strong>, chỉ Email của sinh viên trường ĐH Văn Lang mới được đăng ký.');

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

		$request->session()->flash('resigter-success', '<strong>Đăng ký thành công</strong>, vui lòng kiểm tra Email để cập nhật thông tin tài khoản.');

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

		$stud = Student::create([
			"name" => $request["name"],
			"phone" => $request["phone"],
			"dateofbirth" => $request["dateofbirth"],
			"gender" => $request["gender"],
			"faculty_id" => $request["faculty_id"],
			"email" => $acc["username"]
		]);

		return redirect()->route('student.update-success');		

	}

	public function updateSuccess()
	{
		return view('layouts2.update-success');
	}

	

}
