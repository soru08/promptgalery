<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Prompt extends Model
{
    protected $fillable = [
        'title',
        'prompt_text',
        'category_id',
        'style_tags',
        'description',
        'ai_tool',
        'is_featured',
        'copy_count',
        'image_path',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function getStyleTagsArrayAttribute(): array
    {
        if (!$this->style_tags) return [];
        return array_map('trim', explode(',', $this->style_tags));
    }

    public function incrementCopyCount(): void
    {
        $this->increment('copy_count');
    }
}
