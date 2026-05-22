<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;
use MongoDB\Laravel\Relations\BelongsTo;

class Comment extends Model
{
    protected $connection = 'mongodb';

    protected $collection = 'comments';

    protected $fillable = [
        'note_id',
        'user_id',
        'user_name',
        'content',
    ];

    /**
     * Get the note associated with the comment.
     */
    public function note(): BelongsTo
    {
        return $this->belongsTo(Note::class, 'note_id');
    }

    /**
     * Get the user associated with the comment.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
