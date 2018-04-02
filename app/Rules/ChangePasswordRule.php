<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class ChangePasswordRule implements Rule
{
    protected $oldPassword;
    protected $newPassword;
    protected $message = 'Incorrect password';

    public function __construct($oldPassword, $newPassword)
    {
        $this->oldPassword = $oldPassword;
        $this->newPassword = $newPassword;
    }

    public function passes($attribute, $value)
    {
        $user = auth()->user();

        if(!Hash::check($this->oldPassword, $user->password)) {
            return false;
        }

        if($this->oldPassword == $this->newPassword) {
            $this->message = 'The new password can\'t be the same as old one';
            return false;
        }

        return true;
    }

    public function message()
    {
        return $this->message;
    }
}

