@extends('layouts.login')
<h1>カテゴリー追加画面</h1>
@section('header')



<form action="{{ url('categoryadd') }}" enctype="multipart/form-data" method="post">
  @csrf
  @if ($errors->has('main_category'))

      <div class="alert alert-danger">
          <ul>
                  <li>{{ $errors->first('main_category') }}</li>
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
 @if ($errors->has('sub_category'))
      <div class="alert alert-danger">
          <ul>
                  <li>{{ $errors->first('sub_category') }}</li>
          </ul>
      </div>
   @endif
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
    @if ($post_main_category == $post_main_category->PostSubCategories->isEmpty())
    <button><a href="/main_category/{{$post_main_category->id}}/delete">削除</a></button>
    @endif
    <ul>
      @foreach ($post_main_category->PostSubCategories as $post_sub_category)
      <li>{{ $post_sub_category->sub_category }}
          @if ($post_sub_category->posts->isEmpty())
      <button><a href="/sub_category/{{$post_sub_category->id}}/delete">削除</a></button></li>
      @endif
      @endforeach
    </ul>
  </li>
  @endforeach
</ul>

</div>

@endsection
