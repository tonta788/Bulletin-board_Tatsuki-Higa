@extends('layouts.login')

@section('header')
<h1>投稿編集画面</h1>
<div id="row">
 <div class="main-block">
  @if($posts->id)
  <form action="{{ url('post/update'.$posts->id) }}" enctype="multipart/form-data" method="post">
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

      <label>サブカテゴリー</label>
      <div>
       <select name="up_post_sub_category_id" class="form">
       @foreach($sub_category as $sub_category)
       <option value="{{ $sub_category->id }}">{{ $sub_category->sub_category }}</option>
       @endforeach
       </select>
      </div>

      <label>タイトル</label>
      <div><input type="text" name="up_title" value="{{ $posts->title }}" class="form"></div>

      <label>投稿内容</label>
      <div><input type="text" name="up_post" value="{{ $posts->post }}" class="post-form"></div>

    <button type=submit class="btn btn-danger form">更新</button>
  </form>
    <div><a href="/post/{{$posts->id}}/delete" class="btn btn-danger form">削除</a></div>
  @endif
 </div>
</div>
@endsection
