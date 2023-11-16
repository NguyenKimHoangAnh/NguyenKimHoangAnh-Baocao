<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePostRequest extends FormRequest
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
            'title' => 'required',
            'metakey' => 'required',
            'metadesc' => 'required',
        ];
    }
    public function messages(): array
    {
        return [
            'title.required' => 'Tiêu đề bài viết bắt buộc phải nhập',
            'metakey.required' => 'Từ khoá bắt buộc phải nhập',
            'metadesc.required' => 'Mô tả bắt buộc phải nhập',
        ];
    }
}
