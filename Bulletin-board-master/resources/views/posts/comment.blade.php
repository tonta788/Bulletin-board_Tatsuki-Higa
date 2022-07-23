@extends('layouts.login')

@section('header')
<h1>コメント編集画面</h1>

@if($comment->id)
<form action="{{ url('/comment/update'.$comment->id) }}" method="post">
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
<div>
  <label for="comment">コメント</label>
  <input type="text" name="upComment" value="{{ $comment->comment }}">
  <input type="hidden" name="post_id" value="{{ $comment->post_id }}">
</div>
<div>
<button type=submit>更新</a></button>
</div>
</form>
<div>
<button type=submit><a href="/comment/{{$comment->id}}/delete">削除</a></button>
</div>

@endif
@endsection
