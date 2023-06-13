<?php

namespace Modules\Admins\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;

class AdminEmails extends Model
{
    use HasFactory;
    protected $table = 'admin_emails';
    protected $fillable = [
        'name',
        'code',
        'content',
        'data',
        'permission_id',
        'created_by',
        'updated_by'
    ];

    protected $hidden = [
        'permission_id',
        'created_by',
        'updated_by'
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];

    protected static function booted()
    {
        static::creating(function ($email) {
            $email->created_by = Auth::guard(AUTH_ADMIN)->check() ? Auth::guard(AUTH_ADMIN)->user()->id : 0;
        });

        static::created(function ($model) {
        });

        static::updating(function ($email) {
            $email->updated_by = Auth::guard(AUTH_ADMIN)->check() ? Auth::guard(AUTH_ADMIN)->user()->id : 0;
        });

        static::updated(function ($model) {
        });

        static::deleted(function ($model) {
        });
    }

    public function createdBy()
    {
        return $this->hasOne(Admins::class, 'id', 'created_by')->withDefault([
            'id' => 0,
            'name' => __('dashboard_admin')
        ]);
    }

    public function updatedBy()
    {
        return $this->hasOne(Admins::class, 'id', 'updated_by')->withDefault([
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

    public function scopeOfCode($query, $code)
    {
        if (is_array($code)) {
            return $query->whereIn('code', $code);
        }
        return $query->where('code', $code);
    }

    public function scopeOfCreated($query, $created_by)
    {
        if (is_array($created_by)) {
            return $query->whereIntegerInRaw('created_by', $created_by);
        }
        return $query->where('created_by', $created_by);
    }

    public function scopeOfUpdated($query, $updated_by)
    {
        if (is_array($updated_by)) {
            return $query->whereIntegerInRaw('updated_by', $updated_by);
        }
        return $query->where('updated_by', $updated_by);
    }
}
