<?php

namespace Modules\Admins\Entities;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Vanthao03596\HCVN\Models\District;
use Vanthao03596\HCVN\Models\Province;
use Vanthao03596\HCVN\Models\Ward;

class AdminLead extends Model
{
    use HasFactory;
    protected $table = 'admin_leads';

    protected $fillable = ['province_id', 'district_id', 'ward_id', 'code', 'name', 'avatar', 'phone', 'email', 'address', 'description', 'status', 'created_by', 'assigned_id', 'source', 'converted_at', 'customer_id', 'identity_card', 'tax_code', 'bank_name', 'bank_address', 'bank_branch', 'bank_account_number', 'bank_account_name', 'gender'];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'converted_at' => 'datetime'
    ];

    const STATUS_ACTIVE = 1;
    const STATUS_SUSPEND = 2;

    const SOURCE_REGISTER = 'register';
    const SOURCE_FACEBOOK = 'facebook';
    const SOURCE_ZALO = 'zalo';
    const SOURCE_EMAIL = 'email';
    const SOURCE_CONTACT = 'contact';

    const GENDER_MALE = 1;
    const GENDER_FEMALE = 0;
    const GENDER_OTHER = 2;

    public function province()
    {
        return $this->hasOne(Province::class, 'id', 'province_id');
    }

    public function district()
    {
        return $this->hasOne(District::class, 'id', 'district_id');
    }

    public function ward()
    {
        return $this->hasOne(Ward::class, 'id', 'ward_id');
    }

    public function createdBy()
    {
        return $this->hasOne(Admins::class, 'id', 'created_by');
    }

    public function assigned()
    {
        return $this->hasOne(Admins::class, 'id', 'assigned_id');
    }

    public function customer()
    {
        return $this->hasOne(AdminCustomer::class, 'id', 'customer_id');
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

    public function scopeOfCreated($query, $created_by)
    {
        if (is_array($created_by)) {
            return $query->whereIn('created_by', $created_by);
        }
        return $query->where('created_by', $created_by);
    }

    public function scopeOfAssigned($query, $assigned_id)
    {
        if (is_array($assigned_id)) {
            return $query->whereIn('assigned_id', $assigned_id);
        }
        return $query->where('assigned_id', $assigned_id);
    }

    public function scopeCustomerId($query, $customer_id)
    {
        if (is_array($customer_id)) {
            return $query->whereIn('customer_id', $customer_id);
        }
        return $query->where('customer_id', $customer_id);
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

    public function scopeSource($query, $source)
    {
        if (is_array($source)) {
            return $query->whereIn('source', $source);
        }
        return $query->where('source', $source);
    }

    public function scopeStatus($query, $status)
    {
        if (is_array($status)) {
            return $query->whereIn('status', $status);
        }
        return $query->where('status', $status);
    }

    public function scopeConverted($query)
    {
        return $query->whereHas('customer_id');
    }

    public function scopeNotConvert($query)
    {
        return $query->whereDoesntHave('customer_id');
    }

    public function scopeConvertDate($query, $date)
    {
        $_date = Carbon::parse($date)->format('Y-m-d');
        return $query->whereDate('converted_at', $_date);
    }

    public function scopeConvertBetween($query, $from, $to)
    {
        $_from = Carbon::parse($from)->startOfDay()->format('Y-m-d H:i:s');
        $_to = Carbon::parse($to)->startOfDay()->format('Y-m-d H:i:s');
        return $query->whereBetween('converted_at', [$_from, $_to]);
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

    public static function get_status($id = '')
    {
        $list = [
            self::STATUS_ACTIVE => ['Kích hoạt', COLORS['success'], 'check-circle'],
            self::STATUS_SUSPEND => ['Bị khóa', COLORS['warning'], 'lock-on'],
        ];
        return ($id == '') ? $list : $list[$id];
    }

    public static function get_source($id = '')
    {
        $list = [
            self::SOURCE_REGISTER => ['Tự đăng ký', COLORS['secondary']],
            self::SOURCE_FACEBOOK => ['Facebook', COLORS['info']],
            self::SOURCE_ZALO => ['Zalo', COLORS['success']],
            self::SOURCE_EMAIL => ['Email', COLORS['danger']],
            self::SOURCE_CONTACT => ['Liên hệ trực tiếp', COLORS['warning']],
        ];
        return ($id == '') ? $list : $list[$id];
    }

    public static function get_gender($id = '')
    {
        $list = [
            self::GENDER_MALE => ['Name', COLORS['success']],
            self::GENDER_FEMALE => ['Nữ', COLORS['secondary']],
            self::GENDER_OTHER => ['Khác', COLORS['secondary']],
        ];
        return ($id == '') ? $list : $list[$id];
    }
}
