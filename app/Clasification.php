<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Archive;

class Clasification extends Model
{
    protected $fillable = [
        'code',
        'code_clasification',
        'name',
        'description',
    ];

    public function archives()
    {
        return $this->hasMany(Archive::class, 'clasification_id', 'id');
    }

    public function hasRelation()
    {
        return $this->archives()->count() > 0;
    }

    public function getCodeFormattedAttribute()
    {
        if ($this->code_clasification == null) { return $this->code; }
        return $this->code .'.'. $this->code_clasification;
    }
}
