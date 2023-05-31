<?php

namespace Modules\Warehouses\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Suppliers extends Model
{
    use HasFactory;

    protected $fillable = [];
    
    protected static function newFactory()
    {
        return \Modules\Warehouses\Database\factories\SuppliersFactory::new();
    }
}
