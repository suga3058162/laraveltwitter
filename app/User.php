<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;

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

    /**
     * Postを取得
     */
    public function posts(){
        return $this->hasMany('App\Post', 'user_id');
    }
    /**
     * followしているユーザーidを取得
     */
    public function follows(){
        return $this->hasMany('App\Follow', 'from_user_id');
      }

    //いいね機能追加
    public function likes()
    {
      return $this->hasMany(Like::class);
    }

    public function isLogin(){
        return boolval($this->id === Auth::user()->id);
    }
}
