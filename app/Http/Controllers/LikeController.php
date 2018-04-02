<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function toggleLike(Request $request)
    {

        $comment = Comment::find($request->commentId);

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
