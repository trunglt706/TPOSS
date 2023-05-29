<?php

namespace Modules\Admins\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PostGroup extends Model
{
    use HasFactory;
    protected $table = 'posts';

    protected $fillable = ['name', 'slug', 'description', 'order', 'image', 'status', 'created_by'];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'order' => 'integer',
    ];

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

    public function scopeCreatedBy($query, $created_by)
    {
        if (is_array($created_by)) {
            return $query->whereIn('created_by', $created_by);
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

    public function scopeSlug($query, $slug)
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
            self::STATUS_ACTIVE => ['Kích hoạt', COLORS['success'], 'check-circle'],
            self::STATUS_SUSPEND => ['Bị khóa', COLORS['warning'], 'lock-on'],
        ];
        return ($id == '') ? $list : $list[$id];
    }
}
