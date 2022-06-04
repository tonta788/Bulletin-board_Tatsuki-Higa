<?php

namespace App\Http\Controllers\User\Post;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Posts\Post;
use App\Models\Users\User;

class PostCommentsController extends Controller
{
    public function comment(){
        return view('posts.comment');
    }


    public function create(Request $request){

        $comment = $request->input('newComment');
        $user_id = $request->input('user_id');
        $post_id = $request->input('post_id');

        \DB::table('post_comments')->insert([
            'user_id' => $user_id,
            'post_id' => $post_id,
            'comment' => $comment,
            'event_at' => date('Y-m-d')
        ]);
        return back();
    }
}
