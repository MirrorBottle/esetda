<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Receipt extends Model
{
    protected $fillable = [
        'receiptable',
        'attachment',
        'note',
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function (Receipt $item) {
            $item->user_id = Auth::user()->id;
            $item->created_at = date('Y-m-d H:i:s');
        });
    }

    public function receiptable()
    {
        return $this->morphTo();
    }

    public function scopeType($query, $type)
    {
        return $query->where('receiptable_type', 'App\\'. ucfirst($type));
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getDateIndoAttribute()
    {
        $date = Carbon::parse($this->created_at);
        return to_indo_date($date->format('Y-m-d'), 1);
    }
}
