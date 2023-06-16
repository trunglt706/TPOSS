<?php

namespace Modules\Admins\Entities;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AdminPayment extends Model
{
    use HasFactory;
    protected $table = 'admin_payments';

    protected $fillable = [
        'order_id',
        'method_id',
        'portal_id',
        'total',
        'description',
        'status',
        'attachment',
        'type',
        'created_by'
    ];

    protected $hidden = [
        'order_id',
        'method_id',
        'portal_id',
        'created_by'
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
        'total' => 'integer',
    ];

    protected static function booted()
    {
        static::creating(function ($payment) {
            $payment->created_by = Auth::guard(AUTH_ADMIN)->check() ? Auth::guard(AUTH_ADMIN)->user()->id : 0;
            $payment->type = $payment->type ?? self::TYPE_THU;
            $payment->status = $payment->status ?? self::STATUS_FAILED;
        });

        static::created(function ($model) {
        });

        static::updating(function ($model) {
        });

        static::updated(function ($model) {
        });

        static::deleted(function ($payment) {
            if ($payment->attachment) Storage::delete($payment->attachment);
        });
    }

    const STATUS_SUCCESS = 1;
    const STATUS_FAILED = 2;

    const TYPE_THU = 1;
    const TYPE_CHI = 2;

    public function order()
    {
        return $this->belongsTo(AdminOrder::class, 'order_id');
    }

    public function method()
    {
        return $this->belongsTo(AdminMethodPayment::class, 'method_id');
    }

    public function portal()
    {
        return $this->belongsTo(AdminPaymentPortal::class,  'portal_id');
    }

    public function createdBy()
    {
        return $this->hasOne(Admins::class, 'id', 'created_by')->withDefault([
            'id' => 0,
            'name' => __('dashboard_admin')
        ]);
    }

    public function scopeOrderId($query, $order_id)
    {
        if (is_array($order_id)) {
            return $query->whereIntegerInRaw('order_id', $order_id);
        }
        return $query->where('order_id', $order_id);
    }

    public function scopeMethodId($query, $method_id)
    {
        if (is_array($method_id)) {
            return $query->whereIntegerInRaw('method_id', $method_id);
        }
        return $query->where('method_id', $method_id);
    }

    public function scopePortalId($query, $portal_id)
    {
        if (is_array($portal_id)) {
            return $query->whereIntegerInRaw('portal_id', $portal_id);
        }
        return $query->where('portal_id', $portal_id);
    }

    public function scopeOfCreated($query, $created_by)
    {
        if (is_array($created_by)) {
            return $query->whereIntegerInRaw('created_by', $created_by);
        }
        return $query->where('created_by', $created_by);
    }

    public function scopeOfType($query, $type)
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
            self::STATUS_SUCCESS => [__('admins::result_status_1'), COLORS['success'], 'check-circle'],
            self::STATUS_FAILED => [__('admins::result_status_2'), COLORS['warning'], 'lock-on'],
        ];
        return ($id == '') ? $list : $list[$id];
    }

    public static function get_type($id = '')
    {
        $list = [
            self::TYPE_THU => [__('admins::payment_type_1'), COLORS['success'], 'arrow-up'],
            self::TYPE_CHI => [__('admins::payment_type_2'), COLORS['danger'], 'arrow-down'],
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
