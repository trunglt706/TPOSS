<?php

namespace Modules\Admins\Entities;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;
use Modules\Stores\Entities\Stores;
use Nwidart\Modules\Module;

class Admins extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;
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
        'deleted_by',
        'identity_card',
        'tax_code'
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
        'last_login' => 'datetime:Y-m-d H:i:s',
        'last_activity' => 'datetime:Y-m-d H:i:s',
        'birthday' => 'date:Y-m-d',
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
        'expired_date' => 'date:Y-m-d',
        'deleted_at' => 'datetime-m-d H:i:s',
    ];

    protected function identityCard(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => (str_replace(' ', '', $value)),
        );
    }

    protected function code(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => (str_replace(' ', '', $value)),
        );
    }

    protected function taxCode(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => (str_replace(' ', '', $value)),
        );
    }

    protected function root(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => ((bool)$value),
        );
    }

    protected function supper(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => ((bool)$value),
        );
    }

    protected function enableTwoFactory(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => ((bool)$value),
        );
    }

    // relations
    public function group()
    {
        return $this->hasOne(AdminGroup::class, 'id', 'group_id');
    }

    public function activities()
    {
        return $this->hasMany(AdminActivity::class, 'created_by', 'id');
    }

    public function notifications()
    {
        return $this->hasMany(AdminNotification::class, 'admin_id', 'id');
    }

    public function device_token()
    {
        return $this->hasMany(AdminTokenDevice::class, 'created_by', 'id');
    }

    public function orders()
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
        if (Module::has('Stores')) {
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

    public function scopeOfCode($query, $code)
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

    public function scopeActive($query)
    {
        return $query->where('status', self::STATUS_ACTIVE);
    }

    public function scopeSupper($query, $supper)
    {
        return $query->where('supper', $supper);
    }

    public function scopeIsSupper($query)
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

    public function scopeNotDelete($query)
    {
        return $query->where('status', '<>', self::STATUS_DELETED);
    }

    public static function get_status($id = '')
    {
        $list = [
            self::STATUS_UN_ACTIVE => [__('admins::status_0'), COLORS['secondary'], 'slash'],
            self::STATUS_ACTIVE => [__('admins::status_1'), COLORS['success'], 'check-circle'],
            self::STATUS_SUSPEND => [__('admins::status_2'), COLORS['warning'], 'lock-on'],
            self::STATUS_DELETED => [__('admins::status_3'), COLORS['danger'], 'times'],
        ];
        return ($id == '') ? $list : $list[$id];
    }

    public static function get_supper($supper = '')
    {
        $list = [
            self::IS_SUPPER => [__('admins::account_supper_1'), COLORS['success']],
            self::NOT_SUPPER => [__('admins::account_supper_0'), COLORS['secondary']],
        ];
        return ($supper == '') ? $list : $list[$supper];
    }

    public static function get_root($root = '')
    {
        $list = [
            self::NOT_ROOT => [__('admins::account_root_0'), COLORS['secondary']],
            self::IS_ROOT => [__('admins::account_root_1'), COLORS['success']],
        ];
        return ($root == '') ? $list : $list[$root];
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

    public function scopeExpireDate($query, $expired_date)
    {
        $_date = Carbon::parse($expired_date)->format('Y-m-d');
        return $query->where('created_at', $_date);
    }

    public function scopeExpired($query)
    {
        return $query->where('expired_date', '>', Carbon::now()->format('Y-m-d'));
    }

    public static function get_code_default()
    {
        $max = Admins::max('id');
        return 'AD' . sprintf("%'.04d", $max + 1);
    }

    public static function get_password_default()
    {
        return Hash::make('Abc@#123');
    }
}
