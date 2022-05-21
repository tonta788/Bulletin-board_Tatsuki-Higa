@extends('layouts.login')

@section('header')
<h1>コメント編集画面</h1>
@endsection
@section('content')
<form>
<div>
  <label>コメント</label>
  <input type="text" name="comment">
</div>
<div>
<button type=submit>更新</button>
</div>
<div>
<button type=submit>削除</button>
</div>
</form>

@endsection
