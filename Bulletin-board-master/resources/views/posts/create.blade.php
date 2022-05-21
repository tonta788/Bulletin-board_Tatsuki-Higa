@extends('layouts.login')

@section('header')
<h1>新規投稿画面</h1>
@endsection
@section('content')
<form>
  <div>
    <label>サブカテゴリー</label>
  </div>
  <div>
   <input type="text" name="sub-category">
  </div>
 <div>
   <label>タイトル</label>
  </div>
  <div>
   <input type="text" name="title">
  </div>
<div>
  <label>投稿内容</label>
</div>
<div>
  <input type="text" name="post">
</div>
<button type=submit>投稿</button>
</form>

@endsection
