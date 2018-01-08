<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
use App\Like;

class Post extends Model
{
    //

    protected $fillable = ['user_id','title', 'body'];

    public function comments() {
      return $this->hasMany('App\Comment');
    }

    //いいね機能追加
    // public function comments() {
    //   return $this->hasMany('App\Comment');
    // }

    public function user()
    {
      return $this->belongsTo(User::class);
    }

    public function likes()
    {
      return $this->hasMany('App\Like');
    }

    public function like_by()
    {
      return Like::where('user_id', Auth::user()->id)->first();
    }

    public function isLiked(){
      $like = Like::where('post_id', $this->id)->where('user_id', Auth::user()->id)->first();
      logger(isset($like));
      return isset($like);
  }
}
