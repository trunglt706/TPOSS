<?php

namespace Modules\Stores\Entities;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Admins\Entities\AdminCustomer;
use Modules\Admins\Entities\Admins;

class SubDomain extends Model
{
    use HasFactory;
    protected $table = 'sub_domains';

    protected $fillable = [
        'sub_domain',
        'customer_id',
        'description',
        'status',
        'active_date',
        'created_by'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'active_date' => 'datetime',
    ];

    const STATUS_ACTIVE = 1;
    const STATUS_SUSPEND = 2;

    public function customer()
    {
        return $this->hasOne(AdminCustomer::class, 'id', 'customer_id');
    }

    public function createdBy()
    {
        return $this->hasOne(Admins::class, 'id', 'created_by');
    }

    public function scopeDomain($query, $domain)
    {
        return $query->where('domain', $domain);
    }

    public function scopeCustomerId($query, $customer_id)
    {
        if (is_array($customer_id)) {
            return $query->whereIn('customer_id', $customer_id);
        }
        return $query->where('customer_id', $customer_id);
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

    public function scopeActiveDate($query, $active_date)
    {
        $_date = Carbon::parse($active_date)->format('Y-m-d');
        return $query->whereDate('active_date', $_date);
    }

    public function scopeDate($query, $created_at)
    {
        $_date = Carbon::parse($created_at)->format('Y-m-d');
        return $query->whereDate('created_at', $_date);
    }

    public function scopeBetween($query, $from, $to)
    {
        $_from = Carbon::parse($from)->startOfDay()->format('Y-m-d H:i:s');
        $_to = Carbon::parse($to)->startOfDay()->format('Y-m-d H:i:s');
        return $query->whereBetween('created_at', [$_from, $_to]);
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
