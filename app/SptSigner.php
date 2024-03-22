<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SptSigner extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'label',
        'title',
        'name',
        'position',
        'nip',
    ];

    public function spt()
    {
        return $this->hasMany(Spt::class);
    }

    public function hasRelatedData()
    {
        return $this->spt()->count() > 0;
    }
}
