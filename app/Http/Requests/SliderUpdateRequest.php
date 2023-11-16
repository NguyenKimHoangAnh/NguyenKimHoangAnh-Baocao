<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SliderUpdateRequest extends FormRequest
{    
    public function authorize():bool
    {
        return true;
    }
    public function rules():array
    {
        return [
            'name' => 'required',
            'link' => 'required'
        ];
    }
    public function messages():array
    {
        return [
            'name.required' => 'Vui lòng điền Tên Slider',
            'link.required' => 'Vui lòng điền Link',
        ];
    }
}
