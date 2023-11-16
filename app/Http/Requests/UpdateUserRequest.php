<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name'=>'required',
            'usename'=>'required',
            'password'=>'required',
            'email'=>'required',
            'phone'=>'required',
            'gender'=>'required',
            'address'=>'required'
        ];
    }
    public function messages(): array
    {
        return [
            'name.required'=>'Tên bắt buộc phải nhập',
            'usename.required'=>'Tên đăng nhập bắt buộc phải nhập',
            'password.required'=>'Mật khẩu bắt buộc phải nhập',
            'email.required'=>'Email bắt buộc phải nhập',
            'phone.required'=>'Số điện thoại bắt buộc phải nhập',
            'gender.required'=>'Giới tính bắt buộc phải nhập',
            'address.required'=>'Địa chỉ bắt buộc phải nhập'
        ];
    }
}
