<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Skpd extends Model
{
    protected $fillable = [
        'name',
        'budget_expanse',
        'wa_number',
        'contact',
    ];

    public function employees()
    {
        return $this->hasMany(SkpdEmployee::class);
    }

    public function hasRelatedData()
    {
        return $this->employees()->count() > 0;
    }
}
