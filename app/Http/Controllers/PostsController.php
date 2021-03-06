<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\User;
use App\Retweet;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\PostRequest;

class PostsController extends Controller
{
    public function index(){
      // ログインユーザー情報を取得
      $user = Auth::user();

      // to_user_idはログインユーザーがフォローしたユーザーid
      // followsテーブルからログインユーザーがフォローしているユーザーのレコードを取得
      $userIds = $user->follows->pluck('to_user_id');

      // $userIdsは、followsテーブルからログインユーザーがフォローしているユーザーのレコード
      // 配列にし、idのみ抽出
      $userIds[] = $user->id;

      // retweetテーブルから、$userIdsとuser_idが一致するレコードを取得
      // retweetsテーブルから、post_idが一致するレコードを取得、post_idのみ抽出
      $postIds = Retweet::whereIn('user_id', $userIds)->pluck('post_id');

      // postsテーブルから、$userIdsとuser_idが一致するレコードを取得
      // また、フォローしたユーザーが作成したツイートをOR結合で取得
      $posts = Post::whereIn('user_id', $userIds)->orWhereIn('id', $postIds)->get();

      // ログインユーザー情報と、ツイート情報をviewへ渡す
      $param = ['user' => $user, 'posts' => $posts];

      return view('posts.index', $param);
    }

    public function show(Post $post){
      // ルーティングから$postを受け取る
      // /posts/showへ遷移
      // ツイート詳細画面へ、ツイート情報を渡す
      return view('posts.show', ['post' => $post]);
    }

    public function create(){
      // /posts/createへ遷移
      return view('posts.create');
    }

    public function store(PostRequest $request){
      // ログインユーザー情報を取得
      $user = \Auth::user();

      // 新しいデータを挿入
      $post = new Post();
      // postsテーブルのtitleカラムに、POSTデータのtitleの内容を挿入
      $post->title = $request->title;
      // postsテーブルのbodyカラムに、POSTデータのbodyの内容を挿入
      $post->body = $request->body;
      // postsテーブルのuser_idカラムに、POSTしたログインユーザーidを挿入
      $post->user_id = $user->id;
      // $postに入れたデータをpostsテーブルへ保存
      $post->save();
      // /postへ遷移
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
