<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Illuminate\Support\Facades\Auth;

class PostsController extends Controller
{
    public function index(){

      //Laravel入門 318ページ
      $user = Auth::user();
      // $sort = $request->sort;
      // $items = Person::orderBy($sort, 'asc')
      //     ->simplePagenate(5);
      //Postを新しい順にDBから取得する
      $posts = Post::latest()->get();
      //配列に入れる
      $param = ['user' => $user, 'posts' => $posts];

      // $posts = \App\Post::all();
      // $posts = Post::all();
      // $posts = Post::orderBy('created_at','desc')->get();
      // $posts = Post::latest()->get();
      // dd($posts->toArray());
      return view('posts.index', $param);
      // return view('posts.index')->with('posts', $posts);
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

    public function store(Request $request){
      $post = new Post();
      $post->title = $request->title;
      $post->body = $request->body;
      $post->save();
      return redirect('/post');
    }
}
