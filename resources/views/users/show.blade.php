@extends('layouts.default')

@section('title', $user->name)

@section('content')
<h1>
  ログインユーザー
</h1>
<p>{{ $loginUser }}</p>
@if($loginUser == $user->id)
    <a href={{ "/user/edit" }}>ユーザープロフィールを編集する</a>
@else
    {!! Form::open(['method' => 'post','url' => 'follows']) !!}
    <input type="hidden" name="from_user_id" value="{{ $loginUser }}">
    <input type="hidden" name="to_user_id" value="{{ $user->id }}">
    <button type="submit">Follow</button>
    {!! Form::close() !!}
@endif
<h1>
  <a href="{{ url('/post')}}" class="header-menu">Back</a>
  ユーザー詳細
</h1>
<p>ユーザーID：</p>
<p>{{ $user->id }}</p>
<p>ユーザー名：</p>
<p>{{ $user->name }}</p>
<p>ユーザーアドレス：</p>
<p>{{ $user->email }}</p>

<ul>
  @forelse ($posts as $post)
  <li>

    <div class="list_post_wrap">
    <h3>ツイートタイトル：</h3>
    <p class="post_title">{{ $post->title }}</p>
    <h3>ツイート内容：</h3>
    <p class="post_body">{{ $post->body }}</p>
    </div>

  </li>
  @empty
  <li>No posts yet</li>
  @endforelse
</ul>

@endsection
