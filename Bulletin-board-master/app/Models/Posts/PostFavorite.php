<?php

namespace App\Models\Posts;

use Illuminate\Database\Eloquent\Model;

class PostFavorite extends Model
{
    protected $table = 'post_favorites';

    protected $fillable = [
        'user_id',
        'post_id',
    ];

    public function user(){
        return $this->belongsTo('App\Models\Users\User');
    }

    public function post(){
		return $this->belongsTo('App\Models\Posts\Post');
	}

    public function comment(){
    return $this->belongsTo('App\Models\Posts\PostComment');
    }

}
