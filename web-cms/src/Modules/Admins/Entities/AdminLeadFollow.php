<?php

namespace Modules\Admins\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AdminLeadFollow extends Model
{
    use HasFactory;
    protected $table = 'admin_lead_follows';

    protected $fillable = [
        'admin_id',
        'lead_id'
    ];

    protected $hidden = [
        'admin_id',
        'lead_id'
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];

    public function admin()
    {
        return $this->hasOne(Admins::class, 'id', 'admin_id');
    }

    public function lead()
    {
        return $this->hasOne(AdminLead::class, 'id', 'lead_id');
    }

    public function scopeAdminId($query, $admin_id)
    {
        if (is_array($admin_id)) {
            return $query->whereIntegerInRaw('admin_id', $admin_id);
        }
        return $query->where('admin_id', $admin_id);
    }

    public function scopeLeadId($query, $lead_id)
    {
        if (is_array($lead_id)) {
            return $query->whereIntegerInRaw('lead_id', $lead_id);
        }
        return $query->where('lead_id', $lead_id);
    }
}
