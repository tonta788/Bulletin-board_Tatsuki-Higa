@extends('layouts.login')

@section('header')
<h1>カテゴリー追加画面</h1>
@endsection
@section('content')

<form action="{{ url('categoryadd') }}" enctype="multipart/form-data" method="post">
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
  @if ($errors->any())
      <div class="alert alert-danger">
          <ul>
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div>
   @endif
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


<div class="category-list">
  <h2>カテゴリー一覧</h2>
  <ul>
  @foreach ($post_main_categories as $post_main_category)
  <li>{{ $post_main_category->main_category }}
    @if ($post_main_category == $post_main_category->PostSubCategories)
    <button><a href="/main_category/{{$post_main_category->id}}/delete">削除</a></button>
    @endif
    <ul>
      @foreach ($post_main_category->PostSubCategories as $post_sub_category)
      <li>{{ $post_sub_category->sub_category }}
      <button><a href="/sub_category/{{$post_sub_category->id}}/delete">削除</a></button></li>
      @endforeach
    </ul>
  </li>
  @endforeach
</ul>
</div>

@endsection
