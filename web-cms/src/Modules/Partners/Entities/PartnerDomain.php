<?php

namespace Modules\Partners\Entities;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PartnerDomain extends Model
{
    use HasFactory;
    protected $table = 'partner_domains';

    protected $fillable = [
        'domain',
        'partner_id',
        'description',
        'status',
        'ips'
    ];

    protected $hidden = [
        'partner_id',
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
        'status' => 'boolean',
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

    protected function ips(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => (json_decode($value, 1)),
        );
    }

    public function partner()
    {
        return $this->belongsTo(Partners::class, 'partner_id');
    }

    public function scopeOfDomain($query, $domain)
    {
        return $query->where('domain', $domain);
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
            self::STATUS_ACTIVE => [__('status_1'), COLORS['success'], 'check-circle'],
            self::STATUS_SUSPEND => [__('status_2'), COLORS['warning'], 'lock-on'],
        ];
        return ($id == '') ? $list : $list[$id];
    }

    public function scopeSearchIps($query, $ips)
    {
        if (is_array($ips)) {
            $data = json_encode($ips);
        }
        $data = json_encode([$ips]);
        return $query->whereRaw('JSON_CONTAINS(ips, \'' . $data . '\')');
    }
}
