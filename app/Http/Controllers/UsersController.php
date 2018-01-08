<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Post;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\PostRequest;

class UsersController extends Controller
{
    public function index(){

    }

    public function show($id){
        //アクセスしているユーザー情報の取得
        $user = User::where('id', $id)->first();

        $posts = $user->posts;

        //ログインしているユーザーidの取得
        $loginUser = Auth::user()->id;
        // dd($loginUser);        

        $param = ['user' => $user,'posts' => $posts,'loginUser' => $loginUser];
        return view('users.show', $param);
    }

    public function edit(User $user){
        return view('users.edit')->with('user', $user);
      }
}
