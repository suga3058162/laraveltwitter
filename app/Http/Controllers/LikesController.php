<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Like;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Facades\Input;

class LikesController extends Controller
{
    // protected $request;

    // public function __construct(Request $request) {
    //   $this->request = $request;
    //   $this->LikeModel = \App::make('\App\Like');
    // }

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
      return "post_id : {$post_id}";

    }
}
