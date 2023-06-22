<?php

namespace Modules\Partners\Entities;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PartnerNotify extends Model
{
    use HasFactory;
    protected $table = 'partner_notifies';

    protected $fillable = [
        'partner_id',
        'content',
        'ip',
        'refType',
        'refTo'
    ];

    protected $hidden = ['partner_id'];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
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

    const TYPE_EMAIL = 'email';
    const TYPE_NOTIFY = 'notify';

    public function partner()
    {
        return $this->belongsTo(Partners::class, 'partner_id');
    }

    public function scopePartnerId($query, $partner_id)
    {
        if (is_array($partner_id)) {
            return $query->whereIntegerInRaw('partner_id', $partner_id);
        }
        return $query->where('partner_id', $partner_id);
    }

    public function scopeOfIp($query, $ip)
    {
        return $query->where('ip', $ip);
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

    public function scopeSearch($query, $search)
    {
        return $query->where(function ($q) use ($search) {
            $q->orWhere('content', 'LIKE', "%$search%")
                ->orWhere('ip', 'LIKE', "%$search%");
        });
    }
}