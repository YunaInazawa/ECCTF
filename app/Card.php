<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Card extends Model
{
    use SoftDeletes;

    // 子テーブル
    public function places()
    {
        return $this->hasMany('App\Place');
    }
    public function courses()
    {
        return $this->hasMany('App\Course');
    }
}
