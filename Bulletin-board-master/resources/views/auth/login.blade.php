@extends('layouts.logout')

@section('content')

<div id="clear">
  <h1>ログイン</h1>
   <form action="/top" method="post">
    @csrf
    <div class="form-content">
     <label>メールアドレス</label>
     <div><input type="text" name="email" class="form"></div>
    </div>

    <div class="form-content">
     <label>パスワード</label>
     <div><input type="password" name="password" class="form"></div>
    </div>

    <div><button type=submit class="btn btn-primary">ログイン</button></div>

    <p>新規ユーザーの方は<a class="btn" href="/register">こちら</a></p>
   </form>
</div>

@endsection
