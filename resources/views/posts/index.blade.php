@extends('layouts.default')

{{--
@section('title')
Blog Posts
@endsection
--}}
@section('title', 'Blog Posts')

@section('content')
@if (Auth::check())
<p class="login_user_name">ログインユーザー名: {{ $user->name . '(' . $user->email . ')' }}</p>
<p class="login_user_id">ログインユーザーID: {{ $user->id }}</p>
<a href="{{ action('UsersController@show', $user) }}" class="post_detail_link">[ユーザー詳細画面へ]</a>
@else
<p>※ログインしていません。(<a href="/login">ログイン</a>|<a href="/register">登録</a>)</p>
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
    {!! Form::open(['method' => 'post','url' => 'follows']) !!}
    <input type="hidden" name="from_user_id" value="{{ $post->user_id }}">
    <button type="submit">Follow</button>
    {!! Form::close() !!}

    <div class="list_post_wrap">
    <h3>ツイートタイトル：</h3>
    <p class="post_title">{{ $post->title }}</p>
    <h3>ツイート内容：</h3>
    <p class="post_body">{{ $post->body }}</p>
    </div>

    {!! Form::open(['method' => 'post','url' => 'likes']) !!}
    <input type="hidden" name="post_id" value="{{ $post->id }}">
    <button type="submit">Like</button>
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
