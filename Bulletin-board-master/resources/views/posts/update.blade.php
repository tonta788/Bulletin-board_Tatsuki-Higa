@extends('layouts.login')

@section('header')
<h1>投稿編集画面</h1>
@endsection
@section('content')
@if($posts->id)
<form action="{{ url('post/update{id}') }}" enctype="multipart/form-data" method="post">
  @csrf
  <div>
   <label>サブカテゴリー</label>
<select name="post_sub_category_id">
     @foreach($sub_category as $sub_category)
        <option value="{{ $sub_category->id }}">{{ $posts->PostSubCategory->sub_category }}</option>
    @endforeach
</select>
</div>
 <div>
   <label>タイトル</label>
   <input type="text" name="title" value={{ $posts->title }}>
</div>
<div>
  <label>投稿内容</label>
  <input type="text" name="post" value={{ $posts->post }}>
</div>
<div>
<button type=submit><a href="/show/{{$posts->id}}">更新</a></button>
</div>
</form>
<div>
<button type=submit><a href="/post/{{$posts->id}}/delete">削除</a></button>
</div>


@endif
@endsection
