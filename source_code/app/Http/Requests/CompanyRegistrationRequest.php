<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyRegistrationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */




    public function rules()
    {
        return [
            'company_name' => 'required',
            'company_website' => 'required',
            'representative_name' => 'required|regex:/^[\pL\s\-]+$/u',
            'representative_position' => 'required',
            'representative_email' => 'required|string|email|max:255|unique:accounts,username',
            'representative_phone' => 'required|numeric|regex:/^[0-9]{4,}/',
            'g-recaptcha-response' => 'required|recaptcha',
            
        ];
    }

        public function messages()
    {
        return [
            'company_name.required' => 'Vui lòng nhập tên công ty đầy đủ.',
            'company_website.required' => 'Vui lòng nhập website công ty.', 
            'representative_name.required' => 'Vui lòng nhập tên của bạn.',
            'representative_name.regex' => 'Tên không chứa ký tự đặc biệt.', 
            'representative_position.required' => 'Vui lòng nhập tên chức vụ của bạn.', 
            'representative_email.required' => 'Vui lòng nhập email của bạn.', 
            'representative_email.email' => 'Email không đúng định dạng.', 
            'representative_email.unique' => 'Email này đã tồn tại.', 
            'representative_phone.required' => 'Vui lòng nhập số điện thoại của bạn.', 
            'representative_phone.numeric' => 'Số điện thoại chưa đúng định dạng.',
            'representative_phone.regex' => 'Số điện thoại chưa đúng định dạng.',
            'g-recaptcha-response.required' => 'Form đăng ký không dành cho robot. Vui lòng Refresh lại trang.',
            'g-recaptcha-response.recaptcha' => 'Form đăng ký không dành cho robot. Vui lòng Refresh lại trang.',

 
        ];
    }
}
