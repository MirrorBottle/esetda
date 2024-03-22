<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Spt extends Model
{
    protected $fillable = [
        'inbox_id',
        'letter_number',
        'letter_signers',
        'letter_date',
        'skpd_id',
        'skpd_employee', // list skpd employee
        'purpose',
        'place',
        'destination',
        'duration',
        'departure_date',
        'return_date',
        'budget_expanse',
        'signer_id',
        'is_accepted',
        'status',
    ];

    protected $casts = [
        'skpd_employee' => 'json',
        'letter_signers' => 'json',
        'letter_date' => 'date',
        'departure_date' => 'date',
        'return_date' => 'date',
    ];

    public function inbox()
    {
        return $this->belongsTo(Inbox::class);
    }

    public function signer()
    {
        return $this->belongsTo(SptSigner::class);
    }

    public function skpd()
    {
        return $this->belongsTo(Skpd::class);
    }

    public function skpd_employees()
    {
        $skpd_employee = json_decode($this->skpd_employee, 1);
        return SkpdEmployee::whereIn('id', $skpd_employee['id'])->get();
    }

    public function getDateRangeAttribute()
    {
        return to_indo_date($this->departure_date->format('Y-m-d'), 1)
            . '<br> s/d ' . to_indo_date($this->return_date->format('Y-m-d'), 1);
    }

    public function getDestinationDateFormattedAttribute()
    {
        $date = Carbon::parse($this->destination_date);
        $day = to_indo_day($date->copy()->format('N'));
        $date_format = to_indo_date($date->copy()->format('Y-m-d'));

        return  $day . ', ' . $date_format;
    }

    public function getReturnDateFormattedAttribute()
    {
        $date = Carbon::parse($this->return_date);
        $day = to_indo_day($date->copy()->format('N'));
        $date_format = to_indo_date($date->copy()->format('Y-m-d'));

        return  $day . ', ' . $date_format;
    }

    public function getEmployeeListAttribute()
    {
        $skpd_employee = json_decode($this->skpd_employee, 1);
        return implode('<br>', $skpd_employee['name']);
    }

    public function getEmployeeListIdAttribute()
    {
        $skpd_employee = json_decode($this->skpd_employee, 1);
        return $skpd_employee['id'];
    }

    public function getLetterSignerListAttribute()
    {
        return json_decode($this->letter_signers, 1);
    }

    public function getLetterSignerFormattedAttribute()
    {
        $format = '';
        if ($this->letter_signers != null) {
            $letter_signers = json_decode($this->letter_signers, 1);
            foreach ($letter_signers['name'] as $key => $name) {
                if ($key !== 0) {
                    $format .= ", ";
                }
                $format .= $name . ' (' . $letter_signers['position'][$key] . ')';
            }
        }
        return $format;
    }

    public function getLetterNumberZeroPadAttribute()
    {
        return str_pad($this->letter_number, 4, '0', STR_PAD_LEFT);
    }

    public function getStatusFormattedAttribute()
    {
        $statuses = [
            'P' => 'Proses',
            'S' => 'Selesai',
            'B' => 'Batal',
        ];

        return $statuses[$this->status];
    }

    public function scopePeriode($query, $request)
    {
        $start = $request->date_start . ' 00:00:00';
        $end = $request->date_end . ' 23:59:59';
        return $query->whereBetween('departure_date', [$start, $end]);
    }

    public function scopeYearly($query, $request)
    {
        return $query->where(function ($query) use ($request) {
            $query->whereYear('departure_date', $request->year_start)
                ->orWhereYear('departure_date', $request->year_end);
        });
    }

    public function scopeFilter($query, $request)
    {
        if ($request->has('date_start') && $request->date_start !== null) {
            $date_end = $request->date_end ?? date('Y-m-d');
            $query->whereDate('letter_date', '>=', $request->date_start)
                ->whereDate('letter_date', '<=', $date_end);
        }

        if ($request->has('no') && $request->no !== null) {
            $query->whereHas('inbox', function ($q) use ($request) {
                $q->where('no', 'like', '%' . $request->no . '%');
            });
        }

        if ($request->has('letter_number') && $request->letter_number !== null) {
            $query->where('letter_number', 'like', '%' . $request->letter_number . '%');
        }

        if ($request->has('status') && $request->status !== null) {
            $query->where('status', $request->status);
        }

        return $query;
    }
}
