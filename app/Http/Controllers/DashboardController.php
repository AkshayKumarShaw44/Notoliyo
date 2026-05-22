<?php

namespace App\Http\Controllers;

use App\Models\Collaboration;
use App\Models\Note;
use App\Services\NoteService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __construct(protected NoteService $noteService) {}

    /**
     * Show the application dashboard.
     */
    public function index(Request $request): View
    {
        $user = Auth::user();

        $search = $request->query('search');
        $category = $request->query('category', 'All');
        $filter = $request->query('filter', 'all'); // 'all', 'my_notes', 'shared_with_me', 'favorites'

        // Get notes based on search & filters
        $notes = $this->noteService->getVisibleNotesForUser($user, $search, $category, $filter);

        // Get categories list for sidebar
        $categories = $this->noteService->getCategoriesForUser($user);

        // Fetch recent notes for quick access
        $recentNotes = $notes->take(5);

        // Add statistics
        $stats = [
            'total_notes' => $notes->count(),
            'notes_this_week' => Note::where('user_id', $user->id)
                ->where('created_at', '>=', now()->subWeek())
                ->count(),
            'shared_notes' => Collaboration::where('user_id', $user->id)->count(),
            'total_collaborators' => Collaboration::whereIn('note_id', $user->notes->pluck('_id'))
                ->distinct('user_id')
                ->count(),
        ];

        return view('dashboard', compact('notes', 'recentNotes', 'categories', 'category', 'filter', 'search', 'stats'));
    }
}
