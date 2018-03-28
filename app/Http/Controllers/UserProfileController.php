<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Thread;
use App\Comment;
use Illuminate\Support\Facades\Storage;

class UserProfileController extends Controller
{

    public function __construct()
    {
        return $this->middleware('auth');
    }


    public function index(User $user)
    {
        $threads = Thread::where('user_id', $user->id)->latest()->get();

        $comments = Comment::where('user_id', $user->id)->where('commentable_type', 'App\Thread')->get();

        return view('profile.index', compact('threads', 'comments', 'user'));
    }

    public function update(Request $request)
    {
        if ($request->hasFile('image'))
        {
            $oldFilename = auth()->user()->image;

            $request->file('image')->store('public');

            $file_name = $request->file('image')->hashName();

            $user = auth()->user();
            $user->image = $file_name;
            $user->save();

            Storage::delete(config('app.fileDestinationPath'). '/public/' . $oldFilename);
        }

        return back()->withMessage("kek");
    }
}
