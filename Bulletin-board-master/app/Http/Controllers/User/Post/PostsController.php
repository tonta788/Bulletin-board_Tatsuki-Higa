<?php

namespace App\Http\Controllers\User\Post;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Posts\PostMainCategory;
use App\Models\Posts\PostSubCategory;

class PostsController extends Controller
{
     public function index(){
        return view('posts.index');
    }

    public function show(){
        return view('posts.show');
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
        return view('posts.post');
    }

    public function update(){
        return view('posts.update');
    }
}
