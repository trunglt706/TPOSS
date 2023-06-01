<?php

namespace Modules\Stores\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PositionStore extends Model
{
    use HasFactory;

    protected $table = 'position_stores';
    protected $fillable = [
        'position_id',
        'store_id'
    ];

    public function position()
    {
        return $this->hasOne(Positions::class, 'id', 'position_id');
    }

    public function store()
    {
        return $this->hasOne(Stores::class, 'id', 'store_id');
    }

    public function scopePositionId($query, $position_id)
    {
        if (is_array($position_id)) {
            return $query->whereIn('position_id', $position_id);
        }
        return $query->where('position_id', $position_id);
    }

    public function scopeStoreId($query, $store_id)
    {
        if (is_array($store_id)) {
            return $query->whereIn('store_id', $store_id);
        }
        return $query->where('store_id', $store_id);
    }
}