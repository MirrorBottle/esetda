<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Auth;

class Agenda extends Model
{
    protected $fillable = [
        'date',
        'time_start',
        'time_end',
        'event',
        'inbox_id',
        'user_id',
        'place_id',
        'apparel_id',
        'disposition_id',
        'receiver_id',
        'status',
        'description',
        'is_attachment',
        'shortlink',
    ];

    public static function boot()
    {
        parent::boot();

        // add user id
        static::creating(function (Agenda $item) {
            $item->user_id = Auth::user()->id ?? rand(34, 35);
            $item->created_at = date('Y-m-d H:i:s');
        });
    }

    public function inbox()
    {
        return $this->belongsTo(Inbox::class);
    }

    public function partners()
    {
        return $this->belongsToMany(AgendaPartner::class, 'agenda_partner_details', 'agenda_id', 'partner_id');
    }

    public function place()
    {
        return $this->belongsTo(AgendaPlace::class);
    }

    public function apparel()
    {
        return $this->belongsTo(AgendaApparel::class);
    }

    public function disposition()
    {
        return $this->belongsTo(AgendaDisposition::class);
    }

    public function receiver()
    {
        return $this->belongsTo(AgendaReceiver::class);
    }

    public function attachment()
    {
        return $this->morphOne(Attachment::class, 'attachable');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getStatusFormattedAttribute()
    {
        return $this->status == 0 ? 'Rahasia' : 'Terbuka';
    }

    public function getDateFormattedAttribute()
    {
        $day = to_indo_day(Carbon::parse($this->date)->format('N'));

        return $day .', '. to_indo_date($this->date, 1);
    }

    public function getDateIndoAttribute()
    {
        $date = Carbon::parse($this->date);
        return to_indo_day($date->copy()->format('N')) .', '. to_indo_date($this->date, 1);
    }

    public function getTimeStartAttribute($value)
    {
        return substr($value, 0, 5);
    }

    public function getTimeEndAttribute($value)
    {
        return substr($value, 0, 5);
    }

    public function getAllPartnerAttribute()
    {
        $partners = array();
        foreach ($this->partners as $partner) {
            $partners[] = $partner->id;
        };

        return $partners;
    }

    public function getPartnerListAttribute()
    {
        $partners = '';
        $no = 0;
        foreach ($this->partners as $partner) {
            if ($no !== 0) { $partners .= ', '; }
            $partners .= $partner->position;
            $no++;
        }

        return $partners;
    }

    public function scopeFilter($query, $request)
    {
        if ($request->has('date_start') && $request->date_start !== null) {
            $date_end = $request->date_end ?? date('Y-m-d');
            $query->whereDate('date', '>=' , $request->date_start)
                ->whereDate('date', '<=', $date_end);
        }

        if ($request->has('event') && $request->event !== null) {
            $query->where('event', 'like', '%' . $request->event . '%');
        }

        if ($request->has('place_id') && $request->place_id !== null) {
            $query->where('place_id', $request->place_id);
        }

        if ($request->has('receiver_id') && $request->receiver_id !== null) {
            $query->whereIn('receiver_id', $request->receiver_id);
        }

        if ($request->has('status') && $request->status !== null) {
            $query->where('status', $request->status);
        }

        return $query;
    }
}
