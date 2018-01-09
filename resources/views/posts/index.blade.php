@extends('layouts.default')

{{--
@section('title')
Blog Posts
@endsection
--}}
@section('title', 'Blog Posts')

@section('content')
@if (Auth::check())
<a href="/login" class="post_detail_link">ログイン・ログアウト画面へ</a>
<p class="login_user_name">ログインユーザー名: {{ $user->name . '(' . $user->email . ')' }}</p>
<p class="login_user_id">ログインユーザーID: {{ $user->id }}</p>
<a href="{{ action('UsersController@show', $user) }}" class="post_detail_link">[ユーザー詳細画面へ]</a>
@else
<p>※ログインしていません。(<a href="/login">ログインする</a>|<a href="/register">登録する</a>)</p>
@endif
<h1>
  <a href="{{ url('/post/create')}}" class="header-menu">ツイートする</a>
  ツイート一覧
</h1>
<ul>
  {{--
    @foreach ($posts as $post)
    <li><a href="">{{ $post->title }}</a></li>
    @endforeach
  --}}
  @forelse ($posts as $post)
  <li>
    <p class="user">投稿ユーザーID：{{ $post->user_id }}</p>

    <div class="list_post_wrap">
        <h3>ツイートタイトル：</h3>
        <p class="post_title">{{ $post->title }}</p>
        <h3>ツイート内容：</h3>
        <p class="post_body">{{ $post->body }}</p>
    </div>

    @if($post->isLiked())
        <p>いいね解除ボタン↓</p>
        {!! Form::open(['url' => '/likes/'.$post->id]) !!}
            {{ method_field('delete') }}
            <input type="hidden" name="id" value="{{ $post->id }}">
            <button type="submit">いいね解除</button>
        {!! Form::close() !!}
    @else
        {!! Form::open(['method' => 'post','url' => 'likes']) !!}
            <input type="hidden" name="post_id" value="{{ $post->id }}">
            <button type="submit">Like</button>
        {!! Form::close() !!}
    @endif

    {!! Form::open(['method' => 'post','url' => 'retweets']) !!}
        <input type="hidden" name="post_id" value="{{ $post->id }}">
        <input type="hidden" name="post_title" value="{{ $post->title }}">
        <input type="hidden" name="post_body" value="{{ $post->body }}">
        <button type="submit">Retweets</button>
    {!! Form::close() !!}

    <a href="{{ action('PostsController@show', $post) }}" class="post_detail_link">[ツイート詳細画面へ]</a>
    <a href="{{ action('PostsController@edit', $post) }}" class="edit">[ツイート編集画面へ]</a>
    <a href="#" class="del" data-id="{{ $post->id }}">[ツイート削除]</a>
    <form method="post" action="{{ url('/post', $post->id) }}" id="form_{{ $post->id }}">
        {{ csrf_field() }}
        {{ method_field('delete') }}
    </form>
  </li>
  @empty
      <li>No posts yet</li>
  @endforelse
</ul>
<script src="/js/main.js"></script>
@endsection
