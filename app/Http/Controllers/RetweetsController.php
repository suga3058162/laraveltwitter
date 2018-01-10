<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Like;
use App\User;
use App\Retweet;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;

class RetweetsController extends Controller
{
    protected $request;

    public function __construct(Request $request) {
        $this->RetweetModel = \App::make('\App\Retweet');
    }

    public function store(Request $request) {
        $post_id = Input::get('post_id');
        $user = \Auth::user();
        $this->RetweetModel->create(['user_id' => $user->id,'post_id' => $post_id]);
        return redirect('/post');
    }
}