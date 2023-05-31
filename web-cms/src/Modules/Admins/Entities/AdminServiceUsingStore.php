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

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function serviceUsing()
    {
        return $this->hasOne(AdminServiceUsing::class, 'id', 'using_id');
    }

    public function store()
    {
        return $this->hasOne(Stores::class, 'id', 'store_id');
    }

    public function scopeUsingId($query, $using_id)
    {
        if (is_array($using_id)) {
            return $query->whereIn('using_id', $using_id);
        }
        return $query->where('using_id', $using_id);
    }

    public function scopeStoreId($query, $store_id)
    {
        if (is_array($store_id)) {
            return $query->whereIn('store_id', $store_id);
        }
        return $query->where('store_id', $store_id);
    }
}
