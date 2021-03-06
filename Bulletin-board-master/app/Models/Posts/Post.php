<?php

namespace App\Models\Posts;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';

    protected $fillable = [
        'user_id',
        'post_sub_category_id',
        'delete_user_id',
        'update_user_id',
        'title',
        'post',
        'event_at',
    ];

    public function action_logs(){
    return $this->hasMany('App\Models\ActionLogs\ActionLog');
    }

    public function user(){
        return $this->belongsTo('App\Models\Users\User');
    }

    public function PostSubCategory(){
        return $this->belongsTo('App\Models\Posts\PostSubCategory');
    }

    public function comments(){
    return $this->hasMany('App\Models\Posts\PostComment');
    }

    public function PostFavorites() {
        return $this->hasMany('App\Models\Posts\PostFavorite');
    }

    public function isLikedBy($user): bool {
        return PostFavorite::where('user_id', $user->id)->where('post_id', $this->id)->first() !==null;
    }

}
