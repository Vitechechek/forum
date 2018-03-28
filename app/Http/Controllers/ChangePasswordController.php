<?php
/**
 * Created by PhpStorm.
 * User: Vitechechek
 * Date: 25.03.2018
 * Time: 20:51
 */

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordRequest;
use App\Rules\ChangePasswordRule;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class ChangePasswordController extends Controller
{

    public function __construct()
    {
        // TODO constructor NEVER return
        return $this->middleware('auth');
    }


    public function update(ChangePasswordRequest $request)
    {
        auth()->user()->update(['password'=>bcrypt(request('password'))]);

        // TODO
        return back()->with('success', "Password has been changed");
    }
}