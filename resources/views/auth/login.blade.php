@extends('layouts.logout')

@section('content')

<div id="clear">

<h1>ログイン</h1>
<form action="/top" method="post">
@csrf
 <div>
   <label>メールアドレス</label>
</div>
<div>
   <input type="text" name="email">
</div>

<div>
  <label>パスワード</label>
</div>
<div>
  <input type="password" name="password">
</div>
<div>
<button type=submit class="btn btn-primary">ログイン</button>
</div>


<p>新規ユーザーの方は<a class="btn" href="/register">こちら</a></p>

</form>
</div>

@endsection
