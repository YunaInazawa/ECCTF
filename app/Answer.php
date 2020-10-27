<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Answer extends Model
{
    use SoftDeletes;

    // 親テーブル
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function place()
    {
        return $this->belongsTo('App\Place');
    }
    public function question()
    {
        return $this->belongsTo('App\Question');
    }
}
