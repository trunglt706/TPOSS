<?php

namespace Modules\Partners\Entities;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PartnerHistory extends Model
{
    use HasFactory;
    protected $table = 'partner_histories';

    protected $fillable = [
        'license_id',
        'partner_id',
        'max_customers',
        'max_leads',
        'max_stores',
        'status'
    ];

    protected $hidden = [
        'license_id',
        'partner_id',
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
        'status' => 'boolean',
        'max_customers' => 'integer',
        'max_leads' => 'integer',
        'max_stores' => 'integer',
    ];

    protected static function booted()
    {
        static::creating(function ($model) {
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

    const STATUS_ACTIVE = 1;
    const STATUS_SUSPEND = 2;

    public function license()
    {
        return $this->belongsTo(PartnerLicense::class, 'license_id');
    }

    public function partner()
    {
        return $this->belongsTo(Partners::class, 'partner_id');
    }

    public function scopeLicenseId($query, $license_id)
    {
        if (is_array($license_id)) {
            return $query->whereIntegerInRaw('license_id', $license_id);
        }
        return $query->where('license_id', $license_id);
    }

    public function scopePartnerId($query, $partner_id)
    {
        if (is_array($partner_id)) {
            return $query->whereIntegerInRaw('partner_id', $partner_id);
        }
        return $query->where('partner_id', $partner_id);
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
            self::STATUS_ACTIVE => [__('partners::status_1'), COLORS['success'], 'check-circle'],
            self::STATUS_SUSPEND => [__('partners::status_2'), COLORS['warning'], 'lock-on'],
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
