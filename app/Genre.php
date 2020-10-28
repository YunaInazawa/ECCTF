<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Genre extends Model
{
    use SoftDeletes;

    // 子テーブル
    public function questions()
    {
        return $this->hasMany('App\Question');
    }
    public function places()
    {
        return $this->hasMany('App\Place');
    }
}
