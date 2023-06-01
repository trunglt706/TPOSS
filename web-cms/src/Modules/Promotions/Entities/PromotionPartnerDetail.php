<?php

namespace Modules\Promotions\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PromotionPartnerDetail extends Model
{
    use HasFactory;

    protected $fillable = [];
    
    protected static function newFactory()
    {
        return \Modules\Promotions\Database\factories\PromotionPartnerDetailFactory::new();
    }
}