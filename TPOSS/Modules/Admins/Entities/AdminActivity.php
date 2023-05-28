<?php

namespace Modules\Admins\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AdminActivity extends Model
{
    use HasFactory;
    protected $table = 'admin_activities';

    protected $fillable = ['permission_id', 'role_id', 'admin_id', 'data_json', 'description', 'ip', 'device', 'link', 'status'];

    protected $casts = [
        'created_at' => 'datetime',
    ];

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
        return $query->where('permission_id', $permission_id);
    }

    public function scopeRoleId($query, $role_id)
    {
        return $query->where('role_id', $role_id);
    }

    public function scopeAdminId($query, $admin_id)
    {
        return $query->where('admin_id', $admin_id);
    }

    public function scopeStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    public function scopeIp($query, $ip)
    {
        return $query->where('ip', $ip);
    }

    public function scopeLink($query, $link)
    {
        return $query->where('link', $link);
    }

    public function scopeDevice($query, $device)
    {
        return $query->where('device', $device);
    }
}
