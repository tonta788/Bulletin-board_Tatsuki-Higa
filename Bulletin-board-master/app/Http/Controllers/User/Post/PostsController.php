<?php

namespace App\Http\Controllers\User\Post;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Posts\PostMainCategory;
use App\Models\Posts\PostSubCategory;
use App\Models\Posts\Post;
use App\Models\Users\User;
use App\Models\Posts\PostComment;
use App\Models\Posts\PostFavorite;
use Auth;

class PostsController extends Controller
{
     public function index(Post $post){
        $posts = Post::with(['PostSubCategory'])->get();
        $favorite = PostFavorite::where('post_id', $post->id)->where('user_id', auth()->user()->id)->first();
        return view('posts.index',compact('favorite'),['posts' => $posts]);
    }

    public function show($id){
        $posts = Post::find($id);
        $comments = PostComment::all();

        $count = session()->get('count', 0);
        $count++;
        session()->put('count', $count);

        return view('posts.show',compact('posts'),['comments' => $comments,'count' => $count]);
    }

    public function updateshow(PostSubCategory $Sub_Categories,$id){
        $posts = Post::find($id);
        $sub_category=\DB::table('post_sub_categories')->get();
        return view('posts.update',compact('posts'),['sub_category' => $sub_category]);

    }

    public function category(){
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
        return view('posts.category',['main_categories' => $main_categories,'post_main_categories' => $postMainCategories]);
    }

    public function add(Request $request){
        $validator = Validator::make($request->all(), [
            'main_category' => 'required|string|max:100',
        ]);

        $main_category = $request->input('newMainCategory');
        $request-> id = $request->user()->id;
        \DB::table('post_main_categories')->insert([
            'main_category' => $main_category,
        ]);
        return redirect('/category');
    }

    public function addsub(Request $request){
        $validator = Validator::make($request->all(), [
            'sub_category' => 'required|string|max:100',
        ]);

        $main_category = $request->input('MainCategory');
        $sub_category = $request->input('newSubCategory');

        \DB::table('post_sub_categories')->insert([
            'post_main_category_id' => $main_category,
            'sub_category' => $sub_category,
        ]);
        return redirect('/category');
    }

    public function delete($id){
        \DB::table('post_sub_categories')
            ->where('id', $id)
            ->delete();

        return redirect('/category');
    }

    public function post(){
        $sub_categories = \DB::table('post_sub_categories')->get();
        return view('posts.post',['sub_categories' => $sub_categories]);
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:100',
            'post' => 'required|string|max:5000',
        ]);

        $sub_category = $request->input('SubCategory');
        $title = $request->input('newTitle');
        $post = $request->input('newPost');
        $request-> user_id = $request->user()->id;
        \DB::table('posts')->insert([
            'post_sub_category_id' => $sub_category,
            'title' => $title,
            'post' => $post,
            'user_id' => Auth::id(),
            'event_at' => date('Y-m-d')
        ]);
        return redirect('/post');
    }


    public function postupdate(Request $request,$id)
    {
        $up_subcategory = $request->input('up_post_sub_category_id');
        $up_title = $request->input('up_title');
        $up_post = $request->input('up_post');

        \DB::table('posts')
            ->where('id', $id)
            ->update([
                'post_sub_category_id' => $up_subcategory,
                'title' => $up_title,
                'post' => $up_post,
                ]);

        return redirect()->route('show',['id'=>$id]);
    }

    public function postdelete($id){
        \DB::table('posts')
            ->where('id', $id)
            ->delete();

        return redirect('/top');
    }
}
