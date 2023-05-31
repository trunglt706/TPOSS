<?php

namespace Modules\Shifts\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HistoryCashShift extends Model
{
    use HasFactory;

    protected $fillable = [];
    
    protected static function newFactory()
    {
        return \Modules\Shifts\Database\factories\HistoryCashShiftFactory::new();
    }
}
