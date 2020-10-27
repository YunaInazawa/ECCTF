<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Choice extends Model
{
    use SoftDeletes;

    // 親テーブル
    public function question()
    {
        return $this->belongsTo('App\Question');
    }
}
