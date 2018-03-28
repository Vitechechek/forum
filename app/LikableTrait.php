<?php
/**
 * Created by PhpStorm.
 * User: Vitechechek
 * Date: 24.03.2018
 * Time: 18:55
 */

namespace App;


trait LikableTrait
{

    public function likes()
    {
        return $this->morphMany(Like::class, 'likable');
    }


    public function like()
    {
        $like = new Like();
        $like->user_id = auth()->user()->id;

        $this->likes()->save($like);

        return $like;
    }


    public function dislike()
    {
        $this->likes()->where('user_id', auth()->id())->delete();
    }


    public function isLiked()
    {
        return !!$this->likes()->where('user_id', auth()->id())->count();
    }
}