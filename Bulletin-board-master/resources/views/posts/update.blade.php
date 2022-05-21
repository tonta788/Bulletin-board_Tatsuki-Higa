@extends('layouts.login')

@section('header')
<h1>投稿編集画面</h1>
@endsection
@section('content')
<form>
  <div>
   <label>サブカテゴリー</label>
   <input type="text" name="sub-category">
</div>
 <div>
   <label>タイトル</label>
   <input type="text" name="title">
</div>
<div>
  <label>投稿内容</label>
  <input type="text" name="post">
</div>
<div>
<button type=submit>更新</button>
</div>
<div>
<button type=submit>削除</button>
</div>
</form>

@endsection
