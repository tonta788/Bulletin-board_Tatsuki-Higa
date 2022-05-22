@extends('layouts.login')

@section('header')
<h1>カテゴリー追加画面</h1>
@endsection
@section('content')

<form action="{{ url('categoryadd') }}" enctype="multipart/form-data" method="post">
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

<form action="{{ url('categoryaddsub') }}" enctype="multipart/form-data" method="post">
  @csrf
<div class="form-group">
<label for="category-id">{{ __('メインカテゴリー') }}</label>
<div>
<select name="MainCategory">
    @foreach($main_categories as $main_categories)
        <option value="{{ $main_categories->id }}">{{ $main_categories->main_category }}</option>
    @endforeach
</select>
</div>
</div>

<div>
<label>新規サブカテゴリー</label>
</div>
<div>
<input type="text" name="newSubCategory">
</div>
<div>
<button type=submit>登録</button>
</div>
</form>


@endsection
