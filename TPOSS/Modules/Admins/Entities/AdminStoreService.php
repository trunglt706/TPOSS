<?php

namespace Modules\Admins\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AdminStoreService extends Model
{
    use HasFactory;
    protected $table = 'admin_store_services';

    protected $fillable = ['store_id', 'service_id', 'support_device', 'description', 'status', 'max_users', 'max_times', 'max_orders', 'created_by', 'total_amount'];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'max_users' => 'integer',
        'max_times' => 'integer',
        'max_orders' => 'integer',
        'total_amount' => 'integer',
    ];

    const STATUS_ACTIVE = 1;
    const STATUS_SUSPEND = 2;

    public function store()
    {
        return $this->hasOne(Stores::class, 'id', 'store_id');
    }

    public function service()
    {
        return $this->hasOne(Service::class, 'id', 'service_id');
    }

    public function createdBy()
    {
        return $this->hasOne(Admins::class, 'id', 'created_by');
    }

    public function scopeStoreId($query, $store_id)
    {
        if (is_array($store_id)) {
            return $query->whereIn('store_id', $store_id);
        }
        return $query->where('store_id', $store_id);
    }

    public function scopeServiceId($query, $service_id)
    {
        if (is_array($service_id)) {
            return $query->whereIn('service_id', $service_id);
        }
        return $query->where('service_id', $service_id);
    }

    public function scopeCreatedBy($query, $created_by)
    {
        if (is_array($created_by)) {
            return $query->whereIn('created_by', $created_by);
        }
        return $query->where('created_by', $created_by);
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
            self::STATUS_ACTIVE => ['Kích hoạt', COLORS['success'], 'check-circle'],
            self::STATUS_SUSPEND => ['Bị khóa', COLORS['warning'], 'lock-on'],
        ];
        return ($id == '') ? $list : $list[$id];
    }

    public function scopeSearchSupport($query, $support)
    {
        $data = json_encode([$support]);
        if (is_array($support)) {
            $data = json_encode($support);
        }
        return $query->whereRaw('JSON_CONTAINS(support_device, \'' . $data . '\')');
    }
}
