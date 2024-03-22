<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pejabat extends Model
{
    protected $fillable = [
        'name',
        'title',
        'position',
        'type',
        'is_active',
        'is_ttd_area',
        'user_id',
    ];

    public function getIsTtdAreaReverseAttribute()
    {
        return $this->is_ttd_area == 1 ? false : true;
    }
}
