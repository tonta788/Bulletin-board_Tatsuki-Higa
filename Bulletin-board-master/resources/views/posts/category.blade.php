@extends('layouts.login')

@section('header')
<h1>カテゴリー追加画面</h1>
@endsection
@section('content')

<form action="{{ url('category') }}" enctype="multipart/form-data" method="post">
  @csrf
<div>
<label>新規メインカテゴリー</label>
</div>
<div>
<input type="text" name="newMainCategory">
</div>
<div>
<button type="submit">登録</button>
</div>
</form>

<form>
<div>
<label>新規メインカテゴリー</label>
</div>
<div>
<input type="text" name="main-category">
</div>
<div>
<label>新規サブカテゴリー</label>
</div>
<div>
<input type="text" name="sub-category">
</div>
<div>
<button type=submit>登録</button>
</div>
</form>


<div>
<h2>カテゴリー一覧</h2>
</div>

@endsection
