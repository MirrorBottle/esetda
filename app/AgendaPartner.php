<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AgendaPartner extends Model
{
    protected $fillable = ['name', 'position'];

    protected $hidden = [
        'created_at',
        'updated_at',
        'pivot',
    ];

    public function agendas()
    {
        return $this->belongsToMany(Agenda::class, 'agenda_partner_details', 'partner_id', 'agenda_id');
    }
}
