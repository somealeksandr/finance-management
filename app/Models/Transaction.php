<?php

namespace App\Models;

use App\Enums\TransactionType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'amount',
        'type',
        'description',
    ];

    protected $casts = [
        'type' => TransactionType::class,
    ];

    /**
     * Relation with User model.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
