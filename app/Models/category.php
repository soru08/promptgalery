<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'icon',
        'color',
        'description',
    ];

    public function prompts(): HasMany
    {
        return $this->hasMany(Prompt::class);
    }

    public function getPromptCountAttribute(): int
    {
        return $this->prompts()->count();
    }
}
