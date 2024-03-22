<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LetterNumberUsedBundle extends Model
{
    protected $fillable = [
        'link',
        'list_id',
    ];
}
