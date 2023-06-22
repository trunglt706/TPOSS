<?php

namespace Modules\Admins\Entities;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AdminPaymentPortal extends Model
{
    use HasFactory;
    protected $table = 'admin_payment_portals';

    protected $fillable = [
        'code',
        'name',
        'description',
        'image',
        'order',
        'version',
        'status',
        'created_by',
        'private',
        'settings',
        'settings_default',
    ];

    protected $hidden = [
        'settings',
        'created_by'
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
        'private' => 'boolean',
    ];

    protected static function booted()
    {
        static::creating(function ($portal) {
            $portal->created_by = Auth::guard(AUTH_ADMIN)->check() ? Auth::guard(AUTH_ADMIN)->user()->id : 0;
            $portal->order = $portal->order ?? self::get_order();
            $portal->status = $portal->status ?? self::STATUS_SUSPEND;
        });

        static::created(function ($model) {
        });

        static::updating(function ($model) {
        });

        static::updated(function ($model) {
        });

        static::deleted(function ($portal) {
            if ($portal->image) Storage::delete($portal->image);
        });
    }

    protected function settings(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => (json_decode($value, 1)),
        );
    }

    protected function settingsDefault(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => (json_decode($value, 1)),
        );
    }

    const STATUS_ACTIVE = 1;
    const STATUS_SUSPEND = 2;

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

    public function scopeStatus($query, $status)
    {
        if (is_array($status)) {
            return $query->whereIn('status', $status);
        }
        return $query->where('status', $status);
    }

    public function scopeOfCode($query, $code)
    {
        if (is_array($code)) {
            return $query->whereIn('code', $code);
        }
        return $query->where('code', $code);
    }

    public function scopeActive($query)
    {
        return $query->where('status', self::STATUS_ACTIVE);
    }

    public function scopePrivate($query, $private)
    {
        return $query->where('private', $private);
    }

    public static function get_status($id = '')
    {
        $list = [
            self::STATUS_ACTIVE => [__('status_1'), COLORS['success'], 'check-circle'],
            self::STATUS_SUSPEND => [__('status_2'), COLORS['warning'], 'lock-on'],
        ];
        return ($id == '') ? $list : $list[$id];
    }

    public static function get_order()
    {
        $max = AdminPaymentPortal::count();
        return $max + 1;
    }

    public function scopeSearch($query, $search)
    {
        return $query->where(function ($q) use ($search) {
            $q->orWhere('code', 'LIKE', "%$search%")
                ->orWhere('name', 'LIKE', "%$search%");
        });
    }
}
