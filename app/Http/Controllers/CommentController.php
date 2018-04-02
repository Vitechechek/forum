<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Notifications\RepliedToThread;
use App\Thread;
use App\Http\Requests\CommentRequest;

class CommentController extends Controller
{
    public function addThreadComment(CommentRequest $request, Thread $thread)
    {
        $thread->addComment($request->comment);

        $link = url('/') . '/' . 'thread/' . $thread->id;
        $comments = Comment::where('commentable_id', $thread->id)->get();
        $users_commenting = $comments->map(function($comment){
            return $comment->user;
        })->unique();

        \Notification::send($users_commenting, new RepliedToThread($link));

        return back()->withMessage('Comment created');
    }

    public function addReplyComment(CommentRequest $request, Comment $comment)
    {
        $comment->addComment($request->comment);

        return back()->withMessage('Reply created');
    }

    public function update(CommentRequest $request, Comment $comment)
    {
        $this->authorize('update', $comment);

        $comment->update($request->all());

        return back()->withMessage('Comment updated');
    }

    public function destroy(Comment $comment)
    {
        $this->authorize('update', $comment);

        $comment->delete();

        return back()->withMessage('Comment deleted');
    }
}
