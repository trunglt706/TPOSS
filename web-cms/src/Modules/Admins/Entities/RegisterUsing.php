<?php

namespace Modules\Admins\Entities;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RegisterUsing extends Model
{
    use HasFactory;
    protected $table = 'admin_groups';

    protected $fillable = ['name', 'email', 'phone', 'address', 'description', 'status', 'type', 'service_id', 'lead_id', 'date_convert', 'ip', 'device', 'verify_code', 'expired_code'];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'expired_code' => 'datetime',
        'date_convert' => 'datetime',
    ];

    const STATUS_WAIT = 0;
    const STATUS_APPROVED = 1;
    const STATUS_REJECTED = 2;

    const TYPE_COFFEE_RESTAURANT = 1;
    const TYPE_HOTEL_KARAOKE_SERVICE = 2;
    const TYPE_RETAIL = 3;
    const TYPE_OTHER = 4;

    public function service()
    {
        return $this->hasOne(Service::class, 'id', 'service_id');
    }

    public function lead_id()
    {
        return $this->hasOne(AdminLead::class, 'id', 'lead_id');
    }

    public function scopeEmail($query, $email)
    {
        return $query->where('email', $email);
    }

    public function scopePhone($query, $phone)
    {
        return $query->where('phone', $phone);
    }

    public function scopeLeadId($query, $lead_id)
    {
        if (is_array($lead_id)) {
            return $query->whereIn('lead_id', $lead_id);
        }
        return $query->where('lead_id', $lead_id);
    }

    public function scopeServiceId($query, $service_id)
    {
        if (is_array($service_id)) {
            return $query->whereIn('service_id', $service_id);
        }
        return $query->where('service_id', $service_id);
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

    public function scopeIp($query, $ip)
    {
        if (is_array($ip)) {
            return $query->whereIn('ip', $ip);
        }
        return $query->where('ip', $ip);
    }

    public function scopeVerifyCode($query, $verify_code)
    {
        return $query->where('verify_code', $verify_code);
    }

    public function scopeExpireTime($query)
    {
        $expired = Carbon::now()->subHour();
        return $query->where('expired_code', '<', $expired);
    }

    public static function get_status($id = '')
    {
        $list = [
            self::STATUS_WAIT => ['Chưa duyệt', COLORS['secondary']],
            self::STATUS_APPROVED => ['Đã duyệt', COLORS['success']],
            self::STATUS_REJECTED => ['Từ chối', COLORS['danger']],
        ];
        return ($id == '') ? $list : $list[$id];
    }

    public static function get_type($id = '')
    {
        $list = [
            self::TYPE_COFFEE_RESTAURANT => ['Coffee, nhà hàng', COLORS['secondary']],
            self::TYPE_HOTEL_KARAOKE_SERVICE => ['Khách sạn, karaoke, dịch vụ', COLORS['success']],
            self::TYPE_RETAIL => ['Bán lẻ', COLORS['info']],
            self::TYPE_OTHER => ['Khác', COLORS['danger']],
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
