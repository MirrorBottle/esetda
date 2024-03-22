<?php

namespace App;

use Carbon\Carbon;
use Hash;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use SoftDeletes, Notifiable;

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $dates = [
        'updated_at',
        'created_at',
        'deleted_at',
        'email_verified_at',
    ];

    protected $fillable = [
        'type',
        'biro_id',
        'username',
        'name',
        'email',
        'wa',
        'email_verified_at',
        'password',
        'disposition_password',
        'remember_token',
    ];

    public function getEmailVerifiedAtAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    public function setEmailVerifiedAtAttribute($value)
    {
        $this->attributes['email_verified_at'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    }

    public function getTypeFormattedAttribute()
    {
        $type = null;
        if ($this->type == 0) {
            $type = 'super';
        } else if ($this->type == 1) {
            $type = 'esetda';
        } else if ($this->type == 2) {
            $type = 'eagenda';
        } else if ($this->type == 3) {
            $type = 'earsip';
        }

        return $type;
    }

    public function setPasswordAttribute($input)
    {
        if ($input) {
            $this->attributes['password'] = Hash::make($input);
        }
    }

    public function setDispositionPasswordAttribute($input)
    {
        if ($input) {
            $this->attributes['disposition_password'] = Hash::make($input);
        }
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPassword($token));
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function profile()
    {
        return $this->hasOne(UserProfile::class);
    }

    public function pejabat()
    {
        return $this->hasOne(Pejabat::class);
    }

    public function isAdmin()
    {
        foreach ($this->roles()->get() as $role)
        {
            if ($role->title == 'Admin')
            {
                return true;
            }
        }

        return false;
    }

    public function isOperator()
    {
        foreach ($this->roles()->get() as $role)
        {
            if ($role->title == 'User')
            {
                return true;
            }
        }

        return false;
    }

    public function biro()
    {
        return $this->belongsTo(Biro::class);
    }

    public function receiver()
    {
        return $this->belongsTo(Receiver::class);
    }

    public function isTupimDua()
    {
        return $this->username == 'tu_pimpinan2';
    }
}
