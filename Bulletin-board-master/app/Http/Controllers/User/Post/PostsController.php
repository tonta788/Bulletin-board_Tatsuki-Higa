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
        return view('posts.category',['main_categories' => $main_categories]);
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

    public function create(){
        return view('posts.create');
    }

    public function update(){
        return view('posts.update');
    }
}
