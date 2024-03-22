<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    protected $guarded = [];

    public function receiver()
    {
        return $this->belongsTo(Receiver::class);
    }

    public function disposition_admin()
    {
        return $this->hasMany(DispositionAdmin::class, 'unique_key', 'unique_key');
    }

    public function attachment()
    {
        return $this->morphOne(Attachment::class, 'attachable');
    }

    public function getDateAttribute()
    {
        return to_indo_date($this->created_at->format('Y-m-d'), 3, '-');
    }

    public function getPropertyFormattedAttribute()
    {
        if ($this->property == 1) return 'Segera';
        else if ($this->property == 2) return 'Rahasia';
        else if ($this->property == 3) return 'Sangat Rahasia';
    }

    public function getStatusFormattedAttribute()
    {
        if ($this->status == 'B') return 'Proses Validasi';
        else if ($this->status == 'P') return 'Sedang dalam proses di ';
        else if ($this->status == 'S') return 'Sudah berada di ';
    }
}
