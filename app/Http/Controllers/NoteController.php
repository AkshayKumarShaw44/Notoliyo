<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Collaboration;
use App\Models\Note;
use App\Models\User;
use App\Services\NoteService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class NoteController extends Controller
{
    public function __construct(protected NoteService $noteService) {}

    /**
     * Store a newly created note.
     */
    public function store(Request $request): RedirectResponse
    {
        $user = Auth::user();

        $request->validate([
            'title' => 'nullable|string|max:255',
            'category' => 'nullable|string|max:255',
            'tags' => 'nullable|string',
        ]);

        $data = $request->only('title', 'category');

        // Process tags
        if ($request->filled('tags')) {
            $tags = array_map('trim', explode(',', $request->tags));
            $data['tags'] = array_filter($tags);
        }

        $note = $this->noteService->createNote($user, $data);

        return redirect()->route('notes.show', $note->id)
            ->with('success', 'Note created successfully.');
    }

    /**
     * Display the note editor workspace.
     */
    public function show(Request $request, string $id): View|RedirectResponse
    {
        $note = Note::findOrFail($id);
        $user = Auth::user();
        $token = $request->query('token');

        // Check permission
        $role = $this->noteService->getUserRoleForNote($note, $user);

        // If no authenticated permission, check if share token matches
        if (! $role) {
            if ($token && $note->share_token === $token) {
                $role = 'editor'; // Allow guest editor access for presentation convenience
            } else {
                return redirect()->route('dashboard')
                    ->with('error', 'You do not have permission to view this note.');
            }
        }

        // Get collaborators details
        $collaboratorEntries = Collaboration::where('note_id', $note->id)->get();
        $collaborators = $collaboratorEntries->map(function ($entry) {
            $collabUser = User::find($entry->user_id);
            if ($collabUser) {
                return [
                    'id' => $collabUser->id,
                    'name' => $collabUser->name,
                    'email' => $collabUser->email,
                    'avatar_color' => $collabUser->avatar_color,
                    'role' => $entry->role,
                ];
            }

            return null;
        })->filter()->values();

        // Get comments on the note
        $comments = $note->comments()->orderBy('created_at', 'asc')->get();

        // Determine client details (even for guests)
        $clientUser = [
            'id' => $user ? $user->id : 'guest_'.uniqid(),
            'name' => $user ? $user->name : 'Guest '.rand(100, 999),
            'avatar_color' => $user ? $user->avatar_color : '#6B7280', // cool-gray
            'role' => $role,
        ];

        return view('notes.editor', compact('note', 'role', 'collaborators', 'comments', 'clientUser'));
    }

    /**
     * Update the note content (Auto-save / Rename).
     */
    public function update(Request $request, string $id): JsonResponse
    {
        $note = Note::findOrFail($id);
        $user = Auth::user();

        // Check permission
        $role = $this->noteService->getUserRoleForNote($note, $user);
        if (! $role && $request->query('token') === $note->share_token) {
            $role = 'editor';
        }

        if ($role !== 'owner' && $role !== 'editor') {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $request->validate([
            'title' => 'nullable|string|max:255',
            'content' => 'nullable|string',
            'category' => 'nullable|string|max:255',
            'silent' => 'nullable|boolean',
        ]);

        $this->noteService->updateNote(
            $note,
            $user ?? User::first(), // Use note owner or first user if guest
            $request->only('title', 'content', 'category', 'silent')
        );

        return response()->json(['success' => true, 'updated_at' => $note->updated_at->toIso8601String()]);
    }

    /**
     * Remove the note.
     */
    public function destroy(string $id): RedirectResponse
    {
        $note = Note::findOrFail($id);
        $user = Auth::user();

        // Only owner can delete the note
        if ($note->user_id !== $user->id) {
            return redirect()->route('dashboard')
                ->with('error', 'Only the owner can delete this note.');
        }

        $this->noteService->deleteNote($note, $user);

        return redirect()->route('dashboard')
            ->with('success', 'Note deleted successfully.');
    }

    /**
     * Toggle starred/favorite status.
     */
    public function toggleFavorite(string $id): RedirectResponse
    {
        $note = Note::findOrFail($id);
        $user = Auth::user();

        // Must have access to star it
        $role = $this->noteService->getUserRoleForNote($note, $user);
        if (! $role) {
            return redirect()->route('dashboard')
                ->with('error', 'Unauthorized.');
        }

        $this->noteService->toggleFavorite($note, $user);

        return back()->with('success', $note->is_favorite ? 'Starred!' : 'Starred removed.');
    }

    /**
     * Toggle public sharing links.
     */
    public function toggleSharing(string $id): RedirectResponse
    {
        $note = Note::findOrFail($id);
        $user = Auth::user();

        if ($note->user_id !== $user->id) {
            return back()->with('error', 'Only the owner can toggle public sharing.');
        }

        $this->noteService->toggleSharing($note, $user);

        return back()->with('success', $note->share_token ? 'Public link enabled!' : 'Public sharing disabled.');
    }

    /**
     * Invite collaborator by email.
     */
    public function inviteCollaborator(Request $request, string $id): RedirectResponse
    {
        $note = Note::findOrFail($id);
        $user = Auth::user();

        if ($note->user_id !== $user->id) {
            return back()->with('error', 'Only the owner can manage collaborations.');
        }

        $request->validate([
            'email' => 'required|email|exists:users,email',
            'role' => 'required|string|in:editor,viewer',
        ]);

        $collab = $this->noteService->inviteCollaborator($note, $user, $request->email, $request->role);

        if (! $collab) {
            return back()->with('error', 'User not found or couldn\'t be invited.');
        }

        return back()->with('success', 'Collaborator added successfully.');
    }

    /**
     * Remove collaborator.
     */
    public function removeCollaborator(Request $request, string $id): RedirectResponse
    {
        $note = Note::findOrFail($id);
        $user = Auth::user();

        if ($note->user_id !== $user->id) {
            return back()->with('error', 'Only the owner can manage collaborations.');
        }

        $request->validate([
            'collaborator_id' => 'required|string',
        ]);

        $this->noteService->removeCollaborator($note, $user, $request->collaborator_id);

        return back()->with('success', 'Collaborator removed.');
    }

    /**
     * Toggle pin/unpin status.
     */
    public function togglePin(string $id): RedirectResponse
    {
        $note = Note::findOrFail($id);
        $user = Auth::user();

        // Check permission
        $role = $this->noteService->getUserRoleForNote($note, $user);
        if (! $role) {
            return redirect()->route('dashboard')
                ->with('error', 'Unauthorized.');
        }

        $note->is_pinned = ! $note->is_pinned;
        $note->pinned_at = $note->is_pinned ? now() : null;
        $note->save();

        Activity::create([
            'user_id' => $user->id,
            'note_id' => $note->id,
            'action' => $note->is_pinned ? 'pinned' : 'unpinned',
            'description' => ($note->is_pinned ? 'Pinned' : 'Unpinned')." note \"{$note->title}\"",
        ]);

        return back()->with('success', $note->is_pinned ? 'Note pinned!' : 'Note unpinned.');
    }
}
