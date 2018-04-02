<?php

namespace App\Http\Controllers;

use App\Thread;
use Illuminate\Http\Request;
use App\Http\Requests\ThreadRequest;

class ThreadController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('index');
    }

    public function index()
    {
        $threads = Thread::paginate(15);

        return view('thread.index', compact('threads'));
    }

    public function create()
    {
        return view('thread.create');
    }

    public function store(ThreadRequest $request)
    {
        auth()->user()->threads()->create($request->validated());

        return back()->withMessage('Thread created');
    }

    public function show(Thread $thread)
    {
        return view('thread.show', compact('thread'));
    }

    public function edit(Thread $thread)
    {
        return view('thread.edit', compact('thread'));
    }

    public function update(ThreadRequest $request, Thread $thread)
    {
        $this->authorize('update', $thread);

        $thread->update($request->validated());

        return redirect()->route('thread.show', $thread->id)->withMessage('Thread updated');
    }

    public function destroy(Thread $thread)
    {
        $this->authorize('update', $thread);

        $thread->delete();

        return redirect()->route('thread.index')->withMessage('Thread deleted');
    }

    public function markAsSolution(Request $request)
    {
        $thread = Thread::find($request->threadId);
        $thread->solution = $request->solutionId;
        if($thread->save()) {
            return back()->withMessage('Marked');
        }
    }
}
