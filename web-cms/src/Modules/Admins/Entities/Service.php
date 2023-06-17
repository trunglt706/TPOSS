<?php

namespace Modules\Admins\Entities;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Modules\Stores\Entities\Stores;
use Illuminate\Support\Str;

class Service extends Model
{
    use HasFactory;
    protected $table = 'services';

    protected $fillable = [
        'code',
        'name',
        'support_device',
        'description',
        'status',
        'image',
        'max_users',
        'max_times',
        'max_orders',
        'max_stores',
        'total_amount',
        'created_by'
    ];

    protected $hidden = [
        'created_by',
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
        'max_users' => 'integer',
        'max_times' => 'integer',
        'max_orders' => 'integer',
        'max_stores' => 'integer',
        'total_amount' => 'integer',
    ];

    protected static function booted()
    {
        static::creating(function ($service) {
            $service->status = $service->status ?? self::STATUS_ACTIVE;
            $service->created_by = Auth::guard(AUTH_ADMIN)->check() ? Auth::guard(AUTH_ADMIN)->user()->id : 0;

            $support_default = json_encode([
                Service::SUPPORT_WEB
            ]);
            $support_device_default = get_option('support-device-default', $support_default);
            $service->support_device = $service->support_device ?? $support_device_default;
        });

        static::created(function ($model) {
        });

        static::updating(function ($model) {
        });

        static::updated(function ($model) {
        });

        static::deleted(function ($model) {
            if ($model->image) Storage::delete($model->image);
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

    protected function phone(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => (get_option('hide-phone-register', true) ? Str::mask($value, '*', - (strlen($value)), (strlen($value) - 3)) : $value),
        );
    }

    const STATUS_ACTIVE = 1;
    const STATUS_SUSPEND = 2;

    const SUPPORT_WEB = 'web';
    const SUPPORT_WINDOW = 'window';
    const SUPPORT_MAC = 'mac';
    const SUPPORT_ANDROID = 'android';
    const SUPPORT_IOS = 'ios';

    public function stores()
    {
        return $this->hasMany(Stores::class, 'service_id', 'id');
    }

    public function createdBy()
    {
        return $this->hasOne(Admins::class, 'id', 'created_by')->withDefault([
            'id' => 0,
            'name' => __('dashboard_admin')
        ]);
    }

    public function scopeOfCode($query, $code)
    {
        return $query->where('code', $code);
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
            self::STATUS_ACTIVE => [__('status_1'), COLORS['success'], 'check-circle'],
            self::STATUS_SUSPEND => [__('status_2'), COLORS['warning'], 'lock-on'],
        ];
        return ($id == '') ? $list : $list[$id];
    }

    public function scopeSearchSupport($query, $support)
    {
        if (is_array($support)) {
            $data = json_encode($support);
        }
        $data = json_encode([$support]);
        return $query->whereRaw('JSON_CONTAINS(support_device, \'' . $data . '\')');
    }
}
