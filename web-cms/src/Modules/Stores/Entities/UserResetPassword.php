<?php

namespace Modules\Stores\Entities;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserResetPassword extends Model
{
    use HasFactory;
    protected $table = 'admin_reset_passwords';

    protected $fillable = [
        'email',
        'token',
        'ip',
        'device',
        'created_at',
        'expired_at',
        'store_code'
    ];

    protected $hidden = [
        'expired_at',
        'created_at'
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
    public function store()
    {
        return $this->belongsTo(Stores::class, 'code', 'store_code');
    }

    // scope
    public function scopeOfEmail($query, $email)
    {
        return $query->where('email', $email);
    }

    public function scopeStoreCode($query, $store_code)
    {
        return $query->where('store_code', $store_code);
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

    public function scopeSearch($query, $search)
    {
        return $query->where(function ($q) use ($search) {
            $q->orWhere('email', 'LIKE', "%$search%")
                ->orWhere('token', 'LIKE', "%$search%")
                ->orWhere('ip', 'LIKE', "%$search%")
                ->orWhere('device', 'LIKE', "%$search%");
        });
    }
}
