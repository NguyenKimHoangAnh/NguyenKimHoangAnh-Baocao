<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerUpdateRequest extends FormRequest
{    
    public function authorize():bool
    {
        return true;
    }
    public function rules():array
    {
        return [
            'username' => 'required',
            'password' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'name' => 'required',
            'address' => 'required'
        ];
    }
    public function messages():array
    {
        return [
            'username.required' => 'Vui lòng điền Tên tài khoảng',
            'password.required' => 'Vui lòng điền password',
            'email.required' => 'Vui lòng điền email',
            'phone.required' => 'Vui lòng điền số điện thoại',
            'name.required' => 'Vui lòng điền Họ tên',
            'address.required' => 'Vui lòng điền Địa chỉ'
        ];
    }
}
