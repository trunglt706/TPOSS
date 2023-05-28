<?php

namespace Modules\Admins\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Modules\Stores\Entities\Stores;

class Admins extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = 'admins';

    // status
    const STATUS_UN_ACTIVE = 0;
    const STATUS_ACTIVE = 1;
    const STATUS_SUSPEND = 2;
    const STATUS_DELETED = 3;

    // root
    const IS_ROOT = true;
    const NOT_ROOT = false;

    // enable_two_factory
    const ENABLE_TWO_FACTORY = true;
    const DISABLE_TWO_FACTORY = false;

    // supper
    const IS_SUPPER = true;
    const NOT_SUPPER = false;

    // gender
    const GENDER_MALE = 1;
    const GENDER_FEMALE = 0;
    const GENDER_OTHER = 2;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'code',
        'group_id',
        'phone',
        'gender',
        'address',
        'description',
        'status',
        'root',
        'avatar',
        'supper',
        'last_login',
        'enable_two_factory',
        'birthday',
        'last_activity',
        'expired_date',
        'created_at',
        'created_by',
        'deleted_at',
        'deleted_by'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'last_login' => 'datetime',
        'last_activity' => 'datetime',
        'birthday' => 'date',
        'created_at' => 'datetime',
        'expired_date' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    // relations
    public function group()
    {
        return $this->hasOne(AdminGroup::class, 'id', 'group_id');
    }

    public function activity()
    {
        return $this->hasMany(AdminActivity::class, 'created_by', 'id');
    }

    public function notification()
    {
        return $this->hasMany(AdminNotification::class, 'admin_id', 'id');
    }

    public function device_token()
    {
        return $this->hasMany(AdminTokenDevice::class, 'created_by', 'id');
    }

    public function order()
    {
        return $this->hasMany(AdminOrder::class, 'created_by', 'id');
    }

    public function createdBy()
    {
        return $this->hasOne(Admins::class, 'created_by', 'id');
    }

    public function deletedBy()
    {
        return $this->hasOne(Admins::class, 'deleted_by', 'id');
    }

    public function storeAssigned()
    {
        if (\Module::has('Stores')) {
            return $this->hasMany(Stores::class, 'assigned_id', 'id');
        }
        return null;
    }

    // scope

    public function scopeEmail($query, $email)
    {
        return $query->where('email', $email);
    }

    public function scopePhone($query, $phone)
    {
        return $query->where('phone', $phone);
    }

    public function scopeCode($query, $code)
    {
        return $query->where('code', $code);
    }

    public function scopeGroupId($query, $group_id)
    {
        if (is_array($group_id)) {
            return $query->whereIn('group_id', $group_id);
        }
        return $query->where('group_id', $group_id);
    }

    public function scopeStatus($query, $status)
    {
        if (is_array($status)) {
            return $query->where('status', $status);
        }
        return $query->where('status', $status);
    }

    public function scopeSupper($query, $supper)
    {
        return $query->where('supper', $supper);
    }

    public function scopeInSupper($query)
    {
        return $query->where('supper', self::IS_SUPPER);
    }

    public function scopeRoot($query, $root)
    {
        return $query->where('root', $root);
    }

    public function scopeIsRoot($query)
    {
        return $query->where('root', self::IS_ROOT);
    }

    public static function get_status($id = '')
    {
        $list = [
            self::STATUS_UN_ACTIVE => ['Chưa kích hoạt', COLORS['secondary'], 'slash'],
            self::STATUS_ACTIVE => ['Kích hoạt', COLORS['success'], 'check-circle'],
            self::STATUS_SUSPEND => ['Bị khóa', COLORS['warning'], 'lock-on'],
            self::STATUS_SUSPEND => ['Đã xóa', COLORS['danger'], 'times'],
        ];
        return ($id == '') ? $list : $list[$id];
    }

    public static function get_supper($supper = '')
    {
        $list = [
            self::NOT_SUPPER => ['Tài khoản toàn quyền', COLORS['success']],
            self::IS_SUPPER => ['Tài khoản thường', COLORS['secondary']],
        ];
        return ($supper == '') ? $list : $list[$supper];
    }

    public static function get_root($root = '')
    {
        $list = [
            self::NOT_ROOT => ['Tài khoản tạo mới', COLORS['secondary']],
            self::IS_ROOT => ['Tài gốc', COLORS['success']],
        ];
        return ($root == '') ? $list : $list[$root];
    }
}