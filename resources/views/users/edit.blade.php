@extends('layouts.default')

@section('title', 'ユーザープロフィール編集')

@section('content')
<h1>
  <a href="{{ url('/post')}}" class="header-menu">Back</a>
  ユーザープロフィール編集
</h1>
<form method="post" action="{{ url('/user') }}" accept-charset="UTF-8">
  {{ csrf_field() }}
  {{ method_field('patch') }}
  <p>
    <input type="text" name="user[name]" placeholder="user name" value="{{ old('name', $user->name)}}">
    @if ($errors->has('name'))
    <span class="error">{{ $errors->first('name') }}</span>
    @endif
  </p>
  <p>
    <input type="text" name="user[email]" placeholder="user email" value="{{ old('email', $user->email) }}">
    @if ($errors->has('email'))
    <span class="error">{{ $errors->first('email') }}</span>
    @endif
  </p>
  <p>
    <input type="submit" value="Update">
  </p>
</form>
@endsection
