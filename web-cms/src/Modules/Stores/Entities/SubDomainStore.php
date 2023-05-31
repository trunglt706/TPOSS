<?php

namespace Modules\Stores\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SubDomainStore extends Model
{
    use HasFactory;

    protected $table = 'sub_domain_stores';
    protected $fillable = ['sub_domain_id', 'store_id'];

    public function sub_domain()
    {
        return $this->hasOne(SubDomain::class, 'id', 'sub_domain_id');
    }

    public function store()
    {
        return $this->hasOne(Stores::class, 'id', 'store_id');
    }

    public function scopeSubDomainId($query, $sub_domain_id)
    {
        if (is_array($sub_domain_id)) {
            return $query->whereIn('sub_domain_id', $sub_domain_id);
        }
        return $query->where('sub_domain_id', $sub_domain_id);
    }

    public function scopeStoreId($query, $store_id)
    {
        if (is_array($store_id)) {
            return $query->whereIn('store_id', $store_id);
        }
        return $query->where('store_id', $store_id);
    }
}
