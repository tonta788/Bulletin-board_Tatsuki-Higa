@extends('layouts.login')

@section('header')
<h1>コメント編集画面</h1>
@endsection
@section('content')
@if($comment->id)
<form action="{{ url('/comment/update'.$comment->id) }}" method="post">
  @csrf
<div>
  <label>コメント</label>
  <input type="text" name="upComment" value="{{ $comment->comment }}">
</div>
<div>
<button type=submit><a href="/show/{{$comment->post_id}}">更新</a></button>
</div>
</form>
<div>
<button type=submit><a href="/comment/{{$comment->id}}/delete">削除</a></button>
</div>

@endif
@endsection
