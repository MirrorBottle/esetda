<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;
use Auth;

class Inbox extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'biro_id',
        'user_id',
        'no',
        'title',
        'date',
        'date_entry',
        'category_id',
        'receiver_id',
        'sender',
        'description',
        'instruction',
        'is_attachment',
        'is_forwarded',
        'is_agenda',
        'is_archived',
        'is_spt',
        'visitor_id',
        'is_disposition',
        'no_agenda',
        'property',
        'reference_id',
        'unique_key',
        'deleted_by',
    ];

    public static function boot()
    {
        parent::boot();

        // add user id
        static::creating(function (Inbox $item) {
            $item->biro_id = Auth::user()->biro_id;
            $item->user_id = Auth::user()->id;
            $item->date_entry = date('Y-m-d');
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

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function receiver()
    {
        return $this->belongsTo(Receiver::class);
    }

    public function forwards()
    {
        return $this->hasMany(Forward::class);
    }

    public function disposition()
    {
        return $this->hasOne(Disposition::class);
    }

    public function visitor()
    {
        return $this->belongsTo(Visitor::class);
    }

    public function agenda()
    {
        return $this->hasOne(Agenda::class);
    }

    public function attachments()
    {
        return $this->morphMany(Attachment::class, 'attachable');
    }

    public function archive()
    {
        return $this->morphOne(Archive::class, 'archivable');
    }

    public function receipt()
    {
        return $this->morphOne(Receipt::class, 'receiptable');
    }

    public function reference()
    {
        return $this->belongsTo(Inbox::class);
    }

    public function archive_info()
    {
        return $this->morphOne(ArchiveInfo::class, 'archivable');
    }

    public function destroyer()
    {
        return $this->belongsTo(User::class, 'deleted_by');
    }

    public function disposition_admin()
    {
        return $this->hasMany(DispositionAdmin::class, 'unique_key', 'unique_key');
    }

    public function spt()
    {
        return $this->hasOne(Spt::class);
    }    

    public function disposition_first($user_id)
    {
        if ($user_id === 5) { // tupim
            return $this->disposition_admin()->orderBy('id', 'desc')-> first();
        }

        return $this->disposition_admin()->where('user_id', $user_id)->first();
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

    public function getDateEntryFormattedAttribute()
    {
        return to_mysql_date($this->date_entry, ' ', true);
    }

    public function getDateEntryIndoAttribute()
    {
        $date = Carbon::parse($this->date_entry);
        return to_indo_day($date->copy()->format('N')) .', '. to_indo_date($this->date_entry, 1);
    }

    public function getDatePrintAttribute()
    {
        $date = Carbon::parse($this->date);
        return $date->format('d/m/Y');
    }

    public function getAttachmentsOrderAttribute()
    {
        $orders = [1 => null, 2 => null, 3 => null, 4 => null];
        foreach ($this->attachments as $attachment) {
            $orders[$attachment->order] = [
                'id' => $attachment->id,
                'name' => $attachment->name,
                'title' => $attachment->title,
                'is_pdf' => $attachment->ext == 'pdf',
            ];
        }

        return $orders;
    }

    public function scopeFilter($query, $request)
    {
        if ($request->has('date_start') && $request->date_start !== null) {
            $date_end = $request->date_end ?? date('Y-m-d');
            $query->whereDate('date_entry', '>=' , $request->date_start)
                ->whereDate('date_entry', '<=', $date_end);
        }

        if ($request->has('no') && $request->no !== null) {
            $query->where('no', 'like', '%' . $request->no . '%');
        }

        if ($request->has('title') && $request->title !== null) {
            $query->where('title', 'like', '%' . $request->title . '%');
        }

        if ($request->has('sender') && $request->sender !== null) {
            $query->where('sender', 'like', '%' . $request->sender . '%');
        }

        if ($request->has('biro_id') && $request->biro_id !== null) {
            $query->where('biro_id', $request->biro_id);
        }

        if ($request->has('category_id') && $request->category_id !== null) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->has('receiver_id') && $request->receiver_id !== null) {
            $query->where('receiver_id', $request->receiver_id);
        }

        if ($request->has('receiver_type') && $request->receiver_type !== null && $request->receiver_type !== '99') {
            $type = $request->receiver_type;
            $query->whereHas('receiver', function ($q) use ($type) {
                $q->where('type', $type);
            });
        }

        if ($request->has('is_forwarded') && $request->is_forwarded !== null) {
            $query->where('is_forwarded', 1);
        }

        if ($request->has('is_archived') && $request->is_archived !== null) {
            $query->where('is_archived', '!=', null);
        }

        return $query;
    }

    public function scopeFilterBiro($query)
    {
        return $query->where('biro_id', auth()->user()->biro_id);
    }

    public function removeRelatedData()
    {
        // remove all forwarded inbox
        $this->forwards()->delete();
        // remove attachments data
        $this->attachments()->delete();
        // remove disposition data
        $this->disposition()->delete();
        // remove archive data
        $this->archive_info()->delete();
        if ($this->archive()->count() > 0) {
            if ($this->archive->bundle->count() > 0) {
                if ($this->archive->bundle->bundle()->count() > 0) {
                    $this->archive->bundle->bundle()->decrement('total');
                }

                $this->archive->bundle()->delete();

                if ($this->archive->bundle->bundle->total == 0) {
                    $this->archive->bundle->bundle()->delete();
                }
            }

            $this->archive->attachment()->delete();
            $this->archive()->delete();
        }
        // remove agenda
        if ($this->agenda()->count() > 0) {
            $this->agenda->partners()->delete();
            $this->agenda->attachment()->delete();
            $this->agenda()->delete();
        }
    }
}
