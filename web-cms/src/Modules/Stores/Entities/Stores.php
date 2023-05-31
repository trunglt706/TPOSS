<?php

namespace Modules\Stores\Entities;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Admins\Entities\Admins;
use Vanthao03596\HCVN\Models\District;
use Vanthao03596\HCVN\Models\Province;
use Vanthao03596\HCVN\Models\Ward;

class Stores extends Model
{
    use HasFactory;
    protected $table = 'stores';

    protected $fillable = [
        'province_id',
        'business_type_id',
        'district_id',
        'ward_id',
        'area_id',
        'service_id',
        'assigned_id',
        'code',
        'name',
        'logo',
        'phone',
        'email',
        'address',
        'description',
        'status',
        'created_by',
        'currency',
        'tax_code',
        'website',
        'longitude',
        'latitude'
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];

    const STATUS_UN_ACTIVE = 0;
    const STATUS_ACTIVE = 1;
    const STATUS_SUSPEND = 2;
    const STATUS_DELETED = 3;

    const CURRENCY_VN = 'vnd';
    const CURRENCY_USD = 'usd';

    public function business_type()
    {
        return $this->hasOne(BusinessType::class, 'id', 'business_type_id');
    }

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

    public function scopeServiceId($query, $service_id)
    {
        if (is_array($service_id)) {
            return $query->whereIn('service_id', $service_id);
        }
        return $query->where('service_id', $service_id);
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

    public function scopeStatus($query, $status)
    {
        if (is_array($status)) {
            return $query->whereIn('status', $status);
        }
        return $query->where('status', $status);
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
            self::STATUS_UN_ACTIVE => [__('stores::status_0'), COLORS['secondary'], 'slash'],
            self::STATUS_ACTIVE => [__('stores::status_1'), COLORS['success'], 'check-circle'],
            self::STATUS_SUSPEND => [__('stores::status_2'), COLORS['warning'], 'lock-on'],
            self::STATUS_DELETED => [__('stores::status_3'), COLORS['danger'], 'times'],
        ];
        return ($id == '') ? $list : $list[$id];
    }

    public static function get_currency($id = '')
    {
        $list = [
            self::CURRENCY_VN => [__('stores::currency_vnd'), COLORS['secondary'], 'vnd'],
            self::CURRENCY_USD => [__('stores::currency_usd'), COLORS['success'], 'usd'],
        ];
        return ($id == '') ? $list : $list[$id];
    }
}
