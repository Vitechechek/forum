<?php

namespace App\Http\Requests;

use App\Rules\ChangePasswordRule;
use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'old_password'=>[
                'required',
                new ChangePasswordRule($this->request->get('old_password'), $this->request->get('password'))
            ],
            'password'=>'required|confirmed',
            'password_confirmation'=>'required'
        ];
    }
}
