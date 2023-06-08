<?php

namespace Modules\Partners\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Admins\Entities\Admins;

class Partners extends Model
{
    use HasFactory;
    protected $table = 'partners';

    protected $fillable = [
        'code',
        'name',
        'logo',
        'created_by',
        'deleted_by',
        'description',
        'status',
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
        'status' => 'boolean',
        'deleted_at' => 'datetime:Y-m-d H:i:s',
    ];

    const STATUS_ACTIVE = 1;
    const STATUS_SUSPEND = 2;

    public function createdBy()
    {
        return $this->hasOne(Admins::class, 'id', 'created_by');
    }

    public function deletedBy()
    {
        return $this->hasOne(Admins::class, 'id', 'deleted_by');
    }

    public function domains()
    {
        return $this->hasMany(PartnerDomain::class, 'partner_id', 'id');
    }

    public function licenses()
    {
        return $this->hasMany(PartnerLicense::class, 'partner_id', 'id');
    }

    public function notifications()
    {
        return $this->hasMany(PartnerNotify::class, 'partner_id', 'id');
    }

    public function scopeCode($query, $code)
    {
        return $query->where('code', $code);
    }

    public function scopeDeletedBy($query, $deleted_by)
    {
        return $query->where('deleted_by', $deleted_by);
    }

    public function scopeCreatedBy($query, $created_by)
    {
        return $query->where('created_by', $created_by);
    }

    public function scopeStatus($query, $status)
    {
        if (is_array($status)) {
            return $query->whereIn('status', $status);
        }
        return $query->where('status', $status);
    }

    public function scopeActive($query)
    {
        return $query->where('status', self::STATUS_ACTIVE);
    }

    public static function get_status($id = '')
    {
        $list = [
            self::STATUS_ACTIVE => [__('admins::status_1'), COLORS['success'], 'check-circle'],
            self::STATUS_SUSPEND => [__('admins::status_2'), COLORS['warning'], 'lock-on'],
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
