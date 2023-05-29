<?php

namespace Modules\Admins\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AdminSetting extends Model
{
    use HasFactory;
    protected $table = 'admin_settings';

    const TYPE_INPUT = 'input';
    const TYPE_TEXTAREA = 'textarea';
    const TYPE_SELECT = 'select';
    const TYPE_CHECKBOX = 'checkbox';
    const TYPE_RADIO = 'radio';

    protected $fillable = ['group_id', 'code', 'name', 'description', 'type', 'value', 'data', 'order'];

    protected $casts = [
        'created_at' => 'datetime',
    ];

    public function group()
    {
        return $this->hasOne(AdminSettingGroup::class, 'id', 'group_id');
    }

    public function scopeGroupId($query, $group_id)
    {
        if (is_array($group_id)) {
            return $query->whereIn('group_id', $group_id);
        }
        return $query->where('group_id', $group_id);
    }

    public function scopeCode($query, $code)
    {
        if (-is_array($code)) {
            return $query->whereIn('code', $code);
        }
        return $query->where('code', $code);
    }

    public function scopeType($query, $type)
    {
        if (is_array($type)) {
            return $query->whereIn('type', $type);
        }
        return $query->where('type', $type);
    }
}
