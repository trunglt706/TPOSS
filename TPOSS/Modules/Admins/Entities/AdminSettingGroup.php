<?php

namespace Modules\Admins\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AdminSettingGroup extends Model
{
    use HasFactory;
    protected $table = 'admin_setting_groups';

    const STATUS_ACTIVE = 1;
    const STATUS_SUSPEND = 2;

    protected $fillable = ['code', 'name', 'description', 'status', 'order'];

    protected $casts = [
        'created_at' => 'datetime',
    ];

    public function settings()
    {
        return $this->hasMany(AdminSetting::class, 'group_id', 'id');
    }

    public function scopeCode($query, $code)
    {
        return $query->where('code', $code);
    }

    public function scopeStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    public function scopeActive($query)
    {
        return $query->where('status', self::STATUS_ACTIVE);
    }

    public static function get_status($id = '')
    {
        $list = [
            self::STATUS_ACTIVE => ['Kích hoạt', COLORS['success'], 'check-circle'],
            self::STATUS_SUSPEND => ['Bị khóa', COLORS['warning'], 'lock-on'],
        ];
        return ($id == '') ? $list : $list[$id];
    }
}
