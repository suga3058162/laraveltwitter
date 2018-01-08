<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\PostRequest;

class PostsController extends Controller
{
    public function index(){
      $user = Auth::user();
      //フォローしているユーザーIDを取得する
      $userIds = $user->follows->pluck('id');
      $userIds[] = $user->id;

      //フォローしているユーザーIDを元に、フォローしているユーザーのツイートを取得する
      $posts = Post::whereIn('user_id', $userIds)->get();

      //Postを新しい順にDBから取得する
      // $posts = Post::latest()->get();
      //配列に入れる
      $param = ['user' => $user, 'posts' => $posts];
      return view('posts.index', $param);
    }

    // public function show($id){
    public function show(Post $post){
      // $post = Post::find($id);
      // $post = Post::findOrFail($id);
      return view('posts.show', ['post' => $post]);
    }

    public function create(){
      return view('posts.create');
    }

    public function store(PostRequest $request){
      $user = \Auth::user();

      $post = new Post();
      $post->title = $request->title;
      $post->body = $request->body;

      $post->user_id = $user->id;

      $post->save();
      return redirect('/post');
    }

    public function edit(Post $post){
      return view('posts.edit')->with('post', $post);
    }

    public function update(PostRequest $request, Post $post){
      $post->title = $request->title;
      $post->body = $request->body;
      $post->save();
      return redirect('/post');
    }

    public function destroy(Post $post) {
      $post->delete();
      return redirect('/post');
    }
}
