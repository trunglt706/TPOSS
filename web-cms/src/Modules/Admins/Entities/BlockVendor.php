<?php

namespace Modules\Admins\Entities;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;

class BlockVendor extends Model
{
    use HasFactory;
    protected $table = 'block_vendors';

    protected $fillable = [
        'type',
        'vendor',
        'created_by'
    ];

    protected $hidden = [
        'created_by',
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];

    protected static function booted()
    {
        static::creating(function ($vendor) {
            $vendor->created_by = Auth::guard(AUTH_ADMIN)->check() ? Auth::guard(AUTH_ADMIN)->user()->id : 0;
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

    protected function vendor(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => (str_replace(' ', '', $value)),
        );
    }

    const TYPE_IP = 'ip';
    const TYPE_DOMAIN = 'domain';

    public function createdBy()
    {
        return $this->hasOne(Admins::class, 'id', 'created_by')->withDefault([
            'id' => 0,
            'name' => __('dashboard_admin')
        ]);
    }

    public function scopeOfCreated($query, $created_by)
    {
        if (is_array($created_by)) {
            return $query->whereIntegerInRaw('created_by', $created_by);
        }
        return $query->where('created_by', $created_by);
    }

    public function scopeOfType($query, $type)
    {
        if (is_array($type)) {
            return $query->whereIn('type', $type);
        }
        return $query->where('type', $type);
    }

    public function scopeOfVendor($query, $vendor)
    {
        if (is_array($vendor)) {
            return $query->whereIn('vendor', $vendor);
        }
        return $query->where('vendor', $vendor);
    }

    public static function get_type($id = '')
    {
        $list = [
            self::TYPE_IP => [__('vendor_type_ip'), COLORS['success']],
            self::TYPE_DOMAIN => [__('vendor_type_domain'), COLORS['danger']],
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

    public function scopeSearch($query, $search)
    {
        return $query->where(function ($q) use ($search) {
            $q->orWhere('vendor', 'LIKE', "%$search%");
        });
    }
}
