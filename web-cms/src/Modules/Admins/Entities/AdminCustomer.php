<?php

namespace Modules\Admins\Entities;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Modules\Stores\Entities\Stores;
use Vanthao03596\HCVN\Models\District;
use Vanthao03596\HCVN\Models\Province;
use Vanthao03596\HCVN\Models\Ward;
use Illuminate\Support\Str;

class AdminCustomer extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'admin_customers';

    protected $fillable = [
        'province_id',
        'business_type_id',
        'service_id',
        'type',
        'district_id',
        'ward_id',
        'area_id',
        'code',
        'name',
        'avatar',
        'phone',
        'email',
        'birthday',
        'address',
        'description',
        'status',
        'created_by',
        'assigned_id',
        'identity_card',
        'tax_code',
        'bank_name',
        'bank_address',
        'bank_branch',
        'bank_account_number',
        'bank_account_name',
        'gender',
        'currency',
        'website',
        'longitude',
        'latitude'
    ];

    protected $hidden = [
        'province_id',
        'business_type_id',
        'service_id',
        'district_id',
        'ward_id',
        'area_id',
        'created_by',
        'assigned_id',
        'identity_card',
        'tax_code',
        'bank_name',
        'bank_address',
        'bank_branch',
        'bank_account_number',
        'bank_account_name',
        'longitude',
        'latitude'
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
        'birthday' => 'date:Y-m-d',
    ];

    protected static function booted()
    {
        static::creating(function ($customer) {
            $customer->created_by = Auth::guard(AUTH_ADMIN)->check() ? Auth::guard(AUTH_ADMIN)->user()->id : 0;
            $customer->code = $customer->code ?? self::get_code_default();
            $customer->gender = $customer->gender ?? AdminLead::GENDER_OTHER;
            $customer->status = $customer->status ?? self::STATUS_ACTIVE;
            $customer->type = $customer->type ?? self::TYPE_OLD;

            // check assigned from config
            $customer->assigned_id = get_option('customer-assigned-default', 0);
            if (!$customer->currency) {
                $customer->currency = get_option('currency-default', self::CURRENCY_VN);
            }
            if (!$customer->area_id) {
                $customer->area_id = get_option('admin-area-default');
            }
        });

        static::created(function ($model) {
        });

        static::updating(function ($model) {
        });

        static::updated(function ($model) {
        });

        static::deleted(function ($customer) {
            $customer->deleted_by = Auth::guard(AUTH_ADMIN)->check() ? Auth::guard(AUTH_ADMIN)->user()->id : 0;
            // check and delete avatar in s3
            if ($customer->avatar) Storage::delete($customer->avatar);
        });
    }

    const CURRENCY_VN = 'vnd';
    const CURRENCY_USD = 'usd';

    protected function code(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => (str_replace(' ', '', $value)),
        );
    }

    protected function identityCard(): Attribute
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

    protected function bankAccountNumber(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => (str_replace(' ', '', $value)),
        );
    }

    protected function phone(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => (get_option('hide-phone-customer', true) ? Str::mask($value, '*', - (strlen($value)), (strlen($value) - 3)) : $value),
        );
    }

    const STATUS_ACTIVE = 1;
    const STATUS_SUSPEND = 2;

    const TYPE_GROUP = 1;
    const TYPE_OLD = 0;

    public function info_invoices()
    {
        return $this->hasMany(AdminCustomerInvoice::class, 'customer_id', 'id');
    }

    public function info_payments()
    {
        return $this->hasMany(AdminCustomerPayment::class, 'customer_id', 'id');
    }

    public function area()
    {
        return $this->belongsTo(Area::class, 'area_id');
    }

    public function stores()
    {
        return $this->hasMany(Stores::class, 'customer_id', 'id');
    }

    public function business_type()
    {
        return $this->hasOne(BusinessType::class, 'id', 'business_type_id');
    }

    public function service()
    {
        return $this->hasOne(Service::class, 'id', 'service_id');
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

    public function assigned()
    {
        return $this->hasOne(Admins::class, 'id', 'assigned_id')->withDefault([
            'id' => 0,
            'name' => __('no_selected')
        ]);
    }

    public function scopeAreaId($query, $area_id)
    {
        if (is_array($area_id)) {
            return $query->whereIntegerInRaw('area_id', $area_id);
        }
        return $query->where('service_id', $area_id);
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

    public function scopeOfCreated($query, $created_by)
    {
        if (is_array($created_by)) {
            return $query->whereIntegerInRaw('created_by', $created_by);
        }
        return $query->where('created_by', $created_by);
    }

    public function scopeOfAssigned($query, $assigned_id)
    {
        if (is_array($assigned_id)) {
            return $query->whereIntegerInRaw('assigned_id', $assigned_id);
        }
        return $query->where('assigned_id', $assigned_id);
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

    public function scopeOfType($query, $type)
    {
        if (is_array($type)) {
            return $query->whereIn('type', $type);
        }
        return $query->where('type', $type);
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
            self::STATUS_ACTIVE => [__('status_1'), COLORS['success'], 'check-circle'],
            self::STATUS_SUSPEND => [__('status_2'), COLORS['warning'], 'lock-on'],
        ];
        return ($id == '') ? $list : $list[$id];
    }

    public static function get_type($id = '')
    {
        $list = [
            self::TYPE_GROUP => [__('customer_type_1'), COLORS['success'], 'building'],
            self::TYPE_OLD => [__('customer_type_0'), COLORS['info'], 'store'],
        ];
        return ($id == '') ? $list : $list[$id];
    }

    public static function get_code_default()
    {
        $max = AdminCustomer::max('id');
        return 'AC' . sprintf("%'.04d", $max + 1);
    }

    public static function get_currency($id = '')
    {
        $list = [
            self::CURRENCY_VN => [__('currency_vnd'), COLORS['secondary'], 'vnd'],
            self::CURRENCY_USD => [__('currency_usd'), COLORS['success'], 'usd'],
        ];
        return ($id == '') ? $list : $list[$id];
    }

    public function scopeSearch($query, $search)
    {
        return $query->where(function ($q) use ($search) {
            $q->orWhere('name', 'LIKE', "%$search%")
                ->orWhere('code', 'LIKE', "%$search%")
                ->orWhere('phone', 'LIKE', "%$search%")
                ->orWhere('identity_card', 'LIKE', "%$search%")
                ->orWhere('tax_code', 'LIKE', "%$search%");
        });
    }
}
