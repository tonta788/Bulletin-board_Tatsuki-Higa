@extends('layouts.login')
@section('header')
<h1>掲示板投稿一覧</h1>

<div class="sidemenu">
 <button id="btn"><a href="/category">カテゴリーを追加</a></button>
             <button id="btn"><a href="/post">投稿</a></button>

             <form action="{{ url('/search') }}" method="get">
                 <input type="search" name="search" class="Form-searcharea" id="btn">
                 <button type="submit" class="btn-search" id="btn">検索</button>
                </form>

                <div class="keyword">
                  @if(isset($keyword))
                  <p>検索ワード：{{$keyword}}</p>
                  @endif
                </div>

                <div><button id="btn">いいねした投稿</button></div>
                <div><button id="btn">自分の投稿</button></div>
</div>
@endsection
@section('content')

<div class="post-block">
@forelse ($posts as $post)

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
        <i class="far fa-heart favorite-toggle" data-post-id="{{ $post->id }}"></i>
      <span class="favorite-counter">{{$post->favorites_count}}</span>
    </span>
    {{ $post->PostFavorites()->count() }}
  @else
    <span class="favorites">
        <i class="fas fa-heart favorite-toggle favorited" data-post-id="{{ $post->id }}"></i>
      <span class="favorite-counter">{{$post->favorites_count}}</span>
    </span>
    {{ $post->PostFavorites()->count() }}
  @endif


</div>
</div>

@empty
        <p>No posts</p>
    @endforelse

</div>

@endsection
