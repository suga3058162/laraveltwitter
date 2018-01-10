<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;
use App\Follow;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    // Postを取得
    public function posts() {
        // 1対多のリレーション　postsテーブル(1)
        return $this->hasMany('App\Post', 'user_id');
        // return $this->hasMany('App\Post');
        // return $this->hasMany(Post::class);
    }
    // followしているユーザーidを取得
    public function follows() {
        return $this->hasMany('App\Follow', 'from_user_id');
    }

    // likesテーブルのリレーション
    public function likes() {
      return $this->hasMany(Like::class);
    }

    public function isLogin(){
        return boolval($this->id === Auth::user()->id);
    }

    public function isFollowd(){
        $follow = Follow::where('to_user_id', $this->id)->where('from_user_id', Auth::user()->id)->first();
        logger(isset($follow));
        return isset($follow);
    }
}
