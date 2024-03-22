<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Biro extends Model
{
    protected $fillable = [
        'name',
        'slug'
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function userOperatorWa()
    {
        foreach ($this->users()->get() as $user) {
            if ($user->isOperator()) {
                return $user->wa;
            }
        }

        return null;
    }
}
