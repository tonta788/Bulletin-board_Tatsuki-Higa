@extends('layouts.logout')

@section('content')

<div id="clear">
  <h2>新規ユーザー登録</h2>
   <form action="/register" method="post">
   {{csrf_field()}}
    @if ($errors->any())
     <div class="alert alert-danger">
      <ul>
       @foreach ($errors->all() as $error)
       <li>{{ $error }}</li>
       @endforeach
      </ul>
     </div>
    @endif
   <div class="form-content">
    <label>ユーザー名</label>
    <div><input type="text" name="username" class="form"></div>
   </div>

   <div class="form-content">
    <label>メールアドレス</label>
    <div><input type="text" name="email" class="form"></div>
   </div>

   <div class="form-content">
    <label>パスワード</label>
    <div><input type="password" name="password" class="form"></div>
   </div>

   <div class="form-content">
    <label>パスワード確認</label>
    <div><input type="password" name="password_confirmation" class="form"></div>
   </div>

   <div><button type=submit class="btn btn-primary">確認</button></div>
  </form>
</div>

@endsection
