<?php

namespace App\Http\Controllers\User\Post;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Posts\Post;
use App\Models\Users\User;
use App\Models\Posts\PostComment;
use App\Models\Posts\PostSubCategory;

class PostCommentsController extends Controller
{
    public function index($id){
        $comment = PostComment::find($id);

        return view('posts.comment',compact('comment'));
    }

    public function create(Request $request){
        $rules = [
            'comment' => 'required|string|max:2500',
        ];

        $comment = $request->input('comment');
        $user_id = $request->input('user_id');
        $post_id = $request->input('post_id');
        $this->validate($request, $rules);

        \DB::table('post_comments')->insert([
            'user_id' => $user_id,
            'post_id' => $post_id,
            'comment' => $comment,
            'event_at' => date('Y-m-d')
        ]);
        return back();
    }

    public function update(Request $request,$id){
         $rules = [
            'comment' => 'required|string|max:2500',
        ];

        $post_id = $request->input('post_id');
        $up_comment = $request->input('comment');
        $this->validate($request, $rules);
        \DB::table('post_comments')
            ->where('id', $id)
            ->update(
                ['comment' => $up_comment]
            );

        return redirect()->route('show',['id'=>$post_id]);
    }

    public function delete($id){
        \DB::table('post_comments')
            ->where('id', $id)
            ->delete();

        return redirect('/top');
    }


}
