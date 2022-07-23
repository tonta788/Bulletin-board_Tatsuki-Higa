@extends('layouts.login')

@section('header')
<h1>掲示板投稿一覧</h1>
<div id="row">


<div class="main-block">
 @forelse ($posts as $post)

    <div class="post-content">
      <div>
        <div>{{ $post->action_logs()->count() }}View</div>
        <div class="post-name">{{ $post->user->username }}さん</div>
        <div>{{ $post->event_at }}</div>
      </div>
        <div><a href="/show/{{$post->id}}" class="btn btn-primary">{{ $post->title }}</a></div>
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

    @empty
        <p>投稿はありません</p>
    @endforelse
</div>

 <div class="sidemenu">
   @if(Auth::user()->admin_role == 1)
    <div class="side"><a href="/category" class="btn btn-danger">カテゴリーを追加</a></div>
   @endif
    <div class="side"><a href="/post" class="btn btn-primary">投稿</a></div>
             <div class="side">
               <form action="{{ url('/search') }}" method="get">
                 <input type="search" name="search" class="Form-searcharea">
                 <button type="submit" class="btn btn-primary">検索</button>
                </form>
             </div>

              <div class="keyword">
                  @if(isset($keyword))
                  <p>検索ワード：{{$keyword}}</p>
                  @endif
              </div>

                <form action="{{ url('/liked') }}">
                <div class="side"><button class="btn btn-primary">いいねした投稿</button></div>
                <input type="hidden" name="liked" value="{{ Auth::id() }}">
                </form>

                <form action="{{ url('/showmypost') }}">
                <div class="side"><button type="submit" class="btn btn-primary">自分の投稿</button></div>
                <input type="hidden" name="mypost" value="{{ Auth::id() }}">
                </form>

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
 </div>

</div>
</div>


@endsection
