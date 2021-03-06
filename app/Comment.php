<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use CommentableTrait, LikableTrait;

    protected $fillable = ['comment', 'user_id'];

    public function commentable()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
