<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOrderRequest extends FormRequest
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
            'deliveryaddress' => 'required',
            'deliveryname' => 'required',
            'deliveryphone' => 'required',
        ];
    }
    public function messages(): array
    {
        return [
            'deliveryaddress.required' => 'Địa chỉ người nhận bắt buộc phải nhập',
            'deliveryname.required' => 'Tên người nhận bắt buộc phải nhập',
            'deliveryphone.required' => 'Số điện thoại bắt buộc phải nhập',
        ];
    }
}
