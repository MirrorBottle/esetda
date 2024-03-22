<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SptTemplate extends Model
{
    protected $fillable = [
        'name',
        'content'
    ];
}
