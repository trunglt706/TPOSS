<?php

namespace Modules\Admins\Entities;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class AdminSetting extends Model
{
    use HasFactory;
    protected $table = 'admin_settings';

    const TYPE_INPUT = 'input';
    const TYPE_TEXTAREA = 'textarea';
    const TYPE_SELECT = 'select';
    const TYPE_CHECKBOX = 'checkbox';
    const TYPE_RADIO = 'radio';
    const TYPE_FILE = 'file';

    protected $fillable = [
        'permission_id',
        'code',
        'name',
        'description',
        'type',
        'value',
        'data',
        'order',
        'group',
    ];

    protected $hidden = [
        'permission_id',
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];

    protected static function booted()
    {
        static::creating(function ($setting) {
            $setting->order = $setting->order ?? self::get_order($setting->permission_id ?? 0);
            $setting->type = $setting->type ?? self::TYPE_INPUT;
        });

        static::created(function ($model) {
            self::cache_all_setting();
        });

        static::updating(function ($model) {
        });

        static::updated(function ($model) {
            self::cache_all_setting();
        });

        static::deleted(function ($setting) {
            if ($setting->type == self::TYPE_FILE && $setting->value) {
                if ($setting->value) Storage::delete($setting->value);
            }
            self::cache_all_setting();
        });
    }

    protected function order(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => ((int)($value)),
        );
    }

    protected function code(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => (str_replace(' ', '', $value)),
        );
    }

    public function permission()
    {
        return $this->belongsTo(AdminPermission::class, 'permission_id');
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

    public function scopeOfType($query, $type)
    {
        if (is_array($type)) {
            return $query->whereIn('type', $type);
        }
        return $query->where('type', $type);
    }

    public function scopeOfGroup($query, $group)
    {
        if (is_array($group)) {
            return $query->where('group', $group);
        }
        return $query->where('group', $group);
    }

    public function scopeSearch($query, $search)
    {
        return $query->where(function ($q) use ($search) {
            $q->orWhere('code', 'LIKE', "%$search%")
                ->orWhere('name', 'LIKE', "%$search%");
        });
    }

    public static function get_order($permission_id)
    {
        $max = AdminSetting::permissionId($permission_id)->count();
        return $max + 1;
    }

    public static function cache_all_setting()
    {
        Cache::forget('setting_admin');
        return Cache::rememberForever('setting_admin', function () {
            $data_config = AdminSetting::all(['code', 'value']);
            $config_key = [];
            if (!is_null($data_config)) {
                foreach ($data_config as $value) {
                    if (!isset($config_key[$value->code])) {
                        $config_key[$value->code] = $value->value;
                    }
                }
            }
            return $config_key;
        });
    }
}
