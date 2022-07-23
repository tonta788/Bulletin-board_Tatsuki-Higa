@extends('layouts.login')

@section('header')
<h1>掲示板詳細画面</h1>

<div>
@if ($posts)

 <div class="post-name">{{ $posts->user->username }}さん
 {{ $posts->event_at }}</div>
<div>{{ $posts->action_logs()->count() }}View</div>
 <div>{{ $posts->title }}<button><a href="/post{{$posts->id}}">編集</a></button></div>
 <div>{{ $posts->post }}</div>
<div>{{ $posts->PostSubCategory->sub_category }}</div>
<div>コメント数{{ $posts->comments()->get()->count() }}</div>
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
  @endif


@endif
</div>

<p>コメント一覧</p>
@foreach($comments as $comments)
@if ($posts->id == $comments->post_id)

<div>{{ $comments->user->username }}さん　{{ $comments->event_at }}</div>
<div>{{ $comments->comment }}</div>
<button><a href="/comment{{$comments->id}}">編集</a></button>

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
@endif
@endforeach

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
<input type="text" name="newComment" placeholder="コチラから入力できます">
<input type="hidden" value="{{ Auth::id() }}" name="user_id">
<input type="hidden" value="{{ $posts->id }}" name="post_id">
<div>
<button type=submit>コメント</button>
</div>
</form>



@endsection
