<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;
use MongoDB\Laravel\Relations\BelongsTo;
use MongoDB\Laravel\Relations\HasMany;

class Note extends Model
{
    protected $connection = 'mongodb';

    protected $collection = 'notes';

    protected $fillable = [
        'title',
        'content',
        'user_id',
        'category',
        'is_favorite',
        'share_token',
        'tags',
        'is_pinned',
        'pinned_at',
    ];

    protected $casts = [
        'is_favorite' => 'boolean',
        'tags' => 'array',
        'is_pinned' => 'boolean',
        'pinned_at' => 'datetime',
    ];

    /**
     * Get the user that owns the note.
     */
    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the collaborations for the note.
     */
    public function collaborations(): HasMany
    {
        return $this->hasMany(Collaboration::class, 'note_id');
    }

    /**
     * Get the comments on the note.
     */
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class, 'note_id');
    }

    /**
     * Get the activities associated with the note.
     */
    public function activities(): HasMany
    {
        return $this->hasMany(Activity::class, 'note_id');
    }
}
