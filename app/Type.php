<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Type extends Model
{
    use SoftDeletes;

    // 子テーブル
    public function types()
    {
        return $this->hasMany('App\Type');
    }
}
