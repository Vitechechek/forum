<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ThreadRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'subject'=>'required|min:10',
            'type'=>'required',
            'thread'=>'required|min:20',
        ];
    }
}
