<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
    use SoftDeletes;

    // 子テーブル
    public function users()
    {
        return $this->hasMany('App\User');
    }
}
