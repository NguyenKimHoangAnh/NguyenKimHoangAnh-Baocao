<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductStoreRequest extends FormRequest
{    
    public function authorize():bool
    {
        return true;
    }
    public function rules():array
    {
        return [
            'name' => 'required',
            'metakey' => 'required',
            'metadesc' => 'required',
            'detail' => 'required'
        ];
    }
    public function messages():array
    {
        return [
            'name.required' => 'Vui lòng điền Tên danh mục',
            'metakey.required' => 'Vui lòng điền Mô tả',
            'metadesc.required' => 'Vui lòng điền Từ khóa',
            'detail.required' => 'Vui lòng điền Chi tiết'
        ];
    }
}
