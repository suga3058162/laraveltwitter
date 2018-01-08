<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\PostRequest;

class UsersController extends Controller
{
    public function index(){

    }

    public function show($id){
        $user = User::where('id', $id)->first();
        return view('users.show', ['user' => $user]);
    }

    public function edit(User $user){
        return view('users.edit')->with('user', $user);
      }
}
