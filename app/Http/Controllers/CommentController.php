<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Notifications\RepliedToThread;
use App\Thread;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class CommentController extends Controller
{
    // TODO only index, create, store, show, edit, update, destroy
    public function addThreadComment(Request $request, Thread $thread)
    {
        $this->validate($request, [
            'comment' => 'required'
        ]);

        $thread->addComment($request->comment);

        //$users = $thread->commentators();
        // TODO notify only subscribers!!!
        auth()->user()->notify(new RepliedToThread());
        //Notification::send($users, new RepliedToThread());

        return back()->withMessage("Comment created");
    }


    public function addReplyComment(Request $request, Comment $comment)
    {
        // TODO
        $this->validate($request, [
            'comment' => 'required'
        ]);

        $comment->addComment($request->comment);

        // TODO
        return back()->withMessage("Reply created");
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Comment $comment
     *
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(Request $request, Comment $comment)
    {
        $this->authorize('update', $comment);

        // TODO
        $this->validate($request, [
            'comment'=>'required'
        ]);

        // TODO
        $comment->update($request->all());

        // TODO
        return back()->withMessage("Comment updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        $this->authorize('update', $comment);

        $comment->delete();

        return back()->withMessage("Comment deleted");
    }
}
