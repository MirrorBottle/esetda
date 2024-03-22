<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ArchiveBundle extends Model
{
    protected $fillable = [
        'sender_id',
        'biro_id',
        'type',
        'status',
        'total',
    ];

    public static function boot()
    {
        parent::boot();

        // add user and biro id
        static::creating(function (ArchiveBundle $item) {
            $item->sender_id  = Auth::user()->id;
            $item->biro_id    = Auth::user()->biro_id;
            $item->created_at = date('Y-m-d H:i:s');
        });
    }

    public function details()
    {
        return $this->hasMany(ArchiveBundleDetail::class, 'bundle_id', 'id');
    }

    public function biro()
    {
        return $this->belongsTo(Biro::class);
    }

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function getDateTimeIndoAttribute()
    {
        $date = Carbon::parse($this->created_at);
        return to_indo_date($date->copy()->format('Y-m-d'), 2, '-') .' '. $date->copy()->format('H:i');
    }
}
