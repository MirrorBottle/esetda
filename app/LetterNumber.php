<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class LetterNumber extends Model
{
    protected $fillable = [
        'month_year',
        'start',
        'end',
    ];

    public function useds()
    {
        return $this->hasMany(LetterNumberUsed::class, 'letter_number_id', 'id');
    }

    public function getMonthAttribute()
    {
        $date = Carbon::parse($this->month_year);
        return to_indo_month($date->copy()->format('m'));
    }

    public function getMonthNumberAttribute()
    {
        $date = Carbon::parse($this->month_year);
        return $date->copy()->format('m');
    }

    public function getYearAttribute()
    {
        $date = Carbon::parse($this->month_year);
        return $date->copy()->format('Y');
    }

    public function removeRelatedData()
    {
        foreach ($this->useds()->withTrashed()->get() as $used) {
            $used->forceDelete();
        }
    }
}
