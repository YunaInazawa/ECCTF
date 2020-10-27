<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Model
{
    use SoftDeletes;

    // 子テーブル
    public function answers()
    {
        return $this->hasMany('App\Answer');
    }
    public function user_gifts()
    {
        return $this->hasMany('App\UserGift');
    }

    // 親テーブル
    public function course()
    {
        return $this->belongsTo('App\Course');
    }
}
