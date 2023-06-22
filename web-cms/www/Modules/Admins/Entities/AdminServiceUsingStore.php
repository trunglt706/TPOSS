<?php

namespace Modules\Admins\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Stores\Entities\Stores;

class AdminServiceUsingStore extends Model
{
    use HasFactory;
    protected $table = 'admin_service_using_stores';
    protected $fillable = [
        'using_id',
        'store_id'
    ];

    protected $hidden = [
        'using_id',
        'store_id'
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

    public function serviceUsing()
    {
        return $this->belongsTo(AdminServiceUsing::class, 'using_id');
    }

    public function store()
    {
        return $this->belongsTo(Stores::class, 'store_id');
    }

    public function scopeUsingId($query, $using_id)
    {
        if (is_array($using_id)) {
            return $query->whereIntegerInRaw('using_id', $using_id);
        }
        return $query->where('using_id', $using_id);
    }

    public function scopeStoreId($query, $store_id)
    {
        if (is_array($store_id)) {
            return $query->whereIntegerInRaw('store_id', $store_id);
        }
        return $query->where('store_id', $store_id);
    }
}
