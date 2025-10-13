<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChatAIMessage extends Model
{
    protected $table = 'chat_ai_messages';
    protected $fillable = ['chat_id', 'sender', 'content'];
}
