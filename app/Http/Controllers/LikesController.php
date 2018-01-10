<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Like;
use App\User;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;

class LikesController extends Controller
{
    protected $request;

    public function __construct(Request $request) {
      // Likeモデルを取得
      $this->LikeModel = \App::make('\App\Like');
    }

    public function index($id){
      // ユーザーidを取得
      $user = User::where('id', $id)->first();
      // 特定のuser_idに紐づくlikesテーブルに入っているpost_idを取得する
      $postIds = Like::where('user_id', $user->id)->latest()->get();
      // ポストidを取得
      $posts = Post::whereIn('id', $postIds)->get();
      // ユーザーidとポストidを配列に入れる
      $param = ['user' => $user,'posts' => $posts];
      return view('likes.index', $param);
    }

    public function store(Request $request) {
      //likeボタンを押下したツイートidを取得
      $post_id = Input::get('post_id');
      //ログインユーザーidを取得
      $user = \Auth::user();
      //ツイートidとユーザーidをlikeテーブルへ保存
      $this->LikeModel->create(['post_id' => $post_id,'user_id' => $user->id]);
      return redirect('/post');
    }

    public function destroy($id) {
      // viewでいいね解除したツイートidと、likesテーブルのpost_idが一致するレコードを取得
      // ログインユーザーidと、likesテーブルのuser_idが一致するレコードを取得
      $like = Like::where('post_id',$id)->where('user_id',Auth::user()->id)->first();
      // 一致したレコードを削除
      $like->delete();
      // /postヘリダイレクト
      return redirect("/post");
    }
}
