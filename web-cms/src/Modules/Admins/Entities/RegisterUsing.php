<?php

namespace Modules\Admins\Entities;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RegisterUsing extends Model
{
    use HasFactory;
    protected $table = 'register_usings';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'description',
        'status',
        'business_type_id',
        'service_id',
        'lead_id',
        'date_convert',
        'ip',
        'device',
        'verify_code',
        'expired_code'
    ];

    protected $hidden = [
        'business_type_id',
        'service_id',
        'lead_id',
        'verify_code',
        'expired_code'
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
        'expired_code' => 'datetime',
        'date_convert' => 'datetime',
    ];

    protected static function booted()
    {
        static::creating(function ($client) {
            $status = $client->status ?? self::STATUS_WAIT;
            $client->ip = $client->ip ?? get_ip();
            $client->device = $client->device ?? get_device();
            $client->status = $status;

            if ($status == self::STATUS_WAIT) {
                $client->verify_code = generateRandomString(10);
                $client->expired_code = Carbon::now()->addMinutes(15);
            }
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

    protected function ip(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => (str_replace(' ', '', $value)),
        );
    }

    protected function verifyCode(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => (strtoupper($value)),
        );
    }

    const STATUS_WAIT = 0;
    const STATUS_APPROVED = 1;
    const STATUS_REJECTED = 4;

    public function business_type()
    {
        return $this->belongsTo(BusinessType::class, 'business_type_id');
    }

    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }

    public function lead()
    {
        return $this->belongsTo(AdminLead::class, 'lead_id');
    }

    public function scopeOfEmail($query, $email)
    {
        return $query->where('email', $email);
    }

    public function scopeOfPhone($query, $phone)
    {
        return $query->where('phone', $phone);
    }

    public function scopeLeadId($query, $lead_id)
    {
        if (is_array($lead_id)) {
            return $query->whereIntegerInRaw('lead_id', $lead_id);
        }
        return $query->where('lead_id', $lead_id);
    }

    public function scopeServiceId($query, $service_id)
    {
        if (is_array($service_id)) {
            return $query->whereIntegerInRaw('service_id', $service_id);
        }
        return $query->where('service_id', $service_id);
    }

    public function scopeBusinessTypeId($query, $business_type_id)
    {
        if (is_array($business_type_id)) {
            return $query->whereIntegerInRaw('business_type_id', $business_type_id);
        }
        return $query->where('business_type_id', $business_type_id);
    }

    public function scopeStatus($query, $status)
    {
        if (is_array($status)) {
            return $query->whereIn('status', $status);
        }
        return $query->where('status', $status);
    }

    public function scopeOfIp($query, $ip)
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
            self::STATUS_WAIT => [__('admins::order_status_0'), COLORS['secondary']],
            self::STATUS_APPROVED => [__('admins::order_status_1'), COLORS['success']],
            self::STATUS_REJECTED => [__('admins::order_status_4'), COLORS['danger']],
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
