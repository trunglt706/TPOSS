<?php

namespace Modules\Admins\Entities;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\HasApiTokens;
use Modules\Stores\Entities\Stores;
use Nwidart\Modules\Module;
use Illuminate\Support\Str;
use Modules\Admins\Emails\EmailAdminActive;
use Modules\Admins\Emails\EmailAdminInfo;
use Modules\Admins\Emails\EmailAdminSuspended;

class Admins extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;
    protected $table = 'admins';

    // status
    const STATUS_UN_ACTIVE = 0;
    const STATUS_ACTIVE = 1;
    const STATUS_SUSPEND = 2;
    const STATUS_DELETED = 3;

    // root
    const IS_ROOT = true;
    const NOT_ROOT = false;

    // enable_two_factory
    const ENABLE_TWO_FACTORY = true;
    const DISABLE_TWO_FACTORY = false;

    // supper
    const IS_SUPPER = true;
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
        'group_id',
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
        'enable_two_factory_code',
        'enable_two_factory_expire',
        'birthday',
        'last_activity',
        'expired_date',
        'created_at',
        'created_by',
        'deleted_at',
        'deleted_by',
        'identity_card',
        'tax_code'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'deleted_at',
        'deleted_by',
        'created_by',
        'last_activity',
        'expired_date',
        'updated_at',
        'last_login',
        'enable_two_factory',
        'enable_two_factory_code',
        'enable_two_factory_expire',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'last_login' => 'datetime:Y-m-d H:i:s',
        'last_activity' => 'datetime:Y-m-d H:i:s',
        'birthday' => 'date:Y-m-d',
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
        'expired_date' => 'date:Y-m-d',
        'deleted_at' => 'datetime:Y-m-d H:i:s',
        'enable_two_factory_expire' => 'datetime:Y-m-d H:i:s',
    ];

    protected static function booted()
    {
        static::creating(function ($admin) {
            $admin->created_by = Auth::guard(AUTH_ADMIN)->check() ? Auth::guard(AUTH_ADMIN)->user()->id : 0;
            $admin->password = $admin->password ?? self::get_password_default();
            $admin->gender = $admin->gender ?? self::GENDER_OTHER;
            $admin->status = $admin->status ?? self::STATUS_UN_ACTIVE;
            $admin->root = $admin->root ?? self::NOT_ROOT;
            $admin->supper = $admin->supper ?? self::NOT_SUPPER;
            $admin->code = $admin->code ?? self::get_code_default();
        });

        static::created(function ($admin) {
            // add to admin_role_details
            foreach (AdminGroupRoleSample::groupId($admin->group_id ?? null)->get() as $permission) {
                AdminRoleDetail::firstOrCreate([
                    'permission_id' => $permission->permission_id,
                    'admin_id' => $admin->id,
                    'role_id' => $permission->role_id ?? null,
                    'status' => $admin->root == self::IS_ROOT ? AdminRoleDetail::STATUS_ACTIVE : $permission->status,
                ]);
            }
            // check and send email
            if ($admin->status == self::STATUS_UN_ACTIVE) {
                try {
                    Mail::to($admin->email)->send(new EmailAdminActive($admin));
                } catch (\Throwable $th) {
                    //throw $th;
                }
            } else if ($admin->status == self::STATUS_ACTIVE) {
                try {
                    Mail::to($admin->email)->send(new EmailAdminInfo($admin));
                } catch (\Throwable $th) {
                    //throw $th;
                }
            }
        });

        static::updating(function ($model) {
        });

        static::updated(function ($admin) {
            if ($admin->status == self::STATUS_SUSPEND) {
                try {
                    Mail::to($admin->email)->send(new EmailAdminSuspended($admin));
                } catch (\Throwable $th) {
                    //throw $th;
                }
            } else if ($admin->status == self::STATUS_DELETED) {
                // delete admin_role_details
                $admin->role_details()->delete();
                // check and delete avatar in s3
                if ($admin->avatar) Storage::delete($admin->avatar);
            }
        });

        static::deleted(function ($admin) {
            $admin->status = self::STATUS_DELETED;
            $admin->deleted_by = Auth::guard(AUTH_ADMIN)->check() ? Auth::guard(AUTH_ADMIN)->user()->id : 0;

            // delete admin_role_details
            $admin->role_details()->delete();
            // check and delete avatar in s3
            if ($admin->avatar) Storage::delete($admin->avatar);
        });

        static::restored(function ($admin) {
            $admin->status = self::STATUS_ACTIVE;

            // add to admin_role_details
            foreach (AdminGroupRoleSample::groupId($admin->group_id ?? null)->get() as $permission) {
                AdminRoleDetail::firstOrCreate([
                    'permission_id' => $permission->permission_id,
                    'admin_id' => $admin->id,
                    'role_id' => $permission->role_id ?? null,
                    'status' => $admin->root == self::IS_ROOT ? AdminRoleDetail::STATUS_ACTIVE : $permission->status,
                ]);
            }
        });
    }

    protected function phone(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => get_phone_number($value, get_option('hide-email-admin', true))
        );
    }

    // relations
    public function role_details()
    {
        return $this->hasMany(AdminRoleDetail::class, 'admin_id', 'id');
    }

    public function group()
    {
        return $this->belongsTo(AdminGroup::class, 'group_id');
    }

    public function activities()
    {
        return $this->hasMany(AdminActivity::class, 'admin_id', 'id')->latest();
    }

    public function notifications()
    {
        return $this->hasMany(AdminNotification::class, 'admin_id', 'id');
    }

    public function device_token()
    {
        return $this->hasMany(AdminTokenDevice::class, 'created_by', 'id');
    }

    public function orders()
    {
        return $this->hasMany(AdminOrder::class, 'created_by', 'id');
    }

    public function createdBy()
    {
        return $this->hasOne(Admins::class, 'created_by', 'id')->withDefault([
            'id' => 0,
            'name' => __('dashboard_admin')
        ]);
    }

    public function deletedBy()
    {
        return $this->hasOne(Admins::class, 'deleted_by', 'id')->withDefault([
            'id' => 0,
            'name' => __('dashboard_admin')
        ]);
    }

    public function storeAssigned()
    {
        return $this->hasMany(Stores::class, 'assigned_id', 'id');
    }

    // scope
    public function scopeTwoFactory($query)
    {
        return $query->where('enable_two_factory', self::ENABLE_TWO_FACTORY);
    }

    public function scopeTwoFactoryCode($query, $enable_two_factory_code)
    {
        return $query->where('enable_two_factory_code', $enable_two_factory_code);
    }

    public function scopeTwoFactoryExpired($query)
    {
        // default 3 minutes
        $minutes = get_option('time-two-factory-expire', 3);
        return $query->where('enable_two_factory_expire', '>=', Carbon::now()->subMinutes($minutes));
    }

    public function scopeTwoFactoryNotExpired($query)
    {
        // default 3 minutes
        $minutes = get_option('time-two-factory-expire', 3);
        return $query->where('enable_two_factory_expire', '<', Carbon::now()->subMinutes($minutes));
    }

    public function scopeOfEmail($query, $email)
    {
        return $query->where('email', $email);
    }

    public function scopeOfPhone($query, $phone)
    {
        return $query->where('phone', $phone);
    }

    public function scopeOfCode($query, $code)
    {
        return $query->where('code', $code);
    }

    public function scopeGroupId($query, $group_id)
    {
        if (is_array($group_id)) {
            return $query->whereIntegerInRaw('group_id', $group_id);
        }
        return $query->where('group_id', $group_id);
    }

    public function scopeStatus($query, $status)
    {
        if (is_array($status)) {
            return $query->where('status', $status);
        }
        return $query->where('status', $status);
    }

    public function scopeActive($query)
    {
        return $query->where('status', self::STATUS_ACTIVE);
    }

    public function scopeSupper($query, $supper)
    {
        return $query->where('supper', $supper);
    }

    public function scopeIsSupper($query)
    {
        return $query->where('supper', self::IS_SUPPER);
    }

    public function scopeRoot($query, $root)
    {
        return $query->where('root', $root);
    }

    public function scopeIsRoot($query)
    {
        return $query->where('root', self::IS_ROOT);
    }

    public function scopeNotDelete($query)
    {
        return $query->where('status', '<>', self::STATUS_DELETED);
    }

    public function scopeSearch($query, $search)
    {
        return $query->where(function ($q) use ($search) {
            $q->where('name', 'LIKE', "%$search%")
                ->orWhere('phone', 'LIKE', "%$search%")
                ->orWhere('email', 'LIKE', "%$search%")
                ->orWhere('code', 'LIKE', "%$search%");
        });
    }

    public static function get_status($id = '')
    {
        $list = [
            self::STATUS_UN_ACTIVE => [__('status_0'), COLORS['secondary'], 'slash'],
            self::STATUS_ACTIVE => [__('status_1'), COLORS['success'], 'check-circle'],
            self::STATUS_SUSPEND => [__('status_2'), COLORS['warning'], 'lock-on'],
            self::STATUS_DELETED => [__('status_3'), COLORS['danger'], 'times'],
        ];
        return ($id == '') ? $list : $list[$id];
    }

    public static function get_supper($supper = '')
    {
        $list = [
            self::IS_SUPPER => [__('account_supper_1'), COLORS['success']],
            self::NOT_SUPPER => [__('account_supper_0'), COLORS['secondary']],
        ];
        return ($supper == '') ? $list : $list[$supper];
    }

    public static function get_root($root = '')
    {
        $list = [
            self::NOT_ROOT => [__('account_root_0'), COLORS['secondary']],
            self::IS_ROOT => [__('account_root_1'), COLORS['success']],
        ];
        return ($root == '') ? $list : $list[$root];
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

    public function scopeExpireDate($query, $expired_date)
    {
        $_date = Carbon::parse($expired_date)->format('Y-m-d');
        return $query->where('created_at', $_date);
    }

    public function scopeExpired($query)
    {
        return $query->where('expired_date', '>', Carbon::now()->format('Y-m-d'));
    }

    public static function get_code_default()
    {
        $max = Admins::max('id');
        return 'AD' . sprintf("%'.04d", $max + 1);
    }

    public static function get_password_default()
    {
        return Hash::make('Abc@#123');
    }
}
