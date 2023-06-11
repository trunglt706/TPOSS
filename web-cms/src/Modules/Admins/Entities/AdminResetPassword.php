<?php

namespace Modules\Admins\Entities;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AdminResetPassword extends Model
{
    use HasFactory;
    protected $table = 'admin_reset_passwords';

    protected $fillable = [
        'email',
        'token',
        'ip',
        'device',
        'created_at',
        'expired_at'
    ];

    protected $hidden = [
        'expired_at',
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'expired_at' => 'datetime:Y-m-d H:i:s',
    ];

    protected static function booted()
    {
        static::creating(function ($passwordResetToken) {
            $passwordResetToken->token = $passwordResetToken->token ?? generateRandomString(16);
            $passwordResetToken->ip = $passwordResetToken->ip ?? get_ip();
            $passwordResetToken->device = $passwordResetToken->device ?? get_device();
            $passwordResetToken->expired_at = $passwordResetToken->expired_at ?? Carbon::now()->addMinutes(15);
        });

        static::created(function ($model) {
        });

        static::updating(function ($model) {
        });

        static::updated(function ($model) {
        });

        static::deleted(function ($model) {
        });
    }

    // relations
    public function admin()
    {
        return $this->hasOne(Admins::class, 'email', 'email');
    }

    // scope
    public function scopeOfEmail($query, $email)
    {
        return $query->where('email', $email);
    }

    public function scopeStoreId($query, $store_id)
    {
        return $query->where('store_id', $store_id);
    }

    public function scopeOfToken($query, $token)
    {
        return $query->where('token', $token);
    }

    public function scopeExpired($query)
    {
        return $query->where('expired_at', '<', now());
    }

    public function scopeNotExpired($query)
    {
        return $query->where('expired_at', '>=', now());
    }
}
