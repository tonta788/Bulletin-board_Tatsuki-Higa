<?php

namespace App\Http\Controllers\User\Post;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Posts\Post;
use App\Models\Users\User;
use App\Models\Posts\PostFavorite;
use Auth;


class PostFavoritesController extends Controller
{
    public function favorite(Post $post, Request $request){
        $favorite=New PostFavorite();
        $favorite->post_id=$post->id;
        $favorite->user_id=Auth::user()->id;
        $favorite->save();
        return back();
    }

    public function unfavorite(Post $post, Request $request){
        $user=Auth::user()->id;
        $favorite=PostFavorite::where('post_id', $post->id)->where('user_id', $user)->first();
        $favorite->delete();
        return back();
    }
}
