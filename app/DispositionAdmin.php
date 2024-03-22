<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DispositionAdmin extends Model
{
    protected $guarded = [];

    protected $casts = [
        'actions' => 'array',
    ];

    public static function boot() {
        parent::boot();

        static::creating(function (DispositionAdmin $item) {
            $item->user_id = auth()->user()->id;
            $item->created_at = date('Y-m-d h:i:s');
        });
    }

    public function parent()
    {
        return $this->belongsTo(DispositionAdmin::class, 'parent_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function inbox()
    {
        return $this->belongsTo(Inbox::class);
    }

    public function receiver()
    {
        return $this->belongsTo(Receiver::class);
    }

    public function getSignatureImageStringAttribute()
    {
        return image_to_base64('storage/'. $this->signature_image);
    }
}
