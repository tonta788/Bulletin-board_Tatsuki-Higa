<?php

namespace App\Models\Posts;

use Illuminate\Database\Eloquent\Model;

class PostCommentFavorite extends Model
{
    protected $table = 'post_comment_favorites';

    protected $fillable = [
        'user_id',
        'post_comment_id',
    ];

    public function user(){
        return $this->belongsTo('App\Models\Users\User');
    }

    public function post(){
		return $this->belongsTo('App\Models\Posts\Post');
	}

    public function PostCommentFavorites() {
        return $this->hasMany('App\Models\Posts\PostCommentFavorite');
    }
}
