<?php

namespace Modules\Admins\Entities;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class AdminCustomerPayment extends Model
{
    use HasFactory;
    protected $table = 'admin_customer_invoices';

    protected $fillable = [
        'customer_id',
        'type',
        'name',
        'phone',
        'account_bank',
        'address_bank',
        'name_bank',
        'other'
    ];

    const TYPE_ATM = 'ATM';
    const TYPE_CC = 'CC';
    const TYPE_EWALLET = 'EWALLET';

    protected $hidden = [
        'customer_id',
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
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

    protected function accountBank(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => (str_replace(' ', '', $value)),
        );
    }

    protected function other(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => (json_decode($value, 1)),
        );
    }

    protected function phone(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => (get_option('hide-phone-customer', true) ? Str::mask($value, '*', - (strlen($value)), (strlen($value) - 3)) : $value),
        );
    }

    public function customer()
    {
        return $this->belongsTo(AdminCustomer::class, 'customer_id');
    }

    public function scopeClientId($query, $client_id)
    {
        if (is_array($client_id)) {
            return $query->whereIn('client_id', $client_id);
        }
        return $query->where('client_id', $client_id);
    }

    public function scopeAccountBank($query, $account_bank)
    {
        if (is_array($account_bank)) {
            return $query->whereIn('account_bank', $account_bank);
        }
        return $query->where('account_bank', $account_bank);
    }

    public function scopeType($query, $type)
    {
        if (is_array($type)) {
            return $query->whereIn('type', $type);
        }
        return $query->where('type', $type);
    }

    public static function get_type($id = '')
    {
        $list = [
            self::TYPE_ATM => [__('payment_type_'), COLORS['success'], 'credit-card'],
            self::TYPE_CC => [__('payment_type_'), COLORS['warning'], 'cc-visa'],
            self::TYPE_EWALLET => [__('payment_type_'), COLORS['info'], 'wallet'],
        ];
        return ($id == '') ? $list : $list[$id];
    }
}
