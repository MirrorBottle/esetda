<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PetugasTtd extends Model
{
    protected $fillable = [
        'type',
        'name',
        'title',
        'sub_title',
        'nip',
    ];
}
