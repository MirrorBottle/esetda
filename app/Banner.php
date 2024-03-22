<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $fillable = [
        'file_name',
        'caption',
        'is_active'
    ];
}
