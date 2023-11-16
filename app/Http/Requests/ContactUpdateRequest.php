<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactUpdateRequest extends FormRequest
{    
    public function authorize():bool
    {
        return true;
    }
    public function rules():array
    {
        return [
            'name' => 'required',
            'email' => 'required',
            'title' => 'required',
            'detail' => 'required',
            'replaydetail' => 'required',
            'phone' => 'required'
        ];
    }
    public function messages():array
    {
        return [
            'name.required' => 'Vui lòng điền Tên',
            'email.required' => 'Vui lòng điền Email',
            'title.required' => 'Vui lòng điền Tiêu đề',
            'detail.required' => 'Vui lòng điền Chi tiết',
            'replaydetail.required' => 'Vui lòng điền Nội dung liên hệ',
            'phone.required' => 'Vui lòng điền Số điện thoại'
        ];
    }
}
