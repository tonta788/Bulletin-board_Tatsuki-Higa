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
<select name="SubCategory">
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
<button type=submit>更新</button>
</div>
<div>
<button type=submit>削除</button>
</div>
</form>

@endif
@endsection
