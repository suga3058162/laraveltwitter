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
    //   $this->request = $request;
      $this->LikeModel = \App::make('\App\Like');
    }

    public function index($id){
      // $user = Auth::user();
      // //特定のuser_idを取得
      // $userId = Auth::user()->id;
      //userを検索
      $user = User::where('id', $id)->first();
      //特定のuser_idに紐づくlikesテーブルに入っているpost_idを取得する
      $postIds = Like::where('user_id', $user->id)->latest()->get();
      //postを取得
      $posts = Post::whereIn('id', $postIds)->get();
      //配列に入れる
      $param = ['user' => $user,'posts' => $posts];
      return view('likes.index', $param);
    }

    public function store(Request $request) {
      //
      // $this->validate($request,[
      //   'id' => 'required'
      // ]);
      // $like = new Like(['id' => $request->id]);
      // $post->likes()->save($like);
      // return redirect()->action('PostsController@show', $post);

      // $postData = $this->request->all();
      // dd($postData);

      //mayer-consumer UsersController 266行目 profileDetailEditPostファンクションを参考
      // dd($post);
      //
      // $Like = $this->LikeModel->firstOrcreate(['post_id' => $post->id]);
      // $Like->fill($postData['Like']);
      // $Like->save();

      //PostsController 44行　storeファンクション参考
      // dd($request);
      // $post = new Post();

      //mayer-consumer UsersController profileDetailEditPost参考
      // $like = $this->LikeModel->where('post', $post->id)->get();
      // dd($like);

      $post_id = Input::get('post_id');

      $user = \Auth::user();


      // $post_id->save();
      $this->LikeModel->create(['post_id' => $post_id,'user_id' => $user->id]);
      return redirect('/post');

    }

    public function destroy($id) {
      // dd(Follow::where('to_user_id', $id)->get());
      // $follow = Follow::where('to_user_id',$id)->where('from_user_id',Auth::user()->id)->first();
      // dd(Like::where('post_id',$id)->where('user_id',Auth::user()->id)->first());
      $like = Like::where('post_id',$id)->where('user_id',Auth::user()->id)->first();
      // $follow = Follow::where('from_user_id',$id)->where('to_user_id',Auth::user()->id)->first();
      // dd(Auth::user()->id);
      // $follow->delete();
      $like->delete();
      // return redirect("/user/{{$id}}");
      return redirect("/post");
    }
}
