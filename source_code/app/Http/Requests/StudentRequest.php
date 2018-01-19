<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentRequest extends FormRequest
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
            'phone' => 'required|numeric',
            'dateofbirth' => 'required',

            'password' => 'required|confirmed',          
        ];
    }

        public function messages()
    {
        return [
            'name.required' => 'Vui lòng nhập tên đầy đủ',  
            'phone.required'  => 'Vui lòng nhập số điện thoại',
            'phone.numeric' => 'Vui lòng nhập đúng định dạng số điện thoại',
            'dateofbirth.required' => 'Vui lòng chọn ngày tháng năm sinh',

            'password.required' => 'Vui lòng nhập mật khẩu',  
            'password.confirmed' => 'Password không trùng khớp'

        ];
    }
}
