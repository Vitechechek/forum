<?php

namespace App;


trait CommentableTrait
{
    public function addComment($body)
    {
        $comment = new Comment();
        $comment->comment = $body;
        $comment->user_id = auth()->user()->id;

        $this->comments()->save($comment);

        return $comment;
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
}