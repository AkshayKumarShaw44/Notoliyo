<?php

namespace App\Services;

use App\Models\Activity;
use App\Models\Collaboration;
use App\Models\Note;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class NoteService
{
    /**
     * Create a new note.
     */
    public function createNote(User $user, array $data = []): Note
    {
        $note = Note::create([
            'title' => $data['title'] ?? 'Untitled Note',
            'content' => $data['content'] ?? '<h1>Untitled Note</h1><p>Start writing here...</p>',
            'user_id' => $user->id,
            'category' => $data['category'] ?? 'Uncategorized',
            'is_favorite' => false,
            'share_token' => null,
        ]);

        $this->logActivity($user->id, $note->id, 'created', "Created note \"{$note->title}\"");

        return $note;
    }

    /**
     * Update an existing note.
     */
    public function updateNote(Note $note, User $user, array $data): Note
    {
        $oldTitle = $note->title;
        $note->update(array_filter([
            'title' => $data['title'] ?? null,
            'content' => $data['content'] ?? null,
            'category' => $data['category'] ?? null,
        ]));

        if (isset($data['title']) && $data['title'] !== $oldTitle) {
            $this->logActivity($user->id, $note->id, 'renamed', "Renamed note from \"{$oldTitle}\" to \"{$note->title}\"");
        } else {
            // Log update but don't spam if it's just auto-save text changes
            if (! isset($data['silent']) || ! $data['silent']) {
                $this->logActivity($user->id, $note->id, 'updated', "Updated content of \"{$note->title}\"");
            }
        }

        return $note;
    }

    /**
     * Delete a note.
     */
    public function deleteNote(Note $note, User $user): void
    {
        // Delete all related records
        Collaboration::where('note_id', $note->id)->delete();
        Activity::where('note_id', $note->id)->delete();

        $this->logActivity($user->id, null, 'deleted', "Deleted note \"{$note->title}\"");

        $note->delete();
    }

    /**
     * Toggle favorite status.
     */
    public function toggleFavorite(Note $note, User $user): Note
    {
        $note->is_favorite = ! $note->is_favorite;
        $note->save();

        $action = $note->is_favorite ? 'favorited' : 'unfavorited';
        $this->logActivity($user->id, $note->id, $action, "Starred note \"{$note->title}\"");

        return $note;
    }

    /**
     * Toggle public link sharing.
     */
    public function toggleSharing(Note $note, User $user): Note
    {
        if ($note->share_token) {
            $note->share_token = null;
            $this->logActivity($user->id, $note->id, 'unshared', "Disabled public sharing for \"{$note->title}\"");
        } else {
            $note->share_token = Str::random(32);
            $this->logActivity($user->id, $note->id, 'shared', "Enabled public sharing for \"{$note->title}\"");
        }
        $note->save();

        return $note;
    }

    /**
     * Invite a collaborator by email.
     */
    public function inviteCollaborator(Note $note, User $inviter, string $email, string $role = 'editor'): ?Collaboration
    {
        $collaborator = User::where('email', $email)->first();
        if (! $collaborator) {
            return null;
        }

        // Check if already collaborating
        $existing = Collaboration::where('note_id', $note->id)
            ->where('user_id', $collaborator->id)
            ->first();

        if ($existing) {
            $existing->update(['role' => $role]);

            return $existing;
        }

        $collaboration = Collaboration::create([
            'note_id' => $note->id,
            'user_id' => $collaborator->id,
            'role' => $role,
        ]);

        $this->logActivity($inviter->id, $note->id, 'collaborator_added', "Added {$collaborator->name} as collaborator ({$role}) to \"{$note->title}\"");

        return $collaboration;
    }

    /**
     * Remove a collaborator.
     */
    public function removeCollaborator(Note $note, User $remover, string $collaboratorId): void
    {
        Collaboration::where('note_id', $note->id)
            ->where('user_id', $collaboratorId)
            ->delete();

        $user = User::find($collaboratorId);
        $name = $user ? $user->name : 'User';

        $this->logActivity($remover->id, $note->id, 'collaborator_removed', "Removed collaborator {$name} from \"{$note->title}\"");
    }

    /**
     * Log a user activity.
     */
    public function logActivity(string $userId, ?string $noteId, string $action, string $description): Activity
    {
        return Activity::create([
            'user_id' => $userId,
            'note_id' => $noteId,
            'action' => $action,
            'description' => $description,
        ]);
    }

    /**
     * Get visible notes for a user based on filters, search query, and category.
     */
    public function getVisibleNotesForUser(User $user, ?string $search = null, ?string $category = null, ?string $filter = null): Collection
    {
        $userId = $user->id;

        // Shared note IDs
        $sharedNoteIds = Collaboration::where('user_id', $userId)->pluck('note_id')->toArray();

        $query = Note::query();

        // Apply filters (my notes, shared, starred)
        if ($filter === 'my_notes') {
            $query->where('user_id', $userId);
        } elseif ($filter === 'shared_with_me') {
            $query->whereIn('_id', $sharedNoteIds);
        } elseif ($filter === 'favorites') {
            $query->where(function ($q) use ($userId, $sharedNoteIds) {
                $q->where('user_id', $userId)->orWhereIn('_id', $sharedNoteIds);
            })->where('is_favorite', true);
        } else {
            // Default: User's owned notes OR notes they collaborate on
            $query->where(function ($q) use ($userId, $sharedNoteIds) {
                $q->where('user_id', $userId)->orWhereIn('_id', $sharedNoteIds);
            });
        }

        // Apply category filter
        if ($category && $category !== 'All') {
            $query->where('category', $category);
        }

        // Apply search query
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('content', 'like', "%{$search}%");
            });
        }

        return $query->orderBy('updated_at', 'desc')->get();
    }

    /**
     * Get unique categories list for the user (including uncategorized).
     */
    public function getCategoriesForUser(User $user): array
    {
        $userId = $user->id;
        $sharedNoteIds = Collaboration::where('user_id', $userId)->pluck('note_id')->toArray();

        $categories = Note::where(function ($q) use ($userId, $sharedNoteIds) {
            $q->where('user_id', $userId)->orWhereIn('_id', $sharedNoteIds);
        })->distinct('category')->get()->toArray();

        // Convert the distinct cursor output to simple string array
        $list = array_filter(array_map(function ($item) {
            return is_array($item) ? ($item['category'] ?? null) : (string) $item;
        }, $categories));

        if (! in_array('Uncategorized', $list)) {
            $list[] = 'Uncategorized';
        }

        return array_values(array_unique($list));
    }

    /**
     * Check if a user has access to a note and returns role ('owner', 'editor', 'viewer', or null).
     */
    public function getUserRoleForNote(Note $note, ?User $user): ?string
    {
        if (! $user) {
            // Public read-write if share token exists
            return $note->share_token ? 'editor' : null;
        }

        if ($note->user_id === $user->id) {
            return 'owner';
        }

        $collab = Collaboration::where('note_id', $note->id)
            ->where('user_id', $user->id)
            ->first();

        if ($collab) {
            return $collab->role; // 'editor' or 'viewer'
        }

        return $note->share_token ? 'viewer' : null; // Public link is read-only for registered users if not collaborating
    }
}
