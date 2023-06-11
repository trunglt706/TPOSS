<?php

namespace Modules\Admins\Entities;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AdminNotification extends Model
{
    use HasFactory;
    protected $table = 'admin_activities';

    protected $fillable = [
        'permission_id',
        'admin_id',
        'description',
        'link',
        'status'
    ];

    protected $hidden = [
        'permission_id',
        'admin_id',
    ];

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

    protected function order(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => (route($value)),
        );
    }

    const VIEWED = 1;
    const NOT_VIEW = 2;

    public function admin()
    {
        return $this->hasOne(Admins::class, 'id', 'admin_id')->withDefault([
            'id' => 0,
            'name' => __('dashboard_admin')
        ]);
    }

    public function permission()
    {
        return $this->hasOne(AdminPermission::class, 'id', 'permission_id');
    }

    public function scopePermissionId($query, $permission_id)
    {
        if (is_array($permission_id)) {
            return $query->whereIntegerInRaw('permission_id', $permission_id);
        }
        return $query->where('permission_id', $permission_id);
    }

    public function scopeAdminId($query, $admin_id)
    {
        if (is_array($admin_id)) {
            return $query->whereIntegerInRaw('admin_id', $admin_id);
        }
        return $query->where('admin_id', $admin_id);
    }

    public function scopeStatus($query, $status)
    {
        if (is_array($status)) {
            return $query->whereIn('status', $status);
        }
        return $query->where('status', $status);
    }

    public function scopeViewed($query)
    {
        return $query->where('status', self::VIEWED);
    }

    public function scopeLink($query, $link)
    {
        return $query->where('link', $link);
    }

    public static function get_status($id = '')
    {
        $list = [
            self::VIEWED => [__('admins::view_status_1'), COLORS['secondary']],
            self::NOT_VIEW => [__('admins::view_status_2'), COLORS['dark']],
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
