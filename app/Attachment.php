<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'name',
        'ext',
        'size',
        'order',
        'attachable',
    ];

    protected $hidden = [
        'attachable_id',
        'attachable_type',
        'created_at',
        'updated_at',
    ];
}
