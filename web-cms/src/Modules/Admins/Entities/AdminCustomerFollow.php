<?php

namespace Modules\Admins\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AdminCustomerFollow extends Model
{
    use HasFactory;
    protected $table = 'admin_customer_follows';

    protected $fillable = [
        'admin_id',
        'customer_id'
    ];

    protected $hidden = [
        'admin_id',
        'customer_id'
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

    public function admin()
    {
        return $this->hasOne(Admins::class, 'id', 'admin_id')->withDefault([
            'id' => 0,
            'name' => __('dashboard_admin')
        ]);
    }

    public function customer()
    {
        return $this->hasOne(AdminCustomer::class, 'id', 'customer_id');
    }

    public function scopeAdminId($query, $admin_id)
    {
        if (is_array($admin_id)) {
            return $query->whereIntegerInRaw('admin_id', $admin_id);
        }
        return $query->where('admin_id', $admin_id);
    }

    public function scopeCustomerId($query, $customer_id)
    {
        if (is_array($customer_id)) {
            return $query->whereIntegerInRaw('customer_id', $customer_id);
        }
        return $query->where('customer_id', $customer_id);
    }
}
