<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PasswordResetToken extends Model
{
    use HasFactory;

    const TYPE_ADMIN = 'admin';
    const TYPE_USER = 'user';

    protected $fillable = [
        'email',
        'token',
        'type',
        'store_id',
        'created_at'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'store_id' => 'integer',
    ];

    // relations
    public function admin()
    {
        return $this->hasOne(Admin::class, 'email', 'email');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'email', 'email')->where('store_id', $this->store_id);
    }

    public function store()
    {
        return $this->hasOne(Store::class, 'id', 'store_id');
    }

    // scope
    public function scopeEmail($query, $email)
    {
        return $query->where('email', $email);
    }

    public function scopeType($query, $type)
    {
        return $query->where('type', $type);
    }

    public function scopeStoreId($query, $store_id)
    {
        return $query->where('store_id', $store_id);
    }

    public function scopeToken($query, $token)
    {
        return $query->where('token', $token);
    }
}
