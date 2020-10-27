<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'student_num', 'password', 'is_admin', 'course_id', 'point',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    // 子テーブル
    public function answers()
    {
        return $this->hasMany('App\Answer');
    }

    // 親テーブル
    public function course()
    {
        return $this->belongsTo('App\Course');
    }

    // users - user_gifts - gift
    public function gifts(){
        return $this->belongsToMany('App\Gift', 'user_gifts')
            ->withTimestamps();
    }
}
