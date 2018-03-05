<?php

namespace App\Http\Controllers;

use App\CompanyRegistration;

use Illuminate\Http\Request;
use App\Http\Requests\CompanyRegistrationRequest;

class CompanyRegistrationController extends Controller
{
	public function partnership()
	{
		return view("partnerships.index");
	}

	public function registerPartnershipForm()
	{
		return view("partnerships.register");
	}

	public function registerPartnership(\App\Http\Requests\CompanyRegistrationRequest $request)
	{
		$compRegis = CompanyRegistration::create([
			"company_name" => $request["company_name"],
			"company_website" => $request["company_website"],
			"representative_name" => $request["representative_name"],
			"representative_position" => $request["representative_position"],
			"representative_phone" => $request["representative_phone"],
			"representative_email" => $request["representative_email"],
			"status_id" => 9
		]);


		if ($compRegis) {
			$indexURL = route('index');
			$request->session()->flash('resigter-success', '<strong>Đăng ký thành công</strong>, sau khi xác nhận Jobee sẽ liên lạc với bạn, cảm ơn. <br> Quay về <a href="'. $indexURL .'"><strong> Trang chủ</strong></a>');

			return redirect()->route("company.register.partnership.form");

		}else {
			$request->session()->flash('resigter-error', '<strong>Đã có lỗi xảy ra</strong>, vui lòng nhập lại dữ liệu');
			return redirect()->route("company.register.partnership.form")->withInput();
		}
	}
}
