<?php

namespace Modules\Admins\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BackupDB extends Model
{
    use HasFactory;
    protected $table = 'admin_groups';

    protected $fillable = ['name', 'description', 'status', 'size', 'link', 'type', 'created_by'];

    protected $casts = [
        'created_at' => 'datetime',
    ];

    const STATUS_SUCCESS = 1;
    const STATUS_FAILED = 0;

    public function createdBy()
    {
        return $this->hasOne(Admins::class, 'id', 'created_by');
    }

    public function scopeCreatedBy($query, $created_by)
    {
        return $query->where('created_by', $created_by);
    }

    public function scopeStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    public static function get_status($id = '')
    {
        $list = [
            self::STATUS_SUCCESS => ['Thành công', COLORS['success'], 'check-circle'],
            self::STATUS_FAILED => ['Thất bại', COLORS['warning'], 'lock-on'],
        ];
        return ($id == '') ? $list : $list[$id];
    }
}
