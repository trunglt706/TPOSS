<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    // status
    const STATUS_UN_ACTIVE = 0;
    const STATUS_ACTIVE = 1;
    const STATUS_SUSPEND = 2;

    // root
    const ROOT_ACCOUNT = true;
    const NOT_ROOT = false;

    // enable_two_factory
    const ENABLE_TWO_FACTORY = true;
    const DISABLE_TWO_FACTORY = false;

    // supper
    const SUPPER_ACCOUNT = true;
    const NOT_SUPPER = false;

    // gender
    const GENDER_MALE = 1;
    const GENDER_FEMALE = 0;
    const GENDER_OTHER = 2;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'code',
        'position_id',
        'store_id',
        'phone',
        'gender',
        'address',
        'description',
        'status',
        'root',
        'avatar',
        'supper',
        'last_login',
        'enable_two_factory',
        'birthday',
        'last_activity',
        'created_at'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'last_login' => 'datetime',
        'last_activity' => 'datetime',
        'birthday' => 'date',
        'created_at' => 'datetime',
    ];

    // relations
    public function position()
    {
        return $this->hasOne(Positions::class, 'id', 'position_id');
    }

    public function store()
    {
        return $this->hasOne(Store::class, 'id', 'store_id');
    }

    public function activity()
    {
        return $this->hasMany(UserActivity::class, 'created_by', 'id');
    }

    public function notification()
    {
        return $this->hasMany(UserNotification::class, 'user_id', 'id');
    }

    public function device_token()
    {
        return $this->hasMany(UserDeviceToken::class, 'user_id', 'id');
    }

    public function shift_detail()
    {
        return $this->hasMany(ShiftDetail::class, 'user_id', 'id');
    }

    public function bill()
    {
        return $this->hasMany(Bills::class, 'created_by', 'id');
    }

    // scope

    public function scopeEmail($query, $email)
    {
        return $query->where('email', $email);
    }

    public function scopePhone($query, $phone)
    {
        return $query->where('phone', $phone);
    }

    public function scopeCode($query, $code)
    {
        return $query->where('code', $code);
    }

    public function scopeStoreId($query, $store_id)
    {
        return $query->where('store_id', $store_id);
    }

    public function scopePositionId($query, $position_id)
    {
        return $query->where('position_id', $position_id);
    }

    public function scopeStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    public function scopeSupper($query, $supper)
    {
        return $query->where('supper', $supper);
    }

    public function scopeRoot($query, $root)
    {
        return $query->where('root', $root);
    }
}
