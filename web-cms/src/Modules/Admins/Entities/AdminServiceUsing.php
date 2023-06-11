<?php

namespace Modules\Admins\Entities;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AdminServiceUsing extends Model
{
    use HasFactory;
    protected $table = 'admin_service_usings';

    protected $fillable = [
        'customer_id',
        'service_id',
        'support_device',
        'description',
        'status',
        'max_stores',
        'max_users',
        'max_times',
        'max_orders',
        'created_by',
        'total_amount'
    ];

    protected $hidden = [
        'customer_id',
        'service_id',
        'created_by',
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
        'max_users' => 'integer',
        'max_times' => 'integer',
        'max_orders' => 'integer',
        'total_amount' => 'integer',
        'max_stores' => 'integer',
    ];

    protected static function booted()
    {
        static::creating(function ($service) {
            $support_device_default = json_encode([
                Service::SUPPORT_WEB
            ]);
            $setting = Service::find($service->service_id ?? 0);
            if ($setting && $setting->support_device) {
                $support_device_default = $setting->support_device;
            }
            $service->support_device = $service->support_device ?? $support_device_default;
            $service->status = $service->status ?? self::STATUS_ACTIVE;
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

    protected function supportDevice(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => (json_decode($value, 1)),
        );
    }

    protected function maxStores(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => ((int)$value),
        );
    }

    protected function maxUsers(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => ((int)$value),
        );
    }

    protected function maxTimes(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => ((int)$value),
        );
    }

    protected function maxOrders(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => ((int)$value),
        );
    }

    protected function totalAmount(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => ((int)$value),
        );
    }

    const STATUS_ACTIVE = 1;
    const STATUS_SUSPEND = 2;

    public function ofStore()
    {
        return $this->belongsTo(AdminServiceUsingStore::class, 'id', 'store_id');
    }

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
        return $this->hasOne(Admins::class, 'id', 'created_by')->withDefault([
            'id' => 0,
            'name' => __('dashboard_admin')
        ]);
    }

    public function scopeServiceId($query, $service_id)
    {
        if (is_array($service_id)) {
            return $query->whereIntegerInRaw('service_id', $service_id);
        }
        return $query->where('service_id', $service_id);
    }

    public function scopeOfCreated($query, $created_by)
    {
        if (is_array($created_by)) {
            return $query->whereIntegerInRaw('created_by', $created_by);
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
            self::STATUS_ACTIVE => [__('admins::status_1'), COLORS['success'], 'check-circle'],
            self::STATUS_SUSPEND => [__('admins::status_2'), COLORS['warning'], 'lock-on'],
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
