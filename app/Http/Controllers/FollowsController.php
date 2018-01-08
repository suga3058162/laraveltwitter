<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Follow;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Facades\Input;

class FollowsController extends Controller
{
    protected $request;

    public function __construct(Request $request) {
        $this->FollowModel = \App::make('\App\Follow');
    }

    public function store(Request $request) {
        $from_user_id = Input::get('from_user_id');

        $user = \Auth::user();

        $this->FollowModel->create(['from_user_id' => $from_user_id,'to_user_id' => $user->id]);
        return redirect('/post');
    }
}
