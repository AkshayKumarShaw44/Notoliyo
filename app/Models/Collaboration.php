<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;
use MongoDB\Laravel\Relations\BelongsTo;

class Collaboration extends Model
{
    protected $connection = 'mongodb';

    protected $collection = 'collaborations';

    protected $fillable = [
        'note_id',
        'user_id',
        'role',
    ];

    /**
     * Get the note associated with the collaboration.
     */
    public function note(): BelongsTo
    {
        return $this->belongsTo(Note::class, 'note_id');
    }

    /**
     * Get the user associated with the collaboration.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
