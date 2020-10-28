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
    // 親テーブル
    public function card()
    {
        return $this->belongsTo('App\Card');
    }
    public function genre()
    {
        return $this->belongsTo('App\Genre');
    }
    public function level()
    {
        return $this->belongsTo('App\Level');
    }
}
