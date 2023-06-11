<?php

namespace Modules\Stores\Entities;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Admins\Entities\AdminCustomer;
use Modules\Admins\Entities\Admins;
use Modules\Admins\Entities\AdminServiceUsingStore;
use Vanthao03596\HCVN\Models\District;
use Vanthao03596\HCVN\Models\Province;
use Vanthao03596\HCVN\Models\Ward;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Stores extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'stores';

    protected $fillable = [
        'province_id',
        'business_type_id',
        'district_id',
        'ward_id',
        'admin_area_id',
        'area_id',
        'service_id',
        'assigned_id',
        'customer_id',
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

    protected $hidden = [
        'province_id',
        'business_type_id',
        'district_id',
        'ward_id',
        'admin_area_id',
        'area_id',
        'service_id',
        'assigned_id',
        'customer_id',
        'created_by',
        'tax_code',
        'longitude',
        'latitude'
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];

    protected static function booted()
    {
        static::creating(function ($store) {
            $store->created_by = Auth::guard('admin')->check() ? Auth::guard('admin')->user()->id : 0;
            $store->code = $store->code ?? self::get_code_default();
            $store->status = $store->status ?? self::STATUS_UN_ACTIVE;
            if (!$store->currency) {
                $store->currency = get_option('currency-default', self::CURRENCY_VN);
            }
            if (!$store->admin_area_id) {
                $store->admin_area_id = get_option('admin-area-default');
            }
            if (!$store->assigned_id) {
                $customer = AdminCustomer::find($store->customer_id ?? 0);
                if ($customer) {
                    $store->assigned_id = $customer->assigned_id ?? 0;
                } else {
                    $store->assigned_id = get_option('store-assigned-default');
                }
            }
        });

        static::created(function ($model) {
        });

        static::updating(function ($model) {
        });

        static::updated(function ($model) {
        });

        static::deleted(function ($model) {
            if($model->logo) Storage::delete($model->logo);
        });
    }

    const STATUS_UN_ACTIVE = 0;
    const STATUS_ACTIVE = 1;
    const STATUS_SUSPEND = 2;
    const STATUS_DELETED = 3;

    const CURRENCY_VN = 'vnd';
    const CURRENCY_USD = 'usd';

    protected function phone(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => (get_option('hide-phone-customer', true) ? Str::mask($value, '*', - (strlen($value)), (strlen($value) - 3)) : $value),
        );
    }

    public function customer()
    {
        return $this->hasOne(AdminCustomer::class, 'id', 'customer_id');
    }

    public function service_usings()
    {
        return $this->hasMany(AdminServiceUsingStore::class, 'store_id', 'id');
    }

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
        return $this->hasOne(Admins::class, 'id', 'created_by')->withDefault([
            'id' => 0,
            'name' => __('dashboard_admin')
        ]);
    }

    public function scopeServiceId($query, $service_id)
    {
        if (is_array($service_id)) {
            return $query->whereIntegerInRaw('service_id', $service_id);
        }
        return $query->where('service_id', $service_id);
    }

    public function scopeProvinceId($query, $province_id)
    {
        if (is_array($province_id)) {
            return $query->whereIntegerInRaw('province_id', $province_id);
        }
        return $query->where('province_id', $province_id);
    }

    public function scopeDistrictId($query, $district_id)
    {
        if (is_array($district_id)) {
            return $query->whereIntegerInRaw('district_id', $district_id);
        }
        return $query->where('district_id', $district_id);
    }

    public function scopeWardId($query, $ward_id)
    {
        if (is_array($ward_id)) {
            return $query->whereIntegerInRaw('ward_id', $ward_id);
        }
        return $query->where('ward_id', $ward_id);
    }

    public function scopeCustomerId($query, $customer_id)
    {
        if (is_array($customer_id)) {
            return $query->whereIntegerInRaw('customer_id', $customer_id);
        }
        return $query->where('customer_id', $customer_id);
    }

    public function scopeOfCreated($query, $created_by)
    {
        if (is_array($created_by)) {
            return $query->whereIntegerInRaw('created_by', $created_by);
        }
        return $query->where('created_by', $created_by);
    }

    public function scopeOfPhone($query, $phone)
    {
        if (is_array($phone)) {
            return $query->whereIn('phone', $phone);
        }
        return $query->where('phone', $phone);
    }

    public function scopeOfEmail($query, $email)
    {
        if (is_array($email)) {
            return $query->whereIn('email', $email);
        }
        return $query->where('email', $email);
    }

    public function scopeOfIdentityCard($query, $identity_card)
    {
        if (is_array($identity_card)) {
            return $query->whereIn('identity_card', $identity_card);
        }
        return $query->where('identity_card', $identity_card);
    }

    public function scopeOfTaxCode($query, $tax_code)
    {
        if (is_array($tax_code)) {
            return $query->whereIn('tax_code', $tax_code);
        }
        return $query->where('tax_code', $tax_code);
    }

    public function scopeOfCode($query, $code)
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

    public static function get_code_default()
    {
        $max = Stores::max('id');
        return 'ST' . sprintf("%'.04d", $max + 1);
    }
}
