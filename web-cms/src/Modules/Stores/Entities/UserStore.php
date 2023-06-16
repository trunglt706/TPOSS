<?php

namespace Modules\Stores\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserStore extends Model
{
    use HasFactory;

    protected $table = 'user_stores';
    protected $fillable = [
        'user_id',
        'store_id',
        'position_id',
        'status'
    ];

    protected $hidden = [
        'user_id',
        'store_id',
        'position_id',
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
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

    const STATUS_ACTIVE = 1;
    const STATUS_SUSPEND = 2;

    public function user()
    {
        return $this->belongsTo(Users::class, 'user_id');
    }

    public function store()
    {
        return $this->belongsTo(Stores::class, 'store_id');
    }

    public function position()
    {
        return $this->belongsTo(Positions::class, 'position_id');
    }

    public function scopeUserId($query, $user_id)
    {
        if (is_array($user_id)) {
            return $query->whereIntegerInRaw('user_id', $user_id);
        }
        return $query->where('user_id', $user_id);
    }

    public function scopeStoreId($query, $store_id)
    {
        if (is_array($store_id)) {
            return $query->whereIntegerInRaw('store_id', $store_id);
        }
        return $query->where('store_id', $store_id);
    }

    public function scopePositionId($query, $position_id)
    {
        if (is_array($position_id)) {
            return $query->whereIntegerInRaw('position_id', $position_id);
        }
        return $query->where('position_id', $position_id);
    }

    public function scopeStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    public function scopeActive($query)
    {
        return $query->where('status', self::STATUS_ACTIVE);
    }

    public static function get_status($id = '')
    {
        $list = [
            self::STATUS_ACTIVE => [__('stores::status_1'), COLORS['success'], 'check-circle'],
            self::STATUS_SUSPEND => [__('stores::status_2'), COLORS['warning'], 'lock-on'],
        ];
        return ($id == '') ? $list : $list[$id];
    }
}
