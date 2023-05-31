<?php

namespace Modules\Warehouses\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MetarialFlow extends Model
{
    use HasFactory;

    protected $fillable = [];
    
    protected static function newFactory()
    {
        return \Modules\Warehouses\Database\factories\MetarialFlowFactory::new();
    }
}
