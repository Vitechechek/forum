<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordRequest;

class ChangePasswordController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create()
    {
        return view('auth.change-password');
    }

    public function update(ChangePasswordRequest $request)
    {
        auth()->user()->update(['password'=>bcrypt(request('password'))]);

        return back()->with('success', 'Password has been changed');
    }
}