<?php

namespace App\Http\Requests;

use App\Rules\ChangePasswordRule;
use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'old_password'=>[
                'required',
                new ChangePasswordRule($this->request->get('old_password'))
            ],
            // TODO use confirmed rule for password
            'password'=>'required',
            'password_confirmation'=>'required|same:password'
        ];
    }
}
