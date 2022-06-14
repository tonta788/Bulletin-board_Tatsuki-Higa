@extends('layouts.login')

@section('header')
<h1>新規投稿画面</h1>
@endsection
@section('content')
<form action="{{ url('post/create') }}" method="post">
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
    <label for="category-id">{{ __('サブカテゴリー') }}</label>
  </div>
  <div>
   <select name="SubCategory">
     @foreach($sub_categories as $sub_categories)
        <option value="{{ $sub_categories->id }}">{{ $sub_categories->sub_category }}</option>
    @endforeach
</select>
  </div>
 <div>
   <label>タイトル</label>
  </div>
  <div>
   <input type="text" name="newTitle">
  </div>
<div>
  <label>投稿内容</label>
</div>
<div>
  <input type="text" name="newPost">
</div>
<button type=submit>投稿</button>
</form>

@endsection
