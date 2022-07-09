<?php

namespace App\Http\Controllers\User\Post;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Posts\Post;
use App\Models\Users\User;
use App\Models\Posts\PostFavorite;
use App\Models\Posts\PostMainCategory;
use App\Models\Posts\PostSubCategory;
use Auth;


class PostFavoritesController extends Controller
{
    public function favorite(Request $request)
{
    $user_id = Auth::user()->id;
    $post_id = $request->post_id; //2.投稿idの取得
    $already_favorited = PostFavorite::where('user_id', $user_id)->where('post_id', $post_id)->first();

    if (!$already_favorited) {
        $favorite = new PostFavorite; //4.PostFavoriteクラスのインスタンスを作成
        $favorite->post_id = $post_id; //PostFavoriteインスタンスにpost_id,user_idをセット
        $favorite->user_id = $user_id;
        $favorite->save();
    } else {
        PostFavorite::where('post_id', $post_id)->where('user_id', $user_id)->delete();
    }

    $post_favorites= Post::withCount('PostFavorites')->findOrFail($post_id);
    $favorite_count = $post_favorites->post_favorites_count;
    $param = [
        'favorite_count' => $favorite_count,
    ];
    return response()->json($param); //6.JSONデータをjQueryに返す
}


    public function liked(Request $request){
        $liked = $request->input('liked');

        if(!empty($liked)) {
            // $posts = PostFavorite::where('posts.user_id','=',$liked,'post.id','=','post_id')->withCount('PostFavorites')->get();
            $posts = Post::with('PostFavorites')->WhereHas('PostFavorites',function($query){
                $query->where('user_id',Auth::id());})->withCount('PostFavorites')->get();
        }
        $main_categories = \DB::table('post_main_categories')->get();
        $postMainCategories = PostMainCategory::all();
        $postSubCategories = PostSubCategory::query()
            ->whereIn('post_main_category_id', $postMainCategories->pluck('id')->toArray())
            ->get();
            $postMainCategories = $postMainCategories->map(function (PostMainCategory $postMainCategory) use ($postSubCategories) {
            $subs = $postSubCategories->where('post_main_category_id', $postMainCategory->id);
            $postMainCategory->setAttribute('postSubCategories', $subs);
            return $postMainCategory;
        });

        return view('posts.index',['posts' => $posts,'main_categories' => $main_categories,'post_main_categories' => $postMainCategories]);
}

}
