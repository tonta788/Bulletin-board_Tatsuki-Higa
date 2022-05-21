<?php

namespace App\Http\Controllers\User\Post;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Posts\PostMainCategory;

class PostsController extends Controller
{
     public function index(){
        return view('posts.index');
    }

    public function show(){
        return view('posts.show');
    }

    public function category(){
        return view('posts.category');
    }

    public function add(Request $request)
    {
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

    public function create(){
        return view('posts.create');
    }

    public function update(){
        return view('posts.update');
    }
}
