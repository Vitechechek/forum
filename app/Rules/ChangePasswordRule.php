<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class ChangePasswordRule implements Rule
{
    protected $password;
    protected $message = 'Incorrect password';

    public function __construct($password)
    {
        $this->password = $password;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $user = auth()->user();

        if(!Hash::check($this->password, $user->password)) {
            return false;
        }
        // TODO add rule : old password can not be same new password


        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return $this->message;
    }
}

