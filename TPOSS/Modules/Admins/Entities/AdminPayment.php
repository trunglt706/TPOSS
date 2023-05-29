<?php

namespace Modules\Admins\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AdminPayment extends Model
{
    use HasFactory;
    protected $table = 'admin_payments';

    protected $fillable = ['order_id', 'method_id', 'portal_id', 'total', 'description', 'status', 'attachment', 'type', 'created_by'];

    protected $casts = [
        'created_at' => 'datetime',
    ];

    const STATUS_SUCCESS = 1;
    const STATUS_FAILED = 2;

    const TYPE_THU = 1;
    const TYPE_CHI = 2;

    public function order()
    {
        return $this->hasOne(AdminOrder::class, 'id', 'order_id');
    }

    public function method()
    {
        return $this->hasOne(AdminMethodPayment::class, 'id', 'method_id');
    }

    public function portal()
    {
        return $this->hasOne(AdminPaymentPortal::class, 'id', 'portal_id');
    }

    public function createdBy()
    {
        return $this->hasOne(Admins::class, 'id', 'created_by');
    }

    public function scopeOrderId($query, $order_id)
    {
        if (is_array($order_id)) {
            return $query->whereIn('order_id', $order_id);
        }
        return $query->where('order_id', $order_id);
    }

    public function scopeMethodId($query, $method_id)
    {
        if (is_array($method_id)) {
            return $query->whereIn('method_id', $method_id);
        }
        return $query->where('method_id', $method_id);
    }

    public function scopePortalId($query, $portal_id)
    {
        if (is_array($portal_id)) {
            return $query->whereIn('portal_id', $portal_id);
        }
        return $query->where('portal_id', $portal_id);
    }

    public function scopeCreatedBy($query, $created_by)
    {
        if (is_array($created_by)) {
            return $query->whereIn('created_by', $created_by);
        }
        return $query->where('created_by', $created_by);
    }

    public function scopeType($query, $type)
    {
        if (is_array($type)) {
            return $query->whereIn('type', $type);
        }
        return $query->where('type', $type);
    }

    public function scopeStatus($query, $status)
    {
        if (is_array($status)) {
            return $query->whereIn('status', $status);
        }
        return $query->where('status', $status);
    }

    public function scopeSuccess($query)
    {
        return $query->where('status', self::STATUS_SUCCESS);
    }

    public static function get_status($id = '')
    {
        $list = [
            self::STATUS_SUCCESS => ['Thành công', COLORS['success'], 'check-circle'],
            self::STATUS_FAILED => ['Thất bại', COLORS['warning'], 'lock-on'],
        ];
        return ($id == '') ? $list : $list[$id];
    }

    public static function get_type($id = '')
    {
        $list = [
            self::TYPE_THU => ['Thu', COLORS['success'], 'arrow-up'],
            self::TYPE_CHI => ['Chi', COLORS['danger'], 'arrow-down'],
        ];
        return ($id == '') ? $list : $list[$id];
    }
}
