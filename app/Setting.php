<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'title',
        'name',
        'value'
    ];

    public static function getValue($name)
    {
        $setting = parent::where('name', $name)->first();
        return $setting->value;
    }
}
