@extends('layouts.default')

@section('title', 'ユーザー一覧')

@section('content')
<h1>
  ユーザー一覧
</h1>
<ul>
  @forelse ($users as $user)
  <li>
  
    <div class="list_post_wrap">
    <h3>ユーザーID:</h3>
    <p class="user">{{ $user->id }}</p>
    <h3>ユーザー名:</h3>
    <p class="post_title">{{ $user->name }}</p>
    <h3>ユーザーメールアドレス:</h3>
    <p class="post_body">{{ $user->email }}</p>
    </div>

  </li>
  @empty
  <li>登録されているユーザーは0件です</li>
  @endforelse
</ul>
@endsection
