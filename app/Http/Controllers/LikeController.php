<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class LikeController extends Controller
{

    public function toggleLike()
    {
        // TODO
        $commentId = Input::get('commentId');
        // TODO move comment into url params
        $comment = Comment::find($commentId);

        if(!$comment->isLiked()) {
            $comment->like();
            $likes = $comment->likes()->count();

            return response()->json(['status'=>'success', 'message'=>'liked', 'likes'=>$likes]);
        }

        $comment->dislike();
        $likes = $comment->likes()->count();

        return response()->json(['status'=>'success', 'message'=>'unliked', 'likes'=>$likes]);

    }
}
