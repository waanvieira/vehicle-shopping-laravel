<?php

namespace App\Models;

use App\Traits\HashID;
use App\Traits\UuidTrait;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use Notifiable;
    use HasApiTokens;
    use UuidTrait;
    use SoftDeletes;
    use HashID;

    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'expires_at', 'delete_account_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function setPasswordAttribute($value)
    {        
        $this->attributes['password'] = Hash::make($value);
    }

    public function setExpiresAtAttribute()
    {        
        $this->attributes['expires_at'] = now()->addDays(7);
    }

    public function setDeleteAccountAtAttribute()
    {        
        $this->attributes['delete_account_at'] = now()->addDays(15);
    }
}
