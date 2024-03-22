<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SkpdEmployee extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'skpd_id',
        'name',
        'position',
        'group',
        'nip',
    ];

    public function skpd()
    {
        return $this->belongsTo(Skpd::class);
    }

    public function spt()
    {
        return Spt::whereIn('skpd_employee', [$this->id])->get();
    }

    public function hasRelatedData()
    {
        return $this->spt()->count() > 0;
    }
}
