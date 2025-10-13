<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatAIData extends Model
{
    use HasFactory;

    protected $table = 'chat_ai_data';
    protected $fillable = ['chat_id', 'chat_content', 'chat_date'];

}
