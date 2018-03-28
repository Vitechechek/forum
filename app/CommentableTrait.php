<?php
/**
 * Created by PhpStorm.
 * User: Vitechechek
 * Date: 24.03.2018
 * Time: 17:35
 */

namespace App;


trait CommentableTrait
{

    public function addComment($body)
    {
        $comment = new Comment();
        $comment->comment = $body;
        $comment->user_id = auth()->user()->id;

        $this->comments()->save($comment);

//        dispatch(new SendSubscribersEmail($thred));

        return $comment;
    }


    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
}

//class SendSubscribersEmail {
//    /**
//     * @var Thread
//     */
//    public $thread;
//
//    public function __construct(Thread $thread)
//    {
//
//        $this->thread = $thread;
//    }
//
//    public function handle()
//    {
//        $subscribers = $this->thread->subscribers->each->notify(new )
//    }
//}