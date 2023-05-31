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

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];

    protected function ip(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => (str_replace(' ', '', $value)),
        );
    }

    protected function dataJson(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => (json_decode($value, 1)),
        );
    }

    protected function link(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => (route($value)),
        );
    }

    public function admin()
    {
        return $this->hasOne(Admins::class, 'id', 'admin_id');
    }

    public function permission()
    {
        return $this->hasOne(AdminPermission::class, 'id', 'permission_id');
    }

    public function role()
    {
        return $this->hasOne(AdminRole::class, 'id', 'role_id');
    }

    public function scopePermissionId($query, $permission_id)
    {
        if (is_array($permission_id)) {
            return $query->whereIn('permission_id', $permission_id);
        }
        return $query->where('permission_id', $permission_id);
    }

    public function scopeRoleId($query, $role_id)
    {
        if (is_array($role_id)) {
            return $query->whereIn('role_id', $role_id);
        }
        return $query->where('role_id', $role_id);
    }

    public function scopeAdminId($query, $admin_id)
    {
        if (is_array($admin_id)) {
            return $query->whereIn('admin_id', $admin_id);
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

    public function scopeIp($query, $ip)
    {
        if (is_array($ip)) {
            return $query->whereIn('ip', $ip);
        }
        return $query->where('ip', $ip);
    }

    public function scopeLink($query, $link)
    {
        return $query->where('link', $link);
    }

    public function scopeDevice($query, $device)
    {
        if (is_array($device)) {
            return $query->whereIn('device', $device);
        }
        return $query->where('device', $device);
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
