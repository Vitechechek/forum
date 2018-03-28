<?php

namespace App\Http\Controllers;

use App\Thread;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class ThreadController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $threads = Thread::paginate(15);

        return view('thread.index', compact('threads'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('thread.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // TODO move this to request class
        $this->validate($request, [
            'subject'=>'required|min:10',
            'type'=>'required',
            'thread'=>'required|min:20',
        ]);

        // TODO use validate method
        auth()->user()->threads()->create($request->all());

        // Use once brackets
        return back()->withMessage("Thread created");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function show(Thread $thread)
    {
        return view('thread.show', compact('thread'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function edit(Thread $thread)
    {
        return view('thread.edit', compact('thread'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Thread $thread
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(Request $request, Thread $thread)
    {
        $this->authorize('update', $thread);

        // TODO
        $this->validate($request, [
            'subject'=>'required|min:10',
            'type'=>'required',
            'thread'=>'required|min:20',
        ]);

        // TODO
        $thread->update($request->all());

        return redirect()->route('thread.show', $thread->id)->withMessage("Thread updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Thread $thread
     *
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Thread $thread)
    {
        $this->authorize('update', $thread);

        $thread->delete();

        return redirect()->route('thread.index')->withMessage("Thread deleted");
    }


    public function markAsSolution()
    {
        // TODO use request() function and dont create not need vars
        $solutionId = Input::get('solutionId');
        $threadId = Input::get('threadId');
        $thread = Thread::find($threadId);
        $thread->solution = $solutionId;
        if($thread->save()) {
            // TODO
            return back()->withMessage("Marked");
        }
    }
}
