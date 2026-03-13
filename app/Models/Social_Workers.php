<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Social_Workers extends Model
{
    use HasFactory;

    protected $table = 'social_workers';

    /**
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'specialization',
        'phone',
        'address',
        'age',
        'email',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'age' => 'integer',
        ];
    }
}
