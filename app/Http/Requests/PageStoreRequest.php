<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PageStoreRequest extends FormRequest
{    
    public function authorize():bool
    {
        return true;
    }
    public function rules():array
    {
        return [
            'title' => 'required',
            'metakey' => 'required',
            'metadesc' => 'required'
        ];
    }
    public function messages():array
    {
        return [
            'title.required' => 'Vui lòng điền Tên danh mục',
            'metakey.required' => 'Vui lòng điền Mô tả',
            'metadesc.required' => 'Vui lòng điền Từ khóa'
        ];
    }
}
