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
        'last_active',
        'last_inactive',
    ];

    protected $hidden = [
        'license_id',
        'partner_id',
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
        'last_active' => 'datetime:Y-m-d H:i:s',
        'last_inactive' => 'datetime:Y-m-d H:i:s',
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

    public function license()
    {
        return $this->hasOne(PartnerLicense::class, 'id', 'license_id');
    }

    public function partner()
    {
        return $this->hasOne(Partners::class, 'id', 'partner_id');
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
