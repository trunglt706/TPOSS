<?php

namespace Modules\Partners\Entities;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Admins\Entities\Admins;

class Partners extends Model
{
    use HasFactory;
    protected $table = 'partners';

    protected $fillable = [
        'code',
        'name',
        'logo',
        'phone',
        'email',
        'address',
        'tax_code',
        'created_by',
        'deleted_by',
        'description',
        'status',
    ];

    protected $hidden = [
        'created_by',
        'deleted_by',
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
        'status' => 'boolean',
        'deleted_at' => 'datetime:Y-m-d H:i:s',
    ];

    protected static function booted()
    {
        static::creating(function ($model) {
        });

        static::created(function ($model) {
        });

        static::updating(function ($model) {
        });

        static::updated(function ($model) {
        });

        static::deleted(function ($model) {
        });
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

    protected function phone(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => (get_option('hide-phone-partners', true) ? Str::mask($value, '*', - (strlen($value)), (strlen($value) - 3)) : $value),
        );
    }

    const STATUS_ACTIVE = 1;
    const STATUS_SUSPEND = 2;

    public function createdBy()
    {
        return $this->hasOne(Admins::class, 'id', 'created_by')->withDefault([
            'id' => 0,
            'name' => __('dashboard_admin')
        ]);
    }

    public function deletedBy()
    {
        return $this->hasOne(Admins::class, 'id', 'deleted_by')->withDefault([
            'id' => 0,
            'name' => __('dashboard_admin')
        ]);
    }

    public function domains()
    {
        return $this->hasMany(PartnerDomain::class, 'partner_id', 'id');
    }

    public function licenses()
    {
        return $this->hasMany(PartnerLicense::class, 'partner_id', 'id');
    }

    public function notifications()
    {
        return $this->hasMany(PartnerNotify::class, 'partner_id', 'id');
    }

    public function scopeOfCode($query, $code)
    {
        return $query->where('code', $code);
    }

    public function scopeOfPhone($query, $phone)
    {
        return $query->where('phone', $phone);
    }

    public function scopeOfTaxCode($query, $tax_code)
    {
        return $query->where('tax_code', $tax_code);
    }

    public function scopeOfDeleted($query, $deleted_by)
    {
        if (is_array($deleted_by)) {
            return $query->whereIntegerInRaw('deleted_by', $deleted_by);
        }
        return $query->where('deleted_by', $deleted_by);
    }

    public function scopeOfCreated($query, $created_by)
    {
        if (is_array($created_by)) {
            return $query->whereIntegerInRaw('created_by', $created_by);
        }
        return $query->where('created_by', $created_by);
    }

    public function scopeStatus($query, $status)
    {
        if (is_array($status)) {
            return $query->whereIn('status', $status);
        }
        return $query->where('status', $status);
    }

    public function scopeActive($query)
    {
        return $query->where('status', self::STATUS_ACTIVE);
    }

    public static function get_status($id = '')
    {
        $list = [
            self::STATUS_ACTIVE => [__('status_1'), COLORS['success'], 'check-circle'],
            self::STATUS_SUSPEND => [__('status_2'), COLORS['warning'], 'lock-on'],
        ];
        return ($id == '') ? $list : $list[$id];
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

    public function scopeSearch($query, $search)
    {
        return $query->where(function ($q) use ($search) {
            $q->orWhere('code', 'LIKE', "%$search%")
                ->orWhere('name', 'LIKE', "%$search%")
                ->orWhere('phone', 'LIKE', "%$search%")
                ->orWhere('tax_code', 'LIKE', "%$search%")
                ->orWhere('email', 'LIKE', "%$search%");
        });
    }
}
