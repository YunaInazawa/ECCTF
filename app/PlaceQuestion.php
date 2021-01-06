<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PlaceQuestion extends Model
{
    use SoftDeletes;

    // 親テーブル
    public function place()
    {
        return $this->belongsTo('App\Place');
    }
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
