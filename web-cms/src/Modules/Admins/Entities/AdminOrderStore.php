<?php

namespace Modules\Admins\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Stores\Entities\Stores;

class AdminOrderStore extends Model
{
    use HasFactory;

    protected $table = 'admin_order_stores';
    protected $fillable = [
        'order_id',
        'store_id'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function order()
    {
        return $this->hasOne(AdminOrder::class, 'id', 'order_id');
    }

    public function store()
    {
        return $this->hasOne(Stores::class, 'id', 'store_id');
    }

    public function scopeOrderId($query, $order_id)
    {
        if (is_array($order_id)) {
            return $query->whereIn('order_id', $order_id);
        }
        return $query->where('order_id', $order_id);
    }

    public function scopeStoreId($query, $store_id)
    {
        if (is_array($store_id)) {
            return $query->whereIn('store_id', $store_id);
        }
        return $query->where('store_id', $store_id);
    }
}
