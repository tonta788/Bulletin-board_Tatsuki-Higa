<?php

namespace App\Http\Controllers\User\Post;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Posts\Post;
use App\Models\Users\User;
use App\Models\Posts\PostComment;
use App\Models\Posts\PostCommentFavorite;
use Auth;

class PostCommentFavoritesController extends Controller
{
  public function commentfavorite(Request $request)
{
    $user_id = Auth::user()->id;
    $post_comment_id = $request->post_comment_id; //コメントidの取得
    $already_favorited = PostCommentFavorite::where('user_id', $user_id)->where('post_comment_id', $post_comment_id)->first();

    if (!$already_favorited) {
        $commentfavorite = new PostCommentFavorite;
        $commentfavorite->post_comment_id = $post_comment_id; //PostFavoriteインスタンスにpost_id,user_idをセット
        $commentfavorite->user_id = $user_id;
        $commentfavorite->save();
    } else {
        PostCommentFavorite::where('post_comment_id', $post_comment_id)->where('user_id', $user_id)->delete();
    }

    $post_comment_favorites= PostComment::withCount('PostCommentFavorites')->findOrFail($post_comment_id);
    $comment_favorite_count = $post_comment_favorites->post_comment_favorites_count;
    $param = [
        'comment_favorite_count' => $comment_favorite_count,
    ];
    return response()->json($param);
}

}
