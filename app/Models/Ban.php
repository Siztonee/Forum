<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Ban extends Model
{
    protected $fillable = [
        'user_id',
        'ip',
        'reason',
        'type',
        'expires_at'
    ];


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
