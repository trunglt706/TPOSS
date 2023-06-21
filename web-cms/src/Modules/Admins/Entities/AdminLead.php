<?php

namespace Modules\Admins\Entities;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Vanthao03596\HCVN\Models\District;
use Vanthao03596\HCVN\Models\Province;
use Vanthao03596\HCVN\Models\Ward;
use Illuminate\Support\Str;

class AdminLead extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'admin_leads';

    protected $fillable = [
        'province_id',
        'service_id',
        'district_id',
        'ward_id',
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
        'source',
        'converted_at',
        'customer_id',
        'identity_card',
        'tax_code',
        'bank_name',
        'bank_address',
        'bank_branch',
        'bank_account_number',
        'bank_account_name',
        'gender',
    ];

    protected $hidden = [
        'created_by',
        'province_id',
        'service_id',
        'district_id',
        'ward_id',
        'created_by',
        'assigned_id',
        'customer_id',
        'identity_card',
        'tax_code',
        'bank_name',
        'bank_address',
        'bank_branch',
        'bank_account_number',
        'bank_account_name',
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
        'converted_at' => 'datetime:Y-m-d H:i:s',
        'birthday' => 'date:Y-m-d',
    ];

    protected static function booted()
    {
        static::creating(function ($lead) {
            $lead->created_by = Auth::guard(AUTH_ADMIN)->check() ? Auth::guard(AUTH_ADMIN)->user()->id : 0;
            $lead->code = $lead->code ?? self::get_code_default();
            $lead->gender = $lead->gender ?? self::GENDER_OTHER;
            $lead->status = $lead->status ?? self::STATUS_ACTIVE;

            // check assigned from config
            $lead->assigned_id = get_option('lead-assigned-default', 0);
        });

        static::created(function ($model) {
        });

        static::updating(function ($model) {
        });

        static::updated(function ($model) {
        });

        static::deleted(function ($lead) {
            $lead->deleted_by = Auth::guard(AUTH_ADMIN)->check() ? Auth::guard(AUTH_ADMIN)->user()->id : 0;
            // check and delete avatar in s3
            if ($lead->avatar) Storage::delete($lead->avatar);
        });
    }

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
            get: fn (string $value) => (get_option('hide-phone-lead', true) ? Str::mask($value, '*', - (strlen($value)), (strlen($value) - 3)) : $value),
        );
    }

    const STATUS_ACTIVE = 1;
    const STATUS_SUSPEND = 2;

    const SOURCE_REGISTER = 'register';
    const SOURCE_FACEBOOK = 'facebook';
    const SOURCE_ZALO = 'zalo';
    const SOURCE_EMAIL = 'email';
    const SOURCE_CONTACT = 'contact';
    const SOURCE_OTHER = 'other';

    const GENDER_MALE = 1;
    const GENDER_FEMALE = 0;
    const GENDER_OTHER = 2;

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

    public function customer()
    {
        return $this->hasOne(AdminCustomer::class, 'id', 'customer_id');
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

    public function scopeCustomerId($query, $customer_id)
    {
        if (is_array($customer_id)) {
            return $query->whereIntegerInRaw('customer_id', $customer_id);
        }
        return $query->where('customer_id', $customer_id);
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

    public function scopeOfSource($query, $source)
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
        return $query->has('customer');
    }

    public function scopeNotConvert($query)
    {
        return $query->doesntHave('customer');
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
            self::STATUS_ACTIVE => [__('admins.status_1'), COLORS['success'], 'check-circle'],
            self::STATUS_SUSPEND => [__('admins.status_2'), COLORS['warning'], 'lock-on'],
        ];
        return ($id == '') ? $list : $list[$id];
    }

    public static function get_source($id = '')
    {
        $list = [
            self::SOURCE_REGISTER => [__('admins.source_lead_register'), COLORS['secondary']],
            self::SOURCE_FACEBOOK => [__('admins.source_lead_facebook'), COLORS['info']],
            self::SOURCE_ZALO => [__('admins.source_lead_zalo'), COLORS['success']],
            self::SOURCE_EMAIL => [__('admins.source_lead_email'), COLORS['danger']],
            self::SOURCE_CONTACT => [__('admins.source_lead_contact'), COLORS['warning']],
            self::SOURCE_OTHER => [__('admins.source_lead_other'), COLORS['dark']],
        ];
        return ($id == '') ? $list : $list[$id];
    }

    public static function get_gender($id = '')
    {
        $list = [
            self::GENDER_FEMALE => [__('gender_0'), COLORS['secondary']],
            self::GENDER_MALE => [__('gender_1'), COLORS['success']],
            self::GENDER_OTHER => [__('gender_2'), COLORS['secondary']],
        ];
        return ($id == '') ? $list : $list[$id];
    }

    public static function get_code_default()
    {
        $max = AdminLead::max('id');
        return 'AL' . sprintf("%'.04d", $max + 1);
    }

    public function scopeSearch($query, $search)
    {
        return $query->where(function ($q) use ($search) {
            $q->orWhere('code', 'LIKE', "%$search%")
            ->orWhere('name', 'LIKE', "%$search%")
            ->orWhere('email', 'LIKE', "%$search%")
            ->orWhere('phone', 'LIKE', "%$search%");
        });
    }
}
