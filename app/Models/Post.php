<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'title', 'slug', 'excerpt', 'content', 'thumbnail', 'status', 'is_published', 'published_at'
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'published_at' => 'datetime',
    ];

    public function getIsPublishedAttribute(): bool
    {
        return ($this->attributes['status'] ?? null) === 'published';
    }

    public function setIsPublishedAttribute($value): void
    {
        $this->attributes['status'] = $value ? 'published' : 'draft';
    }

    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }
}
