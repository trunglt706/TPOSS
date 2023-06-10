<?php

namespace Modules\Admins\Entities;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class PostGroup extends Model
{
    use HasFactory;
    protected $table = 'posts';

    protected $fillable = [
        'name',
        'slug',
        'description',
        'order',
        'image',
        'status',
        'created_by'
    ];

    protected $hidden = [
        'created_by',
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
        'order' => 'integer',
    ];

    protected function order(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => ((int)$value),
        );
    }

    const STATUS_ACTIVE = 1;
    const STATUS_SUSPEND = 2;

    public function posts()
    {
        return $this->hasMany(Posts::class, 'group_id', 'id');
    }

    public function createdBy()
    {
        return $this->hasOne(Admins::class, 'id', 'created_by');
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

    public function scopeActive($query)
    {
        return $query->where('status', self::STATUS_ACTIVE);
    }

    public function scopeOfSlug($query, $slug)
    {
        if (is_array($slug)) {
            return $query->whereIn('slug', $slug);
        }
        return $query->where('slug', $slug);
    }

    public function scopeSortDesc($query)
    {
        return $query->orderBy('order', 'desc');
    }

    public function scopeSortAsc($query)
    {
        return $query->orderBy('order', 'asc');
    }

    public static function get_status($id = '')
    {
        $list = [
            self::STATUS_ACTIVE => [__('admins::status_1'), COLORS['success'], 'check-circle'],
            self::STATUS_SUSPEND => [__('admins::status_2'), COLORS['warning'], 'lock-on'],
        ];
        return ($id == '') ? $list : $list[$id];
    }

    public static function get_order()
    {
        $max = PostGroup::count();
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
