<?php

namespace App\Http\Controllers\User\Post;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Posts\Post;
use App\Models\Users\User;
use App\Models\Posts\PostFavorite;
use Auth;

class PostCommentFavoritesController extends Controller
{
    public function commentfavorite(Request $request){
    $comment_id = $request->input('comment_id');
/*
    comment_id が自分自身のコメントでないことを確認
    データベース更新処理
    $name : 新たな Font Awesomeのクラス名(far, fas)
    $cnt : 「いいね」総数
*/
if(($name==='far' || $name==='fas') && is_int($cnt) && $cnt >= 0)
{
   return json_encode(["name" => $name, "cnt" => $cnt]);
}
//正常でない場合でもJSON形式で返す
return json_encode(['name' => 'error', 'cnt' => -1]);
}
}
