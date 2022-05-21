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
   <div>
       <label>ユーザー名</label>
    </div>
    <div>
       <input type="text" name="username">
    </div>

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
       <label>パスワード確認</label>
    </div>
    <div>
       <input type="password" name="password_confirmation">
    </div>

    <div>
        <button type=submit class="btn btn-primary">確認</button>
    </div>

</form>
</div>

@endsection
