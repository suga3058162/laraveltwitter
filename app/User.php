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

    public function isFollowd(){
        // $follow = Follow::where('from_user_id', $this->id)->where('to_user_id', Auth::user()->id)->first();
        // $follow = Follow::where('from_user_id', $this->id)->first();
        
        // 画面のユーザーid
        // dd($this->id);

        // ログインユーザーid
        // dd(Auth::user()->id);

        // ログインユーザーがフォローしているユーザーid（没）
        // $follow = Follow::where('from_user_id', $this->id)->where('to_user_id', Auth::user()->id)->get();
        // $follow = Follow::where('to_user_id', Auth::user()->id)->get();
        // dd($follow['from_user_id']);
    
        // $follow = Follow::where('from_user_id', Auth::user()->id)->get();

        // ログインユーザーがフォローしているユーザーid（ok）
        // $follow = Follow::where('from_user_id', Auth::user()->id)->pluck('to_user_id');
        // dd($follow); 
        //user_id 1 の場合、arrayで[1,2,3,3,3,3]が入っている

        // ログインユーザーがフォローしているユーザーidに、画面のユーザーidが含まれていたらtrue、含まれていなかったらfalse
        // return boolval($follow === $this->id);

        // 自分自身をフォローしているか判定
        // $serch = 1;
        // $key = in_array($serch,$follow);

        // logger(isset($follow));
        // return isset($follow);

        // $follow = Follow::where('from_user_id', $this->id)->where('to_user_id', Auth::user()->id)->first();

        $follow = Follow::where('to_user_id', $this->id)->where('from_user_id', Auth::user()->id)->first();

        logger(isset($follow));
        return isset($follow);
        // dd(isset($follow));
        // $split = array_splice($follow, 1); //特定のidを削除（失敗）
        // dd($split);
        // dd(isset($split));
    }
}
