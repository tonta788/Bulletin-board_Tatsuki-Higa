@extends('layouts.login')

@section('header')
<h1>新規投稿画面</h1>
<div id="row">
 <div class="main-block">

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

     <label for="category-id">{{ __('サブカテゴリー') }}</label>
     <div>
       <select name="post_sub_category_id" class="form">
       @foreach($sub_categories as $sub_categories)
       <option value="{{ $sub_categories->id }}">{{ $sub_categories->sub_category }}</option>
       @endforeach
       </select>
     </div>

     <div><label>タイトル</label></div>
     <div><input type="text" name="title" class="form"></div>
     <div><label>投稿内容</label></div>
     <div><input type="text" name="post" class="post-form"></div>
     <button type=submit class="btn btn-danger form">投稿</button>
    </form>
 </div>
</div>
@endsection
