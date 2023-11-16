<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateContactRequest extends FormRequest
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
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
        ];
    }
    public function messages(): array
    {
        return [
            'name.required' => 'Tên liên hệ bắt buộc phải nhập!',
            'email.required' => 'Email bắt buộc phải nhập!',
            'phone.required' => 'Điện thoại bắt buộc phải nhập!',
        ];
    }
}
