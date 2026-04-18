<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;

class CharityCase extends Model
{
    use HasFactory;

    /** @var list<string> */
    protected $fillable = [
        'title',
        'description',
        'category',
        'status',
        'target_amount',
        'collected_amount',
        'image',
    ];

    /** @return array<string, string> */
    protected function casts(): array
    {
        return [
            'target_amount' => 'integer',
            'collected_amount' => 'integer',
        ];
    }

    public function donations(): HasMany
    {
        return $this->hasMany(Donation::class);
    }

    public function progressPercent(): int
    {
        if ($this->target_amount === 0) {
            return 0;
        }

        return (int) min(100, round(($this->collected_amount / $this->target_amount) * 100));
    }

    public function remainingAmount(): int
    {
        return max(0, $this->target_amount - $this->collected_amount);
    }

    public function imageUrl(): string
    {
        if (! $this->image) {
            return 'https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?auto=format&fit=crop&w=1200&q=80';
        }

        if (str_starts_with($this->image, 'http')) {
            return $this->image;
        }

        return Storage::url($this->image);
    }
}
