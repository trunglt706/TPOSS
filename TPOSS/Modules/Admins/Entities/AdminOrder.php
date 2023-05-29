<?php

namespace Modules\Admins\Entities;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Stores\Entities\Stores;

class AdminOrder extends Model
{
    use HasFactory;
    protected $table = 'admin_orders';

    protected $fillable = ['store_id', 'service_id', 'start_date', 'end_date', 'discount_type', 'discount_value', 'discount_total', 'vat_value', 'vat_total', 'sub_total', 'total', 'description', 'url_view', 'status', 'created_by', 'deleted_by'];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    const DISCOUNT_TYPE_PERCENT = 1;
    const DISCOUNT_TYPE_VND = 0;

    const STATUS_TMP = 0;
    const STATUS_APPROVED = 1;
    const STATUS_EXPIRED = 2;
    const STATUS_DELETED = 3;

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

    public function deletedBy()
    {
        return $this->hasOne(Admins::class, 'id', 'deleted_by');
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

    public function scopeDeletedBy($query, $deleted_by)
    {
        if (is_array($deleted_by)) {
            return $query->whereIn('deleted_by', $deleted_by);
        }
        return $query->where('deleted_by', $deleted_by);
    }

    public function scopeStatus($query, $status)
    {
        if (is_array($status)) {
            return $query->whereIn('status', $status);
        }
        return $query->where('status', $status);
    }

    public function scopeApprove($query)
    {
        return $query->where('status', self::STATUS_APPROVED);
    }

    public static function get_status($id = '')
    {
        $list = [
            self::STATUS_TMP => ['Đơn tạm', COLORS['secondary']],
            self::STATUS_APPROVED => ['Đã duyệt', COLORS['success']],
            self::STATUS_EXPIRED => ['Quá hạn', COLORS['warning']],
            self::STATUS_DELETED => ['Đã xáo', COLORS['danger']],
        ];
        return ($id == '') ? $list : $list[$id];
    }

    public function scopeDate($query, $date)
    {
        $_date = Carbon::parse($date)->format('Y-m-d');
        return $query->whereDate('created_at', $_date);
    }

    public function scopeBetween($query, $from, $to)
    {
        $_from = Carbon::parse($from)->startOfDay()->format('Y-m-d H:i:s');
        $_to = Carbon::parse($to)->startOfDay()->format('Y-m-d H:i:s');
        return $query->whereBetween('created_at', [$_from, $_to]);
    }
}
