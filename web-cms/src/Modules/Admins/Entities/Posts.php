<?php

namespace Modules\Admins\Entities;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Posts extends Model
{
    use HasFactory;
    protected $table = 'posts';

    protected $fillable = [
        'name',
        'slug',
        'group_id',
        'description',
        'tag',
        'order',
        'image',
        'content',
        'status',
        'created_by'
    ];

    protected $hidden = [
        'created_by',
        'group_id'
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
        'order' => 'integer',
    ];

    protected static function booted()
    {
        static::creating(function ($post) {
            $order = $post->order ?? self::get_order($post->group_id ?? 0);
            $post->created_by = Auth::guard('admin')->check() ? Auth::guard('admin')->user()->id : 0;
            $post->order = $order;
            $post->status = $post->status ?? Posts::STATUS_SUSPEND;
            $post->slug = self::get_slug($post->name, $order);
        });

        static::created(function ($model) {
        });

        static::updating(function ($model) {
        });

        static::updated(function ($model) {
        });

        static::deleted(function ($post) {
            if($post->image) Storage::delete($post->image);
        });
    }

    protected function order(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => ((int)$value),
        );
    }

    protected function tag(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => (json_decode($value, 1)),
        );
    }

    const STATUS_ACTIVE = 1;
    const STATUS_SUSPEND = 2;

    public function group()
    {
        return $this->hasOne(PostGroup::class, 'id', 'group_id');
    }

    public function createdBy()
    {
        return $this->hasOne(Admins::class, 'id', 'created_by')->withDefault([
            'id' => 0,
            'name' => __('dashboard_admin')
        ]);
    }

    public function scopeOfCreated($query, $created_by)
    {
        if (is_array($created_by)) {
            return $query->whereIntegerInRaw('created_by', $created_by);
        }
        return $query->where('created_by', $created_by);
    }

    public function scopeStatus($query, $status)
    {
        if (is_array($status)) {
            return $query->whereIn('status', $status);
        }
        return $query->where('status', $status);
    }

    public function scopeOfSlug($query, $slug)
    {
        if (is_array($slug)) {
            return $query->whereIn('slug', $slug);
        }
        return $query->where('slug', $slug);
    }

    public function scopeGroupId($query, $group_id)
    {
        if (is_array($group_id)) {
            return $query->whereIntegerInRaw('group_id', $group_id);
        }
        return $query->where('group_id', $group_id);
    }

    public function scopeSearchTag($query, $tag)
    {
        $data = json_encode([$tag]);
        if (is_array($tag)) {
            $data = json_encode($tag);
        }
        return $query->whereRaw('JSON_CONTAINS(tag, \'' . $data . '\')');
    }

    public function scopeActive($query)
    {
        return $query->where('status', self::STATUS_ACTIVE);
    }

    public static function get_status($id = '')
    {
        $list = [
            self::STATUS_ACTIVE => [__('admins::status_1'), COLORS['success'], 'check-circle'],
            self::STATUS_SUSPEND => [__('admins::status_2'), COLORS['warning'], 'lock-on'],
        ];
        return ($id == '') ? $list : $list[$id];
    }

    public function scopeSortDesc($query)
    {
        return $query->orderBy('order', 'desc');
    }

    public function scopeSortAsc($query)
    {
        return $query->orderBy('order', 'asc');
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

    public static function get_order($group_id)
    {
        $max = Posts::groupId($group_id)->count();
        return $max + 1;
    }

    public static function get_slug($name, $order = 0)
    {
        $slug = Str::slug($name);
        if (PostGroup::ofSlug($slug)->exists()) {
            return $slug . '-' . $order;
        }
        return $slug;
    }
}
