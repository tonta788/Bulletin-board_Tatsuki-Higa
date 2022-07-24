@extends('layouts.login')

@section('header')
<h1>掲示板詳細画面</h1>
<div id="row">
 <div class="main-block">
    @if ($posts)
      <div>{{ $posts->user->username }}さん　
      {{ $posts->created_at->format('Y年m月d日') }}　
      {{ $posts->action_logs()->count() }}View</div>
      <div>{{ $posts->title }}　
        @if(Auth::user()->id == $posts->user_id )
        <a href="/post{{$posts->id}}" class="btn btn-danger">編集</a></div>
        @endif
      <div>{{ $posts->post }}</div>
      <div><button class="btn btn-primary">{{ $posts->PostSubCategory->sub_category }}</button>　
       コメント数{{ $posts->comments()->get()->count() }}　
       @if (!$posts->isLikedBy(Auth::user()))
        <span class="favorites">
        <i class="far fa-heart favorite-toggle" data-post-id="{{ $posts->id }}"></i>
        <span class="favorite-counter">{{$posts->PostFavorites->count()}}</span>
        </span>
       @else
        <span class="favorites">
        <i class="fas fa-heart favorite-toggle favorited" data-post-id="{{ $posts->id }}"></i>
        <span class="favorite-counter">{{$posts->PostFavorites->count()}}</span>
        </span>
       </div>
      @endif
   @endif


  <div>

     @foreach($comments as $comments)
      @if ($posts->id == $comments->post_id)
      <div class="comment-block">
        <div>{{ $comments->user->username }}さん　{{$comments->created_at->format('Y年m月d日') }}　
          @if(Auth::user()->id == $comments->user_id )
           <a href="/comment{{$comments->id}}" class="btn btn-danger">編集</a>
        </div>
          @endif
        <div>{{ $comments->comment }}　

          @if (!$comments->isLikedBy(Auth::user()))
           <span class="favorites">
           <i class="far fa-heart favorite_comment" data-comments-id="{{ $comments->id }}"></i>
           <span class="favorite-counter">{{$comments->post_comment_favorites_count}}</span>
           </span>
          @else
           <span class="favorites">
           <i class="fas fa-heart favorite_comment favorited_comment" data-comments-id="{{ $comments->id }}"></i>
           <span class="favorite-counter">{{$comments->post_comment_favorites_count}}</span>
           </span>
          @endif
        </div>
       @endif
      </div>
    @endforeach
    </div>



  <div>
   <form action="{{ url('post/comment') }}" method="post">
    @csrf
     @if ($errors->any())
      <div class="alert alert-danger">
       <ul>
        @foreach ($errors->all() as $error)
         <li>{{ $error }}</li>
        @endforeach
       </ul>
      </div>
     @endif
      <div>
        <input type="text" name="newComment" placeholder="コチラから入力できます" class="comment-form">
        <input type="hidden" value="{{ Auth::id() }}" name="user_id">
        <input type="hidden" value="{{ $posts->id }}" name="post_id">
      </div>
        <button type=submit class="btn btn-primary">コメント</button>
   </form>
  </div>

 </div>
</div>

@endsection
