@extends('layouts.login')
@section('header')
<h1>掲示板投稿一覧</h1>
@endsection

@section('content')
<div class="post-block">
@foreach ($posts as $post)

<div class="post-content">
  <div>
<div>{{ SESSION('count') }}View</div>
    <div class="post-name">{{ $post->user->username }}</div>
    <div>{{ $post->event_at }}</div>
    </div>
    <div><a href="/show/{{$post->id}}">{{ $post->title }}</a></div>
    <div>{{ $post->PostSubCategory->sub_category }}</div>
    <div>コメント数{{ $post->comments()->get()->count() }}</div>

     @if (!$post->isLikedBy(Auth::user()))
    <span class="favorites">
        <a class="favorite-toggle" data-post-id="{{ $post->id }}"><i class="far fa-heart"></i></a>
      <span class="favorite-counter">{{$post->favorites_count}}</span>
    </span>
  @else
    <span class="favorites">
        <a class="favorite-toggle favorited" data-post-id="{{ $post->id }}"><i class="fa fa-heart" style="color:red"></i></a>
      <span class="favorite-counter">{{$post->favorites_count}}</span>
    </span>
  @endif


</div>
</div>

@endforeach

<div class="sidemenu">
 <button id="btn"><a href="/category">カテゴリーを追加</a></button>
             <button id="btn"><a href="/post">投稿</a></button>

             <form>
                 <input type="text" name="title" class="Form-searcharea" id="btn">
                 <button type="submit" class="btn-search" id="btn">検索</button>
                </form>
                <div><button id="btn">いいねした投稿</button></div>
                <div><button id="btn">自分の投稿</button></div>
</div>
</div>
@endsection
