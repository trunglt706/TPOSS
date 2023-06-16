<?php

namespace Modules\Admins\Entities;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AdminInvoice extends Model
{
    use HasFactory;
    protected $table = 'admin_invoices';

    protected $fillable = [
        'order_id',
        'portal_id',
        'data',
        'link',
        'status',
        'sub_total',
        'before_vat',
        'after_vat',
        'description'
    ];

    protected $hidden = [
        'order_id',
        'portal_id',
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
        'sub_total' => 'double',
        'before_vat' => 'double',
        'after_vat' => 'double',
    ];

    protected static function booted()
    {
        static::creating(function ($invoice) {
            $invoice->status = $invoice->status ?? self::STATUS_WAIT;
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

    protected function data(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => (json_decode($value, 1)),
        );
    }

    const STATUS_WAIT = 0;
    const STATUS_SUCCESS = 1;
    const STATUS_FAILED = 2;

    public function order()
    {
        return $this->belongsTo(AdminOrder::class, 'order_id');
    }

    public function portal()
    {
        return $this->belongsTo(InvoicePortal::class, 'portal_id');
    }

    public function scopeOrderId($query, $order_id)
    {
        if (is_array($order_id)) {
            return $query->whereIntegerInRaw('order_id', $order_id);
        }
        return $query->where('order_id', $order_id);
    }

    public function scopePortalId($query, $portal_id)
    {
        if (is_array($portal_id)) {
            return $query->whereIntegerInRaw('portal_id', $portal_id);
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
            self::STATUS_WAIT => [__('admins::invoice_status_0'), COLORS['secondary'], 'clock'],
            self::STATUS_SUCCESS => [__('admins::invoice_status_1'), COLORS['success'], 'check'],
            self::STATUS_FAILED => [__('admins::invoice_status_2'), COLORS['danger'], 'exclamation-triangle'],
        ];
        return ($id == '') ? $list : $list[$id];
    }
}
