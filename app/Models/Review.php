<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Review extends Model
{
    use HasFactory;

    function art(): BelongsTo{
        return $this->belongsTo(Arts::class);
    }
    function user(): BelongsTo{
        return $this->belongsTo(User::class);
    }
}
