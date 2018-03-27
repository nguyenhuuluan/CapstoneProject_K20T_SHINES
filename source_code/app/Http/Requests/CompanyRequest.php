<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyRequest extends FormRequest
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
            'name' => 'required',
            'website' => 'required|regex:/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/',
            'email' => 'required|email',
            'phone' => 'required|numeric',
            'working_day' => 'required',
            'field' => 'required',
            'business_code' => 'required',
            'introduce' => 'required',
                     
        ];
    }

        public function messages()
    {
        return [
            'name.required' => 'Vui lòng nhập tên công ty đầy đủ',
            'website.required' => 'Vui lòng nhập website công ty, hoặc đúng định dạng URL', 
            'email.required' => 'Vui lòng nhập Email', 
            'email.email' => 'Email không đúng định dạng', 
            'phone.required' => 'Vui lòng nhập số điện thoại', 
            'phone.numeric' => 'Số điện thoại chưa đúng định dạng',
            'working_day.required' => 'Vui lòng nhập thời gian làm việc', 
            'business_code.required' => 'Vui lòng nhập mã số kinh doanh', 
            'introduce.required' => 'Vui lòng nhập giới thiệu công ty',    
        ];
    }
}
