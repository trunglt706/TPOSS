<?php

namespace Modules\Admins\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AdminInvoice extends Model
{
    use HasFactory;
    protected $table = 'admin_invoices';

    protected $fillable = ['order_id', 'portal_id', 'data', 'link', 'status'];

    protected $casts = [
        'created_at' => 'datetime',
    ];

    const STATUS_WAIT = 0;
    const STATUS_SUCCESS = 1;
    const STATUS_FAILED = 2;

    public function order()
    {
        return $this->hasOne(AdminOrder::class, 'id', 'order_id');
    }

    public function portal()
    {
        return $this->hasOne(InvoicePortal::class, 'id', 'portal_id');
    }

    public function scopeOrderId($query, $order_id)
    {
        if (is_array($order_id)) {
            return $query->whereIn('order_id', $order_id);
        }
        return $query->where('order_id', $order_id);
    }

    public function scopePortalId($query, $portal_id)
    {
        if (is_array($portal_id)) {
            return $query->whereIn('portal_id', $portal_id);
        }
        return $query->where('portal_id', $portal_id);
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
            self::STATUS_WAIT => ['Đang chờ', COLORS['secondary'], 'clock'],
            self::STATUS_SUCCESS => ['Thành công', COLORS['success'], 'check'],
            self::STATUS_FAILED => ['Thất bại', COLORS['danger'], 'exclamation-triangle'],
        ];
        return ($id == '') ? $list : $list[$id];
    }
}
