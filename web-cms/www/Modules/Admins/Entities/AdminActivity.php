<?php

namespace Modules\Admins\Entities;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AdminActivity extends Model
{
    use HasFactory;
    protected $table = 'admin_activities';

    protected $fillable = [
        'permission_id',
        'role_id',
        'admin_id',
        'data_json',
        'description',
        'ip',
        'device',
        'link',
        'status'
    ];

    protected $hidden = [
        'permission_id',
        'role_id',
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
    protected function dataJson(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => (json_decode($value, 1)),
        );
    }

    public function admin()
    {
        return $this->belongsTo(Admins::class, 'admin_id')->withDefault([
            'id' => 0,
            'name' => __('dashboard_admin')
        ]);
    }

    public function permission()
    {
        return $this->belongsTo(AdminPermission::class, 'permission_id');
    }

    public function role()
    {
        return $this->belongsTo(AdminRole::class, 'role_id');
    }

    public function scopePermissionId($query, $permission_id)
    {
        if (is_array($permission_id)) {
            return $query->whereIntegerInRaw('permission_id', $permission_id);
        }
        return $query->where('permission_id', $permission_id);
    }

    public function scopeRoleId($query, $role_id)
    {
        if (is_array($role_id)) {
            return $query->whereIntegerInRaw('role_id', $role_id);
        }
        return $query->where('role_id', $role_id);
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

    public function scopeOfIp($query, $ip)
    {
        if (is_array($ip)) {
            return $query->whereIn('ip', $ip);
        }
        return $query->where('ip', $ip);
    }

    public function scopeOfLink($query, $link)
    {
        return $query->where('link', $link);
    }

    public function scopeOfDevice($query, $device)
    {
        if (is_array($device)) {
            return $query->whereIn('device', $device);
        }
        return $query->where('device', $device);
    }

    public function scopeSearch($query, $search)
    {
        return $query->where(function ($q) use ($search) {
            $q->orWhere('description', 'LIKE', "%$search%")
                ->orWhere('ip', 'LIKE', "%$search%")
                ->orWhere('device', 'LIKE', "%$search%");
        });
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