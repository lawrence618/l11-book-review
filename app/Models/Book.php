<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'author',
    ];

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    public function user(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'reviews');
    }
}
