<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArchiveBundleDetail extends Model
{
    protected $fillable = [
        'bundle_id',
        'archive_id',
        'approver_id',
        'status',
        'note'
    ];

    public function bundle()
    {
        return $this->belongsTo(ArchiveBundle::class, 'bundle_id');
    }

    public function archive()
    {
        return $this->belongsTo(Archive::class, 'archive_id');
    }

    public function approver()
    {
        return $this->belongsTo(User::class, 'approver_id');
    }
}
