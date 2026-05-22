<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Comment;
use App\Models\Note;
use App\Services\NoteService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function __construct(protected NoteService $noteService) {}

    /**
     * Store a comment for a note.
     */
    public function store(Request $request, string $noteId): RedirectResponse
    {
        $note = Note::findOrFail($noteId);
        $user = Auth::user();

        // Check if user has permission to comment
        $role = $this->noteService->getUserRoleForNote($note, $user);
        if (! $role) {
            return back()->with('error', 'You do not have permission to comment on this note.');
        }

        $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        Comment::create([
            'note_id' => $note->id,
            'user_id' => $user ? $user->id : 'guest',
            'user_name' => $user ? $user->name : 'Guest',
            'content' => $request->content,
        ]);

        // Log activity
        $this->noteService->logActivity(
            $user ? $user->id : 'guest',
            $note->id,
            'commented',
            ($user ? $user->name : 'Guest')." commented on \"{$note->title}\""
        );

        return back()->with('success', 'Comment posted.');
    }
}
