@extends('layouts.login')

@section('header')
<h1>コメント編集画面</h1>
<div id="row">
 <div class="main-block">
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

     <label for="comment">コメント</label>
     <div><input type="text" name="comment" value="{{ $comment->comment }}" class="post-form">
      <input type="hidden" name="post_id" value="{{ $comment->post_id }}">
     </div>

     <button type=submit class="btn btn-danger form">更新</button>
  </form>
  <div><a href="/comment/{{$comment->id}}/delete" class="btn btn-danger form">削除</a></div>
  @endif
 </div>
</div>
@endsection
