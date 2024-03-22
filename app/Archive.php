<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Inbox;
use App\Outbox;
use Auth;

class Archive extends Model
{
    protected $fillable = [
        'biro_id',
        'user_id',
        'archivable',
        'clasification_id',
        'year',
        'date',
        'tk_prk',
        'qty',
        'no_box',
        'no_folder',
        'condition',
        'note',
        'is_attachment',
        'status',
    ];

    public static function boot()
    {
        parent::boot();

        // add user id
        static::creating(function (Archive $item) {
            $item->user_id = Auth::user()->id;
            $item->created_at = date('Y-m-d H:i:s');
        });
    }

    public function biro()
    {
        return $this->belongsTo(Biro::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function clasification()
    {
        return $this->belongsTo(Clasification::class);
    }

    public function archivable()
    {
        return $this->morphTo();
    }

    public function bundle()
    {
        return $this->hasOne(ArchiveBundleDetail::class, 'archive_id');
    }

    public function attachment()
    {
        return $this->morphOne(Attachment::class, 'attachable');
    }

    public function getDateFormattedAttribute()
    {
        return to_mysql_date($this->date);
    }

    public function getDateIndoAttribute()
    {
        $date = Carbon::parse($this->date);
        return to_indo_day($date->copy()->format('N')) .', '. to_indo_date($date->format('Y-m-d'), 1);
    }

    public function getDateIndoShortAttribute()
    {
        $date = Carbon::parse($this->date);
        return to_indo_date($date->format('Y-m-d'), 2);
    }

    public function getDateIndoMiniAttribute()
    {
        $date = Carbon::parse($this->date);
        return to_indo_date($date->format('Y-m-d'), 0, '-');
    }

    public function getTkPrkFormattedAttribute()
    {
        return $this->tk_prk == 1 ? 'Copy' : 'Asli';
    }

    public function getConditionFormattedAttribute()
    {
        return $this->condition == 1 ? 'Baik' : 'Tidak';
    }

    public function getNoSuratAttribute()
    {
        if ($this->archivable_type == 'App\Inbox') {
            $model = Inbox::find($this->archivable_id);
        } else if ($this->archivable_type == 'App\Outbox') {
            $model = Outbox::find($this->archivable_id);
        }

        return $model->no;
    }

    public function scopeFilterBiro($query)
    {
        return $query->where('biro_id', auth()->user()->biro_id);
    }

    public function scopeFilterType($query, $type)
    {
        $type_text = "App\\". ($type == 'masuk' ? 'Inbox' : 'Outbox');

        return $query->where('archivable_type', $type_text);
    }

    public function scopeFilter($query, $request)
    {
        if ($request->has('date_start') && $request->date_start !== null) {
            $date_end = $request->date_end ?? date('Y-m-d');
            $query->whereDate('date', '>=' , $request->date_start)
                ->whereDate('date', '<=', $date_end);
        }

        // if ($request->has('no') && $request->no !== null) {
        //     $query->whereHas('archivable', function ($q) use ($request) {
        //         $q->where('no', 'like', '%' . $request->no . '%');
        //     });
        // }

        // if ($request->has('description') && $request->description !== null) {
        //     $query->whereHas('archivable', function ($q) use ($request) {
        //         $q->where('title', 'like', '%' . $request->description . '%');
        //     });
        // }

        if ($request->has('clasification_id') && $request->clasification_id !== null) {
            $query->where('clasification_id', $request->clasification_id);
        }

        if ($request->has('year') && $request->year !== null) {
            $query->where('year', $request->year);
        }

        if ($request->has('tk_prk') && $request->tk_prk !== null) {
            $query->where('tk_prk', $request->tk_prk);
        }

        if ($request->has('no_box') && $request->no_box !== null) {
            $query->where('no_box', $request->no_box);
        }

        if ($request->has('no_folder') && $request->no_folder !== null) {
            $query->where('no_folder', $request->no_folder);
        }

        if ($request->has('condition') && $request->condition !== null) {
            $query->where('condition', $request->condition);
        }

        if ($request->has('status') && $request->status !== null) {
            $query->where('status', $request->status);
        }

        return $query;
    }

    public function removeRelatedData()
    {
        if ($this->bundle !== null && $this->bundle->count() > 0) {
            if ($this->bundle->bundle()->count() > 0) {
                $this->bundle->bundle()->decrement('total');
            }

            $this->bundle()->delete();

            if ($this->bundle->bundle->total == 0) {
                $this->bundle->bundle()->delete();
            }
        }

        $this->attachment()->delete();
        $this->archivable()->update(['is_archived' => null]);
    }
}
