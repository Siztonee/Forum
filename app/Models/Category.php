<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Category extends Model
{
    protected $fillable = [
        'creator_id',
        'name',
        'icon', 
        'bg_color',
        'access',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

}
