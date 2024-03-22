<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ArchiveInfo extends Model
{
    protected $fillable = [
        'biro_id',
        'user_id',
        'archivable',
        'date',
        'is_archived',
    ];

    public static function boot()
    {
        parent::boot();

        // add user id & date
        static::creating(function(ArchiveInfo $item) {
            $item->biro_id = Auth::user()->biro_id;
            $item->user_id = Auth::user()->id;
            $item->date = date('Y-m-d');
        });
    }

    public function archivable()
    {
        return $this->morphTo();
    }

    public function scopeInbox($query)
    {
        return $query->where('archivable_type', 'App\Inbox');
    }

    public function scopeOutbox($query)
    {
        return $query->where('archivable_type', 'App\Outbox');
    }

    public function scopeFilterBiro($query)
    {
        return $query->where('biro_id', auth()->user()->biro_id);
    }

    public function biro()
    {
        return $this->belongsTo(Biro::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getDateFormattedAttribute()
    {
        return to_mysql_date($this->date, ' ', true);
    }

    public function getDateIndoAttribute()
    {
        $date = Carbon::parse($this->date);
        return to_indo_day($date->copy()->format('N')) .', '. to_indo_date($this->date, 1);
    }
}
