@extends('layouts.default')

{{--
@section('title')
Blog Posts
@endsection
--}}
@section('title', 'Blog Posts')

@section('content')
@if (Auth::check())
<p>USER: {{ $user->name . '(' . $user->email . ')' }}</p>
@else
<p>※ログインしていません。(<a href="/login">ログイン</a>|<a href="/register">登録</a>)</p>
@endif
<h1>
  <a href="{{ url('/post/create')}}" class="header-menu">New Post</a>
  Blog Posts
</h1>
<ul>
  {{--
    @foreach ($posts as $post)
    <li><a href="">{{ $post->title }}</a></li>
    @endforeach
  --}}
  @forelse ($posts as $post)
  <li><a href="{{ action('PostsController@show', $post) }}">{{ $post->title }}</a></li>
  @empty
  <li>No posts yet</li>
  @endforelse
</ul>
@endsection
