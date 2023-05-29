<?php

namespace Modules\Admins\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AdminEmails extends Model
{
    use HasFactory;
    protected $table = 'admin_emails';
    protected $fillable = ['name', 'code', 'content', 'data', 'permission_id', 'created_by', 'updated_at'];

    public function createdBy()
    {
        return $this->hasOne(Admins::class, 'id', 'created_by');
    }

    public function updatedBy()
    {
        return $this->hasOne(Admins::class, 'id', 'updated_by');
    }

    public function permission()
    {
        return $this->hasOne(AdminPermission::class, 'id', 'permission_id');
    }

    public function scopePermissionId($query, $permission_id)
    {
        if (is_array($permission_id)) {
            return $query->whereIn('permission_id', $permission_id);
        }
        return $query->where('permission_id', $permission_id);
    }

    public function scopeCode($query, $code)
    {
        if (is_array($code)) {
            return $query->whereIn('code', $code);
        }
        return $query->where('code', $code);
    }

    public function scopeOfCreated($query, $created_by)
    {
        if (is_array($created_by)) {
            return $query->whereIn('created_by', $created_by);
        }
        return $query->where('created_by', $created_by);
    }

    public function scopeOfUpdated($query, $updated_by)
    {
        if (is_array($updated_by)) {
            return $query->whereIn('updated_by', $updated_by);
        }
        return $query->where('updated_by', $updated_by);
    }
}
