<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Gift extends Model
{
    use SoftDeletes;

    // 子テーブル
    public function user_gifts()
    {
        return $this->hasMany('App\UserGift');
    }

    // users - user_gifts - gift
    public function users(){
        return $this->belongsToMany('App\User', 'user_gifts')
            ->withTimestamps()
            ->withPivot(['quantity']);
    }
    
}
