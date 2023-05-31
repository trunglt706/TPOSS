<?php

namespace Modules\Stores\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Admins\Entities\AdminCustomer;

class StorePermission extends Model
{
    use HasFactory;
    protected $table = 'store_permissions';

    protected $fillable = [
        'customer_id',
        'store_id',
        'permission_id',
        'status'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    const STATUS_ACTIVE = 1;
    const STATUS_SUSPEND = 2;

    public function customer()
    {
        return $this->hasOne(AdminCustomer::class, 'customer_id', 'id');
    }

    public function store()
    {
        return $this->hasOne(Stores::class, 'store_id', 'id');
    }

    public function permission()
    {
        return $this->hasOne(Permissions::class, 'permission_id', 'id');
    }

    public function scopeCustomerId($query, $customer_id)
    {
        if (is_array($customer_id)) {
            return $query->whereIn('customer_id', $customer_id);
        }
        return $query->where('customer_id', $customer_id);
    }

    public function scopeStoreId($query, $store_id)
    {
        if (is_array($store_id)) {
            return $query->whereIn('store_id', $store_id);
        }
        return $query->where('store_id', $store_id);
    }

    public function scopePermissionId($query, $permission_id)
    {
        if (is_array($permission_id)) {
            return $query->whereIn('permission_id', $permission_id);
        }
        return $query->where('permission_id', $permission_id);
    }

    public function scopeStatus($query, $status)
    {
        if (is_array($status)) {
            return $query->whereIn('status', $status);
        }
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
