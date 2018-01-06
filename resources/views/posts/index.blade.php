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
  <li>
    <a href="{{ action('PostsController@show', $post) }}">{{ $post->title }}</a>

    {!! Form::open(['method' => 'post','url' => 'likes']) !!}
    <input type="hidden" name="post_id" value="{{ $post->id }}">
    <button type="submit">Like</button>
    {!! Form::close() !!}

    <a href="{{ action('PostsController@edit', $post) }}" class="edit">[Edit]</a>
    <a href="#" class="del" data-id="{{ $post->id }}">[x]</a>
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
