@extends('layouts.default')

@section('title', 'いいね！一覧')

@section('content')
<h1>
  {{ $user->name }}のいいね！一覧
</h1>
@if (Auth::check())
<p class="login_user_name">ログインユーザー名: {{ $user->name . '(' . $user->email . ')' }}</p>
<p class="login_user_id">ログインユーザーID: {{ $user->id }}</p>
@else
<p>※ログインしていません。(<a href="/login">ログイン</a>|<a href="/register">登録</a>)</p>
@endif
<ul>
  @forelse ($posts as $post)
  <li>
    <p class="user">投稿ユーザーID：{{ $post->user_id }}</p>

    <div class="list_post_wrap">
    <h3>ツイートタイトル：</h3>
    <p class="post_title">{{ $post->title }}</p>
    <h3>ツイート内容：</h3>
    <p class="post_body">{{ $post->body }}</p>
    </div>

  </li>
  @empty
  <li>まだいいね！されてません</li>
  @endforelse
</ul>
@endsection
