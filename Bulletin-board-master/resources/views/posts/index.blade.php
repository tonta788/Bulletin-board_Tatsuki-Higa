@extends('layouts.login')
<h1>掲示板投稿一覧</h1>
@section('header')

<div class="sidemenu">
  @if(Auth::user()->admin_role == 1)
 <button id="btn"><a href="/category">カテゴリーを追加</a></button>
 @endif
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

                <form action="{{ url('/liked') }}">
                <div><button  id="btn" >いいねした投稿</button></div>
                <input type="hidden" name="liked" value="{{ Auth::id() }}">
                </form>

                <form action="{{ url('/showmypost') }}">
                <div><button type="submit" id="btn">自分の投稿</button></div>
                <input type="hidden" name="mypost" value="{{ Auth::id() }}">
                </form>
</div>


<div class="post-block">
@forelse ($posts as $post)


<div class="post-content">
  <div>
<div>{{ $post->action_logs()->count() }}View</div>
    <div class="post-name">{{ $post->user->username }}</div>
    <div>{{ $post->event_at }}</div>
    </div>
    <div><a href="/show/{{$post->id}}">{{ $post->title }}</a></div>
    <div>{{ $post->PostSubCategory->sub_category }}</div>
    <div>コメント数{{ $post->comments()->get()->count() }}</div>

     @if (!$post->isLikedBy(Auth::user()))
    <span class="favorites">
        <i class="far fa-heart favorite-toggle" data-post-id="{{ $post->id }}"></i>
      <span class="favorite-counter">{{$post->post_favorites_count}}</span>
    </span>
  @else
    <span class="favorites">
        <i class="fas fa-heart favorite-toggle favorited" data-post-id="{{ $post->id }}"></i>
      <span class="favorite-counter">{{$post->post_favorites_count}}</span>
    </span>
  @endif

</div>
</div>

@empty
        <p>No posts</p>

    @endforelse

</div>

<div class="category-list">
  <h2>カテゴリー</h2>
  <ul>
  @foreach ($post_main_categories as $post_main_category)
  <li>{{ $post_main_category->main_category }}
    <ul>
      @foreach ($post_main_category->PostSubCategories as $post_sub_category)
      <li>{{ $post_sub_category->sub_category }}
      @endforeach
    </ul>
  </li>
  @endforeach
</ul>
</div>




@endsection
