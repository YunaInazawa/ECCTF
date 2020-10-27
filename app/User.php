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

    // 親テーブル
    public function course()
    {
        return $this->belongsTo('App\Course');
    }

    // users - user_gifts - gift
    public function gifts(){
        return $this->belongsToMany('App\Gift', 'user_gifts')
            ->withTimestamps();
    }
}
