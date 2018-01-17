<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Response;

use App\Account;

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

		$input = $request->all();
		$input["remember_token"] = str_random(40);
		$input["status_id"] = 6;

		
		Account::create([
			"username" => $request["email"],
			"remember_token" => str_random(40),
			"status_id" => 6
		]);

		$request->session()->flash('resigter-success', '<strong>Đăng ký thành công</strong>, vui lòng kiểm tra Email để cập nhật thông tin tài khoản.');

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

	

}
