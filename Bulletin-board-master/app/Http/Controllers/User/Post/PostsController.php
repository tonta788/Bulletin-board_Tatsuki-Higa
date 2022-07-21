<?php

namespace App\Http\Controllers\User\Post;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\ActionLogs\ActionLog;
use App\Models\Posts\PostMainCategory;
use App\Models\Posts\PostSubCategory;
use App\Models\Posts\Post;
use App\Models\Users\User;
use App\Models\Posts\PostComment;
use App\Models\Posts\PostFavorite;
use Auth;

class PostsController extends Controller
{
     public function index(Post $post,Request $request){
        $posts = Post::with(['PostSubCategory'])->withCount('PostFavorites')->get();
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

    public function show($id,Request $request){
        $posts = Post::find($id);
        $comments = PostComment::withCount('PostCommentFavorites')->get();

        $data = [
            'user_id' => Auth::id(),
            'post_id' => $id,
            'event_at' => date('Y-m-d'),
        ];
        Actionlog::create($data);

        return view('posts.show',['posts'=>$posts,'comments' => $comments]);
    }

    public function updateshow(PostSubCategory $Sub_Categories,$id){
        $posts = Post::find($id);
        $sub_category=\DB::table('post_sub_categories')->get();
        return view('posts.update',compact('posts'),['sub_category' => $sub_category]);

    }

    public function category(){
        $posts = Post::all();
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
        return view('posts.category',['main_categories' => $main_categories,'post_main_categories' => $postMainCategories,'posts' => $posts]);
    }

    public function add(Request $request){
        $validator = Validator::make($request->all(),[
            'main_category' => 'required|string|max:100|unique:post_main_categories',
        ]);

        $main_category = $request->input('newMainCategory');

        \DB::table('post_main_categories')->insert([
            'main_category' => $main_category,
        ]);
        return redirect('/category');

    }

    public function addsub(Request $request){
       $validator = Validator::make($request->all(),[
            'post_main_category_id' => 'required',
            'sub_category' => 'required|string|max:100|unique:post_sub_categories',
        ]);

        $main_category_id = $request->input('MainCategory');
        $sub_category = $request->input('newSubCategory');

        \DB::table('post_sub_categories')->insert([
            'post_main_category_id' => $main_category_id,
            'sub_category' => $sub_category,
        ]);
        return redirect('/category');
    }

    public function delete_main($id){
        \DB::table('post_main_categories')
            ->where('id', $id)
            ->delete();

        return redirect('/category');
    }

    public function delete_sub($id){
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
        $validator = validator::make($request->all(),[
            'post_sub_category_id' => 'required',
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


    public function postupdate(Request $request,$id){
        $validator = Validator::make($request->all(), [
            'post_sub_category_id' => 'required',
            'title' => 'required|string|max:100',
            'post' => 'required|string|max:5000',
        ]);
        $validator->validate();
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

    public function search(Request $request){

        $keyword = $request->input('search');

        if (!empty($keyword)){
            $posts = Post::whereHas('PostSubCategory',function($query) use ($keyword){
            $query->where('sub_category','=',"$keyword")
            ->orWhere('post', 'LIKE', "%{$keyword}%")
            ->orWhere('title', 'LIKE', "%{$keyword}%");
        })->withCount('PostFavorites')->get();
    }

        return view('posts.index', compact('posts','keyword'));
    }

    public function showmypost(Request $request){
        $mypost = $request->input('mypost');

        if(!empty($mypost)) {
            $posts = Post::where('user_id',\Auth::user()->id)->withCount('PostFavorites')->get();
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
