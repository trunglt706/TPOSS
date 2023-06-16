<?php

namespace Modules\Stores\Entities;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;

class StoreKey extends Model
{
    use HasFactory;

    protected $table = 'store_keys';
    protected $fillable = [
        'store_id',
        'key',
        'pin',
        'rgm',
        'expire_date',
        'computer',
        'status'
    ];

    protected $hidden = [
        'store_id',
        'key',
        'pin',
        'rgm',
        'expire_date',
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
        'expire_date' => 'date:Y-m-d'
    ];

    protected static function booted()
    {
        static::creating(function ($model) {
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

    protected function pin(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => base64_decode($value),
            set: fn (string $value) => base64_encode($value),
        );
    }

    protected function rgm(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => base64_decode($value),
            set: fn (string $value) => base64_encode($value),
        );
    }

    public function store()
    {
        return $this->belongsTo(Stores::class, 'id', 'store_id');
    }

    public function scopeStoreId($query, $store_id)
    {
        if (is_array($store_id)) {
            return $query->whereIntegerInRaw('store_id', $store_id);
        }
        return $query->where('store_id', $store_id);
    }

    public function scopeOfKey($query, $key)
    {
        return $query->where('key', $key);
    }

    public function scopeOfPin($query, $pin)
    {
        return $query->where('pin', $pin);
    }

    public function scopeOfRgm($query, $rgm)
    {
        return $query->where('rgm', $rgm);
    }

    public function scopeOfComputer($query, $computer)
    {
        return $query->where('computer', $computer);
    }

    public function scopeStatus($query, $status)
    {
        if (is_array($status)) {
            return $query->whereIn('status', $status);
        }
        return $query->where('status', $status);
    }

    public function scopeExpireDate($query, $expire_date)
    {
        $_date = Carbon::parse($expire_date)->format('Y-m-d');
        return $query->where('created_at', $_date);
    }

    public function scopeExpired($query)
    {
        return $query->where('expire_date', '>', Carbon::now()->format('Y-m-d'));
    }
}
