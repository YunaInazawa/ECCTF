<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Question extends Model
{
    use SoftDeletes;

    // 子テーブル
    public function choices()
    {
        return $this->hasMany('App\Choice');
    }
    public function answers()
    {
        return $this->hasMany('App\Answer');
    }
}
