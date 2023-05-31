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

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function admin()
    {
        return $this->hasOne(Admins::class, 'id', 'admin_id');
    }

    public function store()
    {
        if (Module::has('Stores')) {
            return $this->hasOne(Stores::class, 'id', 'store_id');
        }
        return null;
    }

    public function scopeAdminId($query, $admin_id)
    {
        if (is_array($admin_id)) {
            return $query->whereIn('admin_id', $admin_id);
        }
        return $query->where('admin_id', $admin_id);
    }

    public function scopeStoreId($query, $store_id)
    {
        if (is_array($store_id)) {
            return $query->whereIn('store_id', $store_id);
        }
        return $query->where('store_id', $store_id);
    }
}
