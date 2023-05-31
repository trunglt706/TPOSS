<?php

namespace Modules\Stores\Entities;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Admins\Entities\AdminCustomer;

class Users extends Model
{
    use HasFactory;
    protected $table = 'users';

    protected $fillable = [
        'name',
        'email',
        'password',
        'code',
        'client_id',
        'position_id',
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

    protected $casts = [
        'last_login' => 'datetime',
        'last_activity' => 'datetime',
        'birthday' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'expired_date' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    protected $hidden = [
        'password',
    ];

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

    const WORK_TYPE_SHIFT = 0;
    const WORK_TYPE_FULL = 1;

    public function customer()
    {
        return $this->hasOne(AdminCustomer::class, 'id', 'customer_id');
    }

    public function province()
    {
        return $this->hasOne(Province::class, 'id', 'province_id');
    }

    public function district()
    {
        return $this->hasOne(District::class, 'id', 'district_id');
    }

    public function position()
    {
        return $this->hasOne(Positions::class, 'id', 'position_id');
    }

    public function ward()
    {
        return $this->hasOne(Ward::class, 'id', 'ward_id');
    }

    public function createdBy()
    {
        return $this->hasOne(Admins::class, 'id', 'created_by');
    }

    public function scopeProvinceId($query, $province_id)
    {
        if (is_array($province_id)) {
            return $query->whereIn('province_id', $province_id);
        }
        return $query->where('province_id', $province_id);
    }

    public function scopeDistrictId($query, $district_id)
    {
        if (is_array($district_id)) {
            return $query->whereIn('district_id', $district_id);
        }
        return $query->where('district_id', $district_id);
    }

    public function scopeWardId($query, $ward_id)
    {
        if (is_array($ward_id)) {
            return $query->whereIn('ward_id', $ward_id);
        }
        return $query->where('ward_id', $ward_id);
    }

    public function scopeCustomerId($query, $customer_id)
    {
        if (is_array($customer_id)) {
            return $query->whereIn('customer_id', $customer_id);
        }
        return $query->where('customer_id', $customer_id);
    }

    public function scopeOfCreated($query, $created_by)
    {
        if (is_array($created_by)) {
            return $query->whereIn('created_by', $created_by);
        }
        return $query->where('created_by', $created_by);
    }

    public function scopePhone($query, $phone)
    {
        if (is_array($phone)) {
            return $query->whereIn('phone', $phone);
        }
        return $query->where('phone', $phone);
    }

    public function scopeEmail($query, $email)
    {
        if (is_array($email)) {
            return $query->whereIn('email', $email);
        }
        return $query->where('email', $email);
    }

    public function scopeIdentityCard($query, $identity_card)
    {
        if (is_array($identity_card)) {
            return $query->whereIn('identity_card', $identity_card);
        }
        return $query->where('identity_card', $identity_card);
    }

    public function scopeTaxCode($query, $tax_code)
    {
        if (is_array($tax_code)) {
            return $query->whereIn('tax_code', $tax_code);
        }
        return $query->where('tax_code', $tax_code);
    }

    public function scopeCode($query, $code)
    {
        if (is_array($code)) {
            return $query->whereIn('code', $code);
        }
        return $query->where('code', $code);
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

    public function scopeWorkType($query, $work_type)
    {
        return $query->where('work_type', $work_type);
    }

    public static function get_work_type($id = '')
    {
        $list = [
            self::WORK_TYPE_SHIFT => [__('stores::work_type_0'), COLORS['info']],
            self::WORK_TYPE_FULL => [__('stores::work_type_1'), COLORS['success']],
        ];
        return ($id == '') ? $list : $list[$id];
    }
}
