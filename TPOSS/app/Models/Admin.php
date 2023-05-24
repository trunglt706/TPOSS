<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Admin extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    // status
    const STATUS_UN_ACTIVE = 0;
    const STATUS_ACTIVE = 1;
    const STATUS_SUSPEND = 2;

    // root
    const ROOT_ACCOUNT = true;
    const NOT_ROOT = false;

    // enable_two_factory
    const ENABLE_TWO_FACTORY = true;
    const DISABLE_TWO_FACTORY = false;

    // supper
    const SUPPER_ACCOUNT = true;
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
        'created_at'
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

    public function scopeRoot($query, $root)
    {
        return $query->where('root', $root);
    }

    public static function get_status($id = '')
    {
        $list = [
            self::STATUS_NOT_ACTIVE => ['Chưa kích hoạt', COLORS['secondary'], 'slash'],
            self::STATUS_ACTIVE => ['Kích hoạt', COLORS['success'], 'check-circle'],
            self::STATUS_SUSPEND => ['Bị khóa', COLORS['danger'], 'lock-on']
        ];
        return ($id == '') ? $list : $list[$id];
    }

    public static function get_supper($supper = '')
    {
        $list = [
            self::NOT_SUPPER => 'Thường',
            self::SUPPER => 'VIP'
        ];
        return ($supper == '') ? $list : $list[$supper];
    }
}
