<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Place extends Model
{
    use SoftDeletes;

    // 子テーブル
    public function answers()
    {
        return $this->hasMany('App\Answer');
    }
}
