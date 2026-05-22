<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;
use MongoDB\Laravel\Relations\BelongsTo;

class Activity extends Model
{
    protected $connection = 'mongodb';

    protected $collection = 'activities';

    protected $fillable = [
        'user_id',
        'note_id',
        'action',
        'description',
    ];

    /**
     * Get the attributes that should be cast.
     */
    protected function casts(): array
    {
        return [
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
        ];
    }

    /**
     * Get the user associated with the activity.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the note associated with the activity.
     */
    public function note(): BelongsTo
    {
        return $this->belongsTo(Note::class, 'note_id');
    }
}
