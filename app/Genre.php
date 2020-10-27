<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Genre extends Model
{
    use SoftDeletes;

    // 子テーブル
    public function genres()
    {
        return $this->hasMany('App\Genre');
    }
}
