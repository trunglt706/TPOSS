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

    protected $fillable = [
        'customer_id',
        'service_id',
        'start_date',
        'end_date',
        'discount_type',
        'discount_value',
        'discount_total',
        'vat_value',
        'vat_total',
        'sub_total',
        'total',
        'description',
        'url_view',
        'status',
        'created_by',
        'deleted_by'
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
        'start_date' => 'datetime:Y-m-d',
        'end_date' => 'datetime:Y-m-d',
        'discount_value' => 'integer',
        'discount_total' => 'integer',
        'vat_total' => 'integer',
        'vat_value' => 'integer',
        'sub_total' => 'integer',
        'total' => 'integer',
    ];

    const DISCOUNT_TYPE_PERCENT = 1;
    const DISCOUNT_TYPE_VND = 0;

    const STATUS_TMP = 0;
    const STATUS_APPROVED = 1;
    const STATUS_EXPIRED = 2;
    const STATUS_DELETED = 3;

    public function customer()
    {
        return $this->hasOne(AdminCustomer::class, 'id', 'customer_id');
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

    public function scopeCustomerId($query, $customer_id)
    {
        if (is_array($customer_id)) {
            return $query->whereIn('customer_id', $customer_id);
        }
        return $query->where('customer_id', $customer_id);
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
            self::STATUS_TMP => [__('admins::order_status_0'), COLORS['secondary']],
            self::STATUS_APPROVED => [__('admins::order_status_1'), COLORS['success']],
            self::STATUS_EXPIRED => [__('admins::order_status_2'), COLORS['warning']],
            self::STATUS_DELETED => [__('admins::order_status_3'), COLORS['danger']],
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