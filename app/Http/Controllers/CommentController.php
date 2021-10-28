<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function StoreComment(Request $request , $id){
       
        Comment::create([
            'content' =>  $request->content,
            'post_id' => $id,
            'user_id' => $request->user_id
        ]);

        return redirect(url("post/$id"));
}
}
