<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostStoreRequest extends FormRequest
{    
    public function authorize():bool
    {
        return true;
    }
    public function rules():array
    {
        return [
            'title' => 'required',
            'detail' => 'required',
            'metakey' => 'required',
            'metadesc' => 'required'
        ];
    }
    public function messages():array
    {
        return [
            'title.required' => 'Vui lòng điền Tên danh mục',
            'detail.required' => 'Vui lòng điền Chi tiết bài viết',
            'metakey.required' => 'Vui lòng điền Từ khóa',
            'metadesc.required' => 'Vui lòng điền Mô tả'
        ];
    }
}
