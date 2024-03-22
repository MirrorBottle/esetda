<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Disposition extends Model
{
    protected $fillable = [
        'user_id',
        'inbox_id',
        'no_agenda',
        'counter',
        'kop',
        'ttd',
        'property',
        'sender',
        'date_time_receipt',
        'description',
        'is_ttd'
    ];

    public static function boot()
    {
        parent::boot();

        // add user id
        static::creating(function (Disposition $item) {
            $item->user_id = auth()->user()->id;
            if (request()->date_receipt !== null) {
                $item->date_time_receipt = request()->date_receipt.' '.request()->time_receipt;
            }
            $item->is_ttd = request()->is_ttd ?? 1;
            $no_agenda = explode("/", $item->no_agenda);
            $item->counter = (int) $no_agenda[0];
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function inbox()
    {
        return $this->belongsTo(Inbox::class);
    }

    public function getDateOnlyAttribute()
    {
        $date = Carbon::parse($this->date_time_receipt);
        return $date->format('Y-m-d');
    }

    public function getDateReceiptIndoAttribute()
    {
        if ($this->date_time_receipt !== null) {
            $date = Carbon::parse($this->date_time_receipt);
            return to_indo_day($date->copy()->format('N')) .', '. to_indo_date($date->format('Y-m-d'), 1);
        }

        return null;
    }

    public function getTimeReceiptAttribute()
    {
        if ($this->date_time_receipt !== null) {
            $date = Carbon::parse($this->date_time_receipt);
            return $date->format('H:i');
        }

        return null;
    }

    public function getPropertyFormattedAttribute()
    {
        if ($this->property == 1) return 'Segera';
        else if ($this->property == 2) return 'Rahasia';
        else if ($this->property == 3) return 'Sangat Rahasia';
    }

    public function getIsTtdReverseAttribute()
    {
        return $this->is_ttd == 1 ? false : true;
    }

    public function scopeFilterBiro($query)
    {
        return $query->whereHas('inbox', function ($q) {
            $q->where('biro_id', auth()->user()->biro_id);
        });
    }
}
