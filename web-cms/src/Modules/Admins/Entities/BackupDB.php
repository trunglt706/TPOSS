<?php

namespace Modules\Admins\Entities;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BackupDB extends Model
{
    use HasFactory;
    protected $table = 'backup_dbs';

    protected $fillable = [
        'name',
        'description',
        'status',
        'size',
        'link',
        'type',
        'created_by'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    const STATUS_SUCCESS = 1;
    const STATUS_FAILED = 2;

    public function createdBy()
    {
        return $this->hasOne(Admins::class, 'id', 'created_by');
    }

    public function scopeCreatedBy($query, $created_by)
    {
        if (is_array($created_by)) {
            return $query->whereIn('created_by', $created_by);
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

    public function scopeSuccess($query)
    {
        return $query->where('status', self::STATUS_SUCCESS);
    }

    public static function get_status($id = '')
    {
        $list = [
            self::STATUS_SUCCESS => [__('admins::result_status_1'), COLORS['success'], 'check-circle'],
            self::STATUS_FAILED => [__('admins::result_status_0'), COLORS['warning'], 'lock-on'],
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
