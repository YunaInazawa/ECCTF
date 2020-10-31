<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserGift extends Model
{
    use SoftDeletes;

    // 親テーブル
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function gift()
    {
        return $this->belongsTo('App\Gift');
    }

}
