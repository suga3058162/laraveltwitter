<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Post;
use App\Follow;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{

    public function index(){
        //user_idを全件取得
        $users = User::get();
        return view('users.index', ['users' => $users]);
    }

    public function show($id){
        //アクセスしているユーザー情報の取得
        $user = User::where('id', $id)->first();

        $posts = $user->posts;

        //ログインしているユーザーidの取得
        $loginUser = Auth::user()->id;      

        $param = ['user' => $user,'posts' => $posts,'loginUser' => $loginUser];
        return view('users.show', $param);
    }

    public function edit(){
        $user = Auth::user();
        return view('users.edit')->with('user', $user);
    }

    public function update(Request $request){
        $user = Auth::user();
        $user->name = $request->user['name'];
        $user->email = $request->user['email'];
        $user->save();
        return redirect('/user/'.$user->id);
    }

    public function destroy($id) {
        $follow = Follow::where('to_user_id',$id)->where('from_user_id',Auth::user()->id)->first();
        $follow->delete();
        return redirect("/user/{$id}");
    }

}
