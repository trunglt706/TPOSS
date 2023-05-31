<?php

namespace Modules\Chats\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ChatGroupMessage extends Model
{
    use HasFactory;

    protected $fillable = [];
    
    protected static function newFactory()
    {
        return \Modules\Chats\Database\factories\ChatGroupMessageFactory::new();
    }
}
