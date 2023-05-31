<?php

namespace Modules\Stores\Entities;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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

    public function store()
    {
        return $this->hasOne(Stores::class, 'id', 'store_id');
    }

    public function scopeStoreId($query, $store_id)
    {
        if (is_array($store_id)) {
            return $query->whereIn('store_id', $store_id);
        }
        return $query->where('store_id', $store_id);
    }

    public function scopeKey($query, $key)
    {
        return $query->where('key', $key);
    }

    public function scopePin($query, $pin)
    {
        return $query->where('pin', $pin);
    }

    public function scopeRgm($query, $rgm)
    {
        return $query->where('rgm', $rgm);
    }

    public function scopeComputer($query, $computer)
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
