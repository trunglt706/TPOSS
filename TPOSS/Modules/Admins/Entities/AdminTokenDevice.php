<?php

namespace Modules\Admins\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AdminTokenDevice extends Model
{
    use HasFactory;
    protected $table = 'admin_token_devices';

    protected $fillable = ['token', 'device_name', 'device_id', 'os', 'ip', 'status'];

    protected $casts = [
        'created_at' => 'datetime',
    ];

    const STATUS_ACTIVE = 1;
    const STATUS_SUSPEND = 2;

    const OS_WEB = 'web';
    const OS_ANDROID = 'android';
    const OS_IOS = 'ios';
    const OS_PC = 'pc';

    public function scopeIp($query, $ip)
    {
        return $query->where('ip', $ip);
    }

    public function scopeDeviceName($query, $device_name)
    {
        return $query->where('device_name', $device_name);
    }

    public function scopeDeviceId($query, $device_id)
    {
        return $query->where('device_id', $device_id);
    }

    public function scopeToken($query, $token)
    {
        return $query->where('token', $token);
    }

    public function scopeOs($query, $os)
    {
        return $query->where('os', $os);
    }

    public function scopeStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    public static function get_status($id = '')
    {
        $list = [
            self::STATUS_ACTIVE => ['Kích hoạt', COLORS['success'], 'check-circle'],
            self::STATUS_SUSPEND => ['Bị khóa', COLORS['warning'], 'lock-on'],
        ];
        return ($id == '') ? $list : $list[$id];
    }

    public static function get_os($os = '')
    {
        $list = [
            self::OS_ANDROID => 'Hệ điều hành Android',
            self::OS_IOS => 'Hệ điều hành IOS',
            self::OS_WEB => 'Trình duyệt web',
            self::OS_PC => 'Myas PC',
        ];
        return ($os == '') ? $list : $list[$os];
    }
}
