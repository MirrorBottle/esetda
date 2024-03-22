<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Forward extends Model
{
    protected $fillable = [
        'biro_id',
        'user_id',
        'inbox_id',
        'outbox_id',
        'note',
        'is_received'
    ];

    public static function boot()
    {
        parent::boot();

        // add user id
        static::creating(function (Forward $item) {
            $item->user_id = auth()->user()->id;
            $item->created_at = date('Y-m-d');
        });
    }

    public function inbox()
    {
        return $this->belongsTo(Inbox::class);
    }

    public function outbox()
    {
        return $this->belongsTo(Outbox::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function biro()
    {
        return $this->belongsTo(Biro::class);
    }

    public function getTypeAttribute()
    {
        return $this->inbox_id == null ? 'outbox' : 'inbox';
    }

    public function getTypeIndoAttribute()
    {
        return $this->inbox_id == null ? 'keluar' : 'masuk';
    }

    public function getNoteDescriptionAttribute()
    {
        if ($this->inbox_id == null) {
            return $this->outbox->description ?? '';
        } else {
            return $this->inbox->description ?? '';
        }
    }

    public function getAttachmentsAttribute()
    {
        $model = $this->inbox_id == null ? $this->outbox() : $this->inbox();
        $model = $model->with('attachments')->first();
        return $model->attachments;
    }

    public function getIsAttachmentAttribute()
    {
        $model = $this->inbox_id == null ? $this->outbox() : $this->inbox();
        $model = $model->with('attachments')->first();
        return $model->attachments()->count() > 0;
    }

    public function scopeFilterBiro($query)
    {
        return $query->where('biro_id', auth()->user()->biro_id);
    }

    public function scopeFilter($query, $request)
    {
        $type = $request->type; // inbox / outbox

        if ($request->has('date_start') && $request->date_start !== null) {
            $query->whereHas($type, function ($q) use ($request) {
                $date_end = $request->date_end ?? date('Y-m-d');
                $q->whereDate('date_entry', '>=' , $request->date_start)
                    ->whereDate('date_entry', '<=', $date_end);
            });
        }

        if ($request->has('biro_id') && $request->biro_id !== null) {
            $query->where('biro_id', $request->biro_id);
        }

        if ($request->has('no') && $request->no !== null) {
            $query->whereHas($type, function ($q) use ($request) {
                $q->where('no', $request->no);
            });
        }

        if ($request->has('title') && $request->title !== null) {
            $query->whereHas($type, function ($q) use ($request) {
                $q->where('title', 'like', '%' . $request->title . '%');
            });
        }

        if ($request->has('receiver_id') && $request->receiver_id !== null) {
            $query->whereHas($type, function ($q) use ($request) {
                $q->where('receiver_id', $request->receiver_id);
            });
        }

        return $query;
    }
}
