<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Gift extends Model
{
    use SoftDeletes;

    // 子テーブル
    public function gifts()
    {
        return $this->hasMany('App\Gift');
    }
}
