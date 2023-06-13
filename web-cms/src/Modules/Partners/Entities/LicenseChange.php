<?php

namespace Modules\Partners\Entities;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;

class LicenseChange extends Model
{
    use HasFactory;
    protected $table = 'license_changes';

    protected $fillable = [
        'name',
        'license_id',
        'date',
        'max_admins',
        'max_customers',
        'max_leads',
        'max_stores',
        'type',
        'created_by'
    ];

    protected $hidden = [
        'license_id',
        'created_by'
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
        'max_admins' => 'integer',
        'max_customers' => 'integer',
        'max_leads' => 'integer',
        'max_stores' => 'integer',
    ];

    protected static function booted()
    {
        static::creating(function ($model) {
            $model->name = $model->name ?? __('change_license_by_date', ['date' => date('d/m/Y')]);
            $model->date = $model->date ?? date('Y-m-d');
            $model->created_by = Auth::guard(AUTH_ADMIN)->check() ? Auth::guard(AUTH_ADMIN)->user()->id : 0;
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

    const TYPE_AUTO = 'auto';
    const TYPE_MANUAL = 'manual';

    protected function maxStores(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => ((int)$value),
        );
    }

    protected function maxAdmins(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => ((int)$value),
        );
    }

    protected function maxCustomers(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => ((int)$value),
        );
    }

    protected function maxLeads(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => ((int)$value),
        );
    }
}
