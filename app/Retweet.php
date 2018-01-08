<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Retweet extends Model
{
    protected $fillable = [
        'user_id',
        'post_id'
    ];

}
