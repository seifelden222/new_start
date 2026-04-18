<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Donation extends Model
{
    use HasFactory;

    /** @var list<string> */
    protected $fillable = [
        'user_id',
        'charity_case_id',
        'amount',
        'payment_method',
        'status',
    ];

    /** @return array<string, string> */
    protected function casts(): array
    {
        return [
            'amount' => 'integer',
        ];
    }

    public function paymentMethodLabel(): string
    {
        return match ($this->payment_method) {
            'wallet' => 'المحفظة',
            'cash' => 'كاش',
            'instapay' => 'إنستا باي',
            default => $this->payment_method ?? '—',
        };
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function charityCase(): BelongsTo
    {
        return $this->belongsTo(CharityCase::class);
    }
}
