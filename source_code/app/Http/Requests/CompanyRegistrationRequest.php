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
            'company_website' => 'required|url',
            'representative_name' => 'required|regex:/^[\pL\s\-]+$/u',
            'representative_position' => 'required',
            'representative_email' => 'required|email|regex:/^[\pL\s\-]+$/u',
            'representative_phone' => 'required|numeric|regex:/(01)[0-9]{9}/|max:11|min:10',
                     
        ];
    }

        public function messages()
    {
        return [
            'company_name.required' => 'Vui lòng nhập tên công ty đầy đủ',
            'company_website.url' => 'Vui lòng nhập đúng định dạng địa chỉ web',
            'company_website.required' => 'Vui lòng nhập website công ty', 
            'representative_name.required' => 'Vui lòng nhập tên của bạn',
            'representative_name.regex' => 'Tên không chứa ký tự đặc biệt', 
            'representative_position.required' => 'Vui lòng nhập tên chức vụ của bạn', 
            'representative_email.required' => 'Vui lòng nhập email của bạn', 
            'representative_email.email' => 'Email không đúng định dạng',
            'representative_email.regex' => 'Email không đúng định dạng', 
            'representative_phone.required' => 'Vui lòng nhập số điện thoại của bạn', 
            'representative_phone.numeric' => 'Số điện thoại chưa đúng định dạng',
            'representative_phone.regex' => 'Số điện thoại chưa đúng định dạng',
            'representative_phone.min' => 'Số điện thoại chưa đúng định dạng',
            'representative_phone.max' => 'Số điện thoại chưa đúng định dạng',   
        ];
    }
}
