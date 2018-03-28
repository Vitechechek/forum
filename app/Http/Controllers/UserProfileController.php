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
        $this->middleware('auth');
    }

    public function index(User $user)
    {
        $threads = Thread::where('user_id', $user->id)->latest()->get();

        $comments = Comment::where('user_id', $user->id)->where('commentable_type', 'App\Thread')->get();

        return view('profile.index', compact('threads', 'comments', 'user'));
    }

    public function update(Request $request)
    {
        if ($request->hasFile('image')) {
            $oldFileName = auth()->user()->image;
            $fileName = $request->file('image')->store('public');

            auth()->user()->update(['image' => $fileName]);

            Storage::delete(config('app.fileDestinationPath'). '/public/' . $oldFileName);
        }

        return back()->withMessage('kek');
    }
}
