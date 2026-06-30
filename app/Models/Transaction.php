<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Transaction extends Model
{
    protected $fillable = ['amount', 'type'];

    protected $casts = [
        'amount' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Boot Model for internal automation.
     */
    protected static function booted()
    {
        static::creating(function ($transaction) {
            // Ensure that the hash is generated internally and is unique.
            $transaction->hash = (string) Str::uuid();
        });
    }
}
