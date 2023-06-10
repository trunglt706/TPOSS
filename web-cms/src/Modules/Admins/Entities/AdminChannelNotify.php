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
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];

    protected function code(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => (str_replace(' ', '', $value)),
        );
    }

    protected function settings(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => json_decode($value, 1),
        );
    }

    public function scopeOfCode($query, $code)
    {
        return $query->where('code', $code);
    }

    public function scopeStatus($query, $status)
    {
        return $query->where('status', $status);
    }
}
