<?php

namespace App\Models\Posts;

use Illuminate\Database\Eloquent\Model;

class PostMainCategory extends Model
{
    protected $table = 'post_main_categories';

    protected $fillable = [
        'main_category',
    ];

    public function getLists()
{
    $categories = Category::orderBy('id','asc')->pluck('main_category', 'id');

    return $categories;
}
}
