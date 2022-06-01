@extends('layouts.login')

@section('header')
<h1>掲示板詳細画面</h1>
@endsection
@section('content')
@if ($posts->id)
 <div class="post-name">{{ $posts->user->username }}さん
 {{ $posts->event_at }}</div>
 <div>{{ $posts->title }}<button><a href="/update{{$posts->id}}">編集</a></button>
 <div>{{ $posts->post }}</div>
<div>{{ $posts->PostSubCategory->sub_category }}</div>

@endif
@endsection
