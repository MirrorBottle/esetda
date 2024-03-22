<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Receiver extends Model
{
    protected $fillable = [
        'name',
        'type',
        'biro_id',
        'description',
    ];

    public function getTypeFormattedAttribute()
    {
        return $this->type == 0 ? 'Luar Setda' : 'Lingkup Setda';
    }

    public function getNameFormattedAttribute()
    {
        return ucwords(strtolower($this->name));
    }

    public function inboxes()
    {
        return $this->hasMany(Inbox::class);
    }

    public function outboxes()
    {
        return $this->hasMany(Outbox::class);
    }

    public function hasRelatedData()
    {
        return $this->inboxes()->count() > 0 || $this->outboxes()->count();
    }
}
