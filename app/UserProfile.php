<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class UserProfile extends Model
{
    protected $fillable = [
        'user_id',
        'gender',
        'age',
        'education',
        'contact',
    ];

    public static function boot()
    {
        parent::boot();

        // add user id
        static::creating(function (UserProfile $item) {
            $item->user_id = Auth::user()->id;
        });
    }
}
