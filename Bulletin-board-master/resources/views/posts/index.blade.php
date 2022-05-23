@extends('layouts.login')
@section('header')
<h1>掲示板投稿一覧</h1>
@endsection

@section('content')
<div class="post-block">
<div class="post-content">
  <div>
    <div class="post-name">〇〇さん</div>
    <div>作成日</div>
    </div>
    <div>内容</div>
</div>
</div>



 <button id="btn"><a href="/category">カテゴリーを追加</a></button>
             <button id="btn"><a href="/post">投稿</a></button>

             <form>
                 <input type="text" name="title" class="Form-searcharea" id="btn">
                 <button type="submit" class="btn-search" id="btn">検索</button>
                </form>
                <div><button id="btn">いいねした投稿</button></div>
                <div><button id="btn">自分の投稿</button></div>
            </div>
@endsection
