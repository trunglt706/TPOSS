<?php

namespace Modules\Admins\Entities;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AdminCustomerInvoice extends Model
{
    use HasFactory;
    protected $table = 'admin_customer_invoices';

    protected $fillable = [
        'customer_id',
        'type',
        'name',
        'company',
        'address',
        'tax_code',
        'account_number',
        'id_card',
        'other'
    ];

    const TYPE_PERSONAL = 'personal';
    const TYPE_COMPANY = 'company';

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

    protected function other(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => (json_decode($value, 1)),
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

    public function scopeTaxCode($query, $tax_code)
    {
        if (is_array($tax_code)) {
            return $query->whereIn('tax_code', $tax_code);
        }
        return $query->where('tax_code', $tax_code);
    }

    public function scopeAccountNumber($query, $account_number)
    {
        if (is_array($account_number)) {
            return $query->whereIn('account_number', $account_number);
        }
        return $query->where('account_number', $account_number);
    }

    public function scopeIdCard($query, $id_card)
    {
        if (is_array($id_card)) {
            return $query->whereIn('id_card', $id_card);
        }
        return $query->where('id_card', $id_card);
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
            self::TYPE_PERSONAL => [__('invoice_type_personal'), COLORS['success'], 'user'],
            self::TYPE_COMPANY => [__('invoice_type_company'), COLORS['warning'], 'building'],
        ];
        return ($id == '') ? $list : $list[$id];
    }

    public function scopeSearch($query, $search)
    {
        return $query->where(function ($q) use ($search) {
            $q->orWhere('name', 'LIKE', "%$search%")
                ->orWhere('company', 'LIKE', "%$search%")
                ->orWhere('address', 'LIKE', "%$search%");
        });
    }
}
