<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LetterNumberUsed extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'letter_number_id',
        'number',
        'sender',
        'order',
        'attachment',
        'note',
    ];

    public function letter_number()
    {
        return $this->belongsTo(LetterNumber::class);
    }

    public function getDateAttribute()
    {
        $date = Carbon::parse($this->created_at);
        return to_indo_date($date->copy()->format('Y-m-d'), 1);
    }
}
