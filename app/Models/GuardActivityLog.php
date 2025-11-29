<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GuardActivityLog extends Model
{
    use HasFactory;

    protected $fillable = ['guard_id', 'log_date', 'check_in', 'check_out'];

    public function guard_module()
    {
        return $this->belongsTo(Guard::class, 'guard_id');
    }
}
