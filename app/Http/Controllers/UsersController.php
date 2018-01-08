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
        $user = User::where('id', $id)->first();

        $posts = $user->posts;

        $param = ['user' => $user,'posts' => $posts];
        return view('users.show', $param);
    }

    public function edit(User $user){
        return view('users.edit')->with('user', $user);
      }
}
