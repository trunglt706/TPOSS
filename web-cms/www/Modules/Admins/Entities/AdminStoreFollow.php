<?php

namespace Modules\Admins\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Stores\Entities\Stores;
use Nwidart\Modules\Facades\Module;

class AdminStoreFollow extends Model
{
    use HasFactory;
    protected $table = 'admin_store_follows';

    protected $fillable = [
        'admin_id',
        'store_id'
    ];

    protected $hidden = [
        'admin_id',
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

    public function admin()
    {
        return $this->belongsTo(Admins::class,  'admin_id')->withDefault([
            'id' => 0,
            'name' => __('dashboard_admin')
        ]);
    }

    public function store()
    {
        return $this->belongsTo(Stores::class, 'store_id');
    }

    public function scopeAdminId($query, $admin_id)
    {
        if (is_array($admin_id)) {
            return $query->whereIntegerInRaw('admin_id', $admin_id);
        }
        return $query->where('admin_id', $admin_id);
    }

    public function scopeStoreId($query, $store_id)
    {
        if (is_array($store_id)) {
            return $query->whereIntegerInRaw('store_id', $store_id);
        }
        return $query->where('store_id', $store_id);
    }
}
