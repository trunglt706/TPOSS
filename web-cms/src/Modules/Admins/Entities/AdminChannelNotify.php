<?php

namespace Modules\Admins\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;

class AdminChannelNotify extends Model
{
    use HasFactory;

    protected $table = 'admin_channel_notifies';
    protected $fillable = [
        'code',
        'name',
        'image',
        'description',
        'status',
        'settings',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    protected function settings(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => json_decode($value, 1),
        );
    }

    public function scopeCode($query, $code)
    {
        return $query->where('code', $code);
    }

    public function scopeStatus($query, $status)
    {
        return $query->where('status', $status);
    }
}
