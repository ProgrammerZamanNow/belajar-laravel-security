<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Contact extends Model
{
    protected $table = "contacts";

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, "user_id", "id", "users");
    }
}
