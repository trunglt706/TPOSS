<?php

namespace Modules\Admins\Entities;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AdminTokenDevice extends Model
{
    use HasFactory;
    protected $table = 'admin_token_devices';

    protected $fillable = [
        'token',
        'device_name',
        'device_id',
        'os',
        'ip',
        'status'
    ];

    protected $hidden = [
        'token',
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];

    protected static function booted()
    {
        static::creating(function ($token) {
            $token->status = $token->status ?? self::STATUS_ACTIVE;
            $token->ip = $token->ip ?? get_ip();
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

    protected function token(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => (str_replace(' ', '', $value)),
        );
    }

    protected function ip(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => (str_replace(' ', '', $value)),
        );
    }

    const STATUS_ACTIVE = 1;
    const STATUS_SUSPEND = 2;

    const OS_WEB = 'web';
    const OS_ANDROID = 'android';
    const OS_IOS = 'ios';
    const OS_PC = 'pc';

    public function scopeOfIp($query, $ip)
    {
        if (is_array($ip)) {
            return $query->whereIn('ip', $ip);
        }
        return $query->where('ip', $ip);
    }

    public function scopeDeviceName($query, $device_name)
    {
        return $query->where('device_name', $device_name);
    }

    public function scopeDeviceId($query, $device_id)
    {
        if (is_array($device_id)) {
            return $query->whereIn('device_id', $device_id);
        }
        return $query->where('device_id', $device_id);
    }

    public function scopeOfToken($query, $token)
    {
        if (is_array($token)) {
            return $query->whereIn('token', $token);
        }
        return $query->where('token', $token);
    }

    public function scopeOfOs($query, $os)
    {
        if (is_array($os)) {
            return $query->whereIn('os', $os);
        }
        return $query->where('os', $os);
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

    public static function get_os($os = '')
    {
        $list = [
            self::OS_ANDROID => __('admins::platform_android'),
            self::OS_IOS => __('admins::platform_ios'),
            self::OS_WEB => __('admins::platform_web'),
            self::OS_PC => __('admins::platform_pc'),
        ];
        return ($os == '') ? $list : $list[$os];
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
