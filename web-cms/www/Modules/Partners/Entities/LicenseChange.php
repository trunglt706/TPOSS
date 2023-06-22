<?php

namespace Modules\Partners\Entities;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Modules\Admins\Entities\Admins;

class LicenseChange extends Model
{
    use HasFactory, SoftDeletes;
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
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    protected $hidden = [
        'license_id',
        'created_by',
        'updated_by',
        'deleted_by',
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
            $model->type = $model->type ?? self::TYPE_AUTO;
        });

        static::created(function ($model) {
        });

        static::updating(function ($model) {
            $model->updated_at = Auth::guard(AUTH_ADMIN)->check() ? Auth::guard(AUTH_ADMIN)->user()->id : 0;
        });

        static::updated(function ($model) {
        });

        static::deleting(function ($model) {
            $model->deleted_at = Auth::guard(AUTH_ADMIN)->check() ? Auth::guard(AUTH_ADMIN)->user()->id : 0;
        });

        static::deleted(function ($model) {
        });
    }

    const TYPE_AUTO = 'auto';
    const TYPE_MANUAL = 'manual';

    public function license()
    {
        return $this->belongsTo(PartnerLicense::class, 'license_id');
    }

    public function createdBy()
    {
        return $this->hasOne(Admins::class, 'id', 'created_by');
    }

    public function scopeOfType($query, $type)
    {
        if (is_array($type)) {
            return $query->whereIn('type', $type);
        }
        return $query->where('type', $type);
    }

    public function scopeLicenseId($query, $license_id)
    {
        if (is_array($license_id)) {
            return $query->whereIn('license_id', $license_id);
        }
        return $query->where('license_id', $license_id);
    }

    public function scopeOfCreated($query, $created_by)
    {
        if (is_array($created_by)) {
            return $query->whereIn('created_by', $created_by);
        }
        return $query->where('created_by', $created_by);
    }

    public function scopeOfDate($query, $date)
    {
        $_date = Carbon::parse($date)->format('Y-m-d');
        return $query->where('date', $_date);
    }

    public function scopeDateCreated($query, $date)
    {
        $_date = Carbon::parse($date)->format('Y-m-d');
        return $query->whereDate('created_at', $_date);
    }

    public function scopeBetween($query, $from, $to)
    {
        $_from = Carbon::parse($from)->startOfDay()->format('Y-m-d');
        $_to = Carbon::parse($to)->endOfDay()->format('Y-m-d');
        return $query->whereBetween('date', [$_from, $_to]);
    }

    public function scopeBetweenCreated($query, $from, $to)
    {
        $_from = Carbon::parse($from)->startOfDay()->format('Y-m-d H:i:s');
        $_to = Carbon::parse($to)->endOfDay()->format('Y-m-d H:i:s');
        return $query->whereBetween('created_at', [$_from, $_to]);
    }

    public function scopeSearch($query, $search)
    {
        return $query->where(function ($q) use ($search) {
            $q->orWhere('name', 'LIKE', "%$search%");
        });
    }
}
