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
    public function favorite(Request $request)
{
    $user_id = Auth::user()->id; //1.ログインユーザーのid取得
    $post_id = $request->post_id; //2.投稿idの取得
    $already_favorited = PostFavorite::where('user_id', $user_id)->where('post_id', $post_id)->first(); //3.

    if (!$already_favorited) { //もしこのユーザーがこの投稿にまだいいねしてなかったら
        $favorite = new PostFavorite; //4.PostFavoriteクラスのインスタンスを作成
        $favorite->post_id = $post_id; //PostFavoriteインスタンスにpost_id,user_idをセット
        $favorite->user_id = $user_id;
        $favorite->save();
    } else { //もしこのユーザーがこの投稿に既にいいねしてたらdelete
        PostFavorite::where('post_id', $post_id)->where('user_id', $user_id)->delete();
    }
    //5.この投稿の最新の総いいね数を取得
    $post_favorites= Post::withCount('PostFavorites')->findOrFail($post_id);
    $favorite_count = $post_favorites->$post_favorites_count;
    $param = [
        'favorite_count' => $favorite_count,
    ];
    return response()->json($param); //6.JSONデータをjQueryに返す
}


    public function liked(Request $request){
        $liked = $request->input('liked');

        if(!empty($liked)) {
            $posts = Post::where('user_id',\Auth::user()->id)->withCount('PostFavorites')->get();
        }
        return view('posts.index',['posts' => $posts]);
}

}
