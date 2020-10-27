<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Gift extends Model
{
    use SoftDeletes;

    // users - user_gifts - gift
    public function users(){
        return $this->belongsToMany('App\User', 'user_gifts')
            ->withTimestamps();
    }
}
