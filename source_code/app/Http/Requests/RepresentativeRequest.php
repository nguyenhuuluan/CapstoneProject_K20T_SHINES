<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RepresentativeRequest extends FormRequest
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

            'name' => 'required|regex:/^[\pL\s\-]+$/u',
            'position' => 'required',
            'phone' => 'required|numeric|regex:/^[0][0-9]{4,}/',
            // 'password' => 'required|confirmed'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Vui lòng nhập tên của bạn',
            'name.regex' => 'Tên không chứa ký tự đặc biệt', 
            'position.required' => 'Vui lòng nhập tên chức vụ của bạn', 
            'phone.required' => 'Vui lòng nhập số điện thoại của bạn', 
            'phone.numeric' => 'Số điện thoại chưa đúng định dạng',
            'phone.regex' => 'Số điện thoại chưa đúng định dạng',
            // 'password.required' => 'Vui lòng nhập mật khẩu',  
            // 'password.confirmed' => 'Password không trùng khớp'           
        ];
    }
}
