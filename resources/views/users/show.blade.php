@extends('layouts.default')

@section('title', $user->name)

@section('content')
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

@endsection
