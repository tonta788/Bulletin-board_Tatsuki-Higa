@extends('layouts.login')

@section('header')
<h1>カテゴリー追加画面</h1>
<div id="row">
    <div class="main-block">
     <div class="form-content">
      <form action="{{ url('categoryadd') }}" enctype="multipart/form-data" method="post">
        @csrf
        @if ($errors->has('main_category'))
        <div class="alert alert-danger">
          <ul>
            <li>{{ $errors->first('main_category') }}</li>
           </ul>
         </div>
        @endif
           <label>新規メインカテゴリー</label>
           <div><input type="text" name="main_category" class="form"></div>
           <div><button type="submit" class="btn btn-danger form">登録</button></div>
       </form>
     </div>

     <div class="form-content">
       <form action="{{ url('categoryaddsub') }}" enctype="multipart/form-data" method="post">
         @csrf
         <label for="category-id">{{ __('メインカテゴリー') }}</label>
         <div>
          <select name="post_main_category_id" class="form">
            @foreach($main_categories as $main_categories)
            <option value="{{ $main_categories->id }}">{{ $main_categories->main_category }}</option>
            @endforeach
          </select>
          </div>

         <label>新規サブカテゴリー</label>
          @if ($errors->has('sub_category'))
           <div class="alert alert-danger">
            <ul>
             <li>{{ $errors->first('sub_category') }}</li>
            </ul>
           </div>
          @endif
         <div><input type="text" name="sub_category" class="form"></div>
         <div><button type="submit" class="btn btn-danger form">登録</button></div>
       </form>
     </div>
 </div>

 <div class="sidemenu">
      <div id="category-block">
        <h2>カテゴリー一覧</h2>
         <div id="category-list">
          <ul>
            @foreach ($post_main_categories as $post_main_category)
            <li>
             <b>{{ $post_main_category->main_category }}</b>
             @if ($post_main_category == $post_main_category->PostSubCategories->isEmpty())
             <a href="/main_category/{{$post_main_category->id}}/delete" class="btn btn-danger">削除</a>
             @endif
            </li>
           <ul>
            <li>
             @foreach ($post_main_category->PostSubCategories as $post_sub_category)
              {{ $post_sub_category->sub_category }}
              @if ($post_sub_category->posts->isEmpty())
              <a href="/sub_category/{{$post_sub_category->id}}/delete" class="btn btn-danger">削除</a>
              @endif
            @endforeach
             </li>
            </ul>
            @endforeach
          </li>
         </ul>
        </div>
      </div>
 </div>
</div>
@endsection
