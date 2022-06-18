<?php

namespace App\Models\Users;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'username',
        'email',
        'password',
        'admin_role',
    ];

    public function posts(){
    return $this->hasMany('App\Models\Posts\Post');
    }

    public function comments(){
    return $this->hasMany('App\Models\Posts\PostComment');
    }

    public function PostFavorites(){
    return $this->hasMany('App\Models\Posts\PostFavorite');
    }

    public function isPostFavorite($postId)
    {
      return $this->PostFavorites()->where('post_id',$postId)->exists();
    }

    public function PostFavorite($postId)
    {
      if($this->isPostFavorite($postId)){
        //もし既に「いいね」していたら何もしない
      } else {
        $this->PostFavorites()->attach($postId);
      }
}
     public function unPostFavorite($postId)
    {
      if($this->isPostFavorite($postId)){
        //もし既に「いいね」していたら消す
        $this->PostFavorites()->detach($postId);
      } else {
      }
}
}
