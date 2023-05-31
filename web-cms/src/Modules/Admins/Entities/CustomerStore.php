<?php

namespace Modules\Admins\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Stores\Entities\Stores;

class CustomerStore extends Model
{
    use HasFactory;
    protected $table = 'customer_stores';

    protected $fillable = [
        'customer_id',
        'store_id'
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];

    public function customer()
    {
        return $this->hasOne(AdminCustomer::class, 'id', 'customer_id');
    }

    public function store()
    {
        return $this->hasOne(Stores::class, 'id', 'store_id');
    }
}
