@extends('layouts.layout')

@section('title', 'Dashboard - Notoliyo')

@section('content')
<div class="h-screen flex overflow-hidden bg-slate-50 dark:bg-slate-950" x-data="{ createNoteModal: false, sidebarOpen: false }">

    <!-- Mobile Sidebar Backdrop -->
    <div x-show="sidebarOpen" class="fixed inset-0 z-30 bg-slate-900/40 backdrop-blur-sm md:hidden" @click="sidebarOpen = false" x-transition:enter="transition-opacity ease-linear duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity ease-linear duration-300" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"></div>

    <!-- Sidebar Layout -->
    <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full md:translate-x-0'" class="fixed inset-y-0 left-0 z-40 w-64 glass-strong border-r border-slate-200/50 dark:border-slate-800/50 flex flex-col transition-transform duration-300 ease-in-out md:static md:h-full shadow-xl">
        <!-- Sidebar Header / Logo -->
        <div class="h-16 px-6 border-b border-slate-200/50 dark:border-slate-800/50 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-lg bg-gradient-to-tr from-indigo-500 to-purple-600 flex items-center justify-center text-white font-bold text-sm shadow-md">
                    N
                </div>
                <span class="font-bold text-lg text-slate-900 dark:text-white">Notoliyo</span>
            </div>
            <button @click="sidebarOpen = false" class="md:hidden text-slate-400 hover:text-slate-600">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>

        <!-- Navigation Links -->
        <div class="flex-1 overflow-y-auto px-4 py-6 space-y-7">
            <!-- Main Navigation -->
            <div class="space-y-1">
                <span class="px-2 text-[10px] font-bold uppercase tracking-wider text-slate-400 block mb-2">Workspace</span>
                <a href="{{ route('dashboard', ['filter' => 'all']) }}" class="flex items-center gap-3 px-3 py-2 rounded-xl text-sm font-semibold transition-all hover:bg-slate-200/50 dark:hover:bg-slate-800/50 {{ $filter === 'all' ? 'bg-indigo-50 dark:bg-indigo-950/40 text-indigo-600 dark:text-indigo-400' : 'text-slate-600 dark:text-slate-400' }}">
                    <i class="fa-solid fa-folder w-5 text-left text-base"></i> All Notes
                </a>
                <a href="{{ route('dashboard', ['filter' => 'favorites']) }}" class="flex items-center gap-3 px-3 py-2 rounded-xl text-sm font-semibold transition-all hover:bg-slate-200/50 dark:hover:bg-slate-800/50 {{ $filter === 'favorites' ? 'bg-indigo-50 dark:bg-indigo-950/40 text-indigo-600 dark:text-indigo-400' : 'text-slate-600 dark:text-slate-400' }}">
                    <i class="fa-solid fa-star w-5 text-left text-base"></i> Starred Notes
                </a>
                <a href="{{ route('dashboard', ['filter' => 'shared_with_me']) }}" class="flex items-center gap-3 px-3 py-2 rounded-xl text-sm font-semibold transition-all hover:bg-slate-200/50 dark:hover:bg-slate-800/50 {{ $filter === 'shared_with_me' ? 'bg-indigo-50 dark:bg-indigo-950/40 text-indigo-600 dark:text-indigo-400' : 'text-slate-600 dark:text-slate-400' }}">
                    <i class="fa-solid fa-users w-5 text-left text-base"></i> Shared With Me
                </a>
                <a href="{{ route('dashboard', ['filter' => 'my_notes']) }}" class="flex items-center gap-3 px-3 py-2 rounded-xl text-sm font-semibold transition-all hover:bg-slate-200/50 dark:hover:bg-slate-800/50 {{ $filter === 'my_notes' ? 'bg-indigo-50 dark:bg-indigo-950/40 text-indigo-600 dark:text-indigo-400' : 'text-slate-600 dark:text-slate-400' }}">
                    <i class="fa-solid fa-user-pen w-5 text-left text-base"></i> My Notes
                </a>
            </div>

            <!-- Categories Section -->
            <div class="space-y-1">
                <span class="px-2 text-[10px] font-bold uppercase tracking-wider text-slate-400 block mb-2">Folders / Tags</span>
                <a href="{{ route('dashboard', ['filter' => $filter, 'category' => 'All', 'search' => $search]) }}" 
                   class="flex items-center justify-between px-3 py-1.5 rounded-xl text-sm font-medium transition-all hover:bg-slate-200/50 dark:hover:bg-slate-800/50 {{ $category === 'All' ? 'text-indigo-600 dark:text-indigo-400 bg-indigo-50/50 dark:bg-indigo-950/20' : 'text-slate-600 dark:text-slate-400' }}">
                    <span>All Folders</span>
                    <i class="fa-solid fa-folder-open text-xs opacity-60"></i>
                </a>
                @foreach ($categories as $cat)
                    <a href="{{ route('dashboard', ['filter' => $filter, 'category' => $cat, 'search' => $search]) }}" 
                       class="flex items-center justify-between px-3 py-1.5 rounded-xl text-sm font-medium transition-all hover:bg-slate-200/50 dark:hover:bg-slate-800/50 {{ $category === $cat ? 'text-indigo-600 dark:text-indigo-400 bg-indigo-50/50 dark:bg-indigo-950/20 font-semibold' : 'text-slate-600 dark:text-slate-400' }}">
                        <span class="truncate pr-2">{{ $cat }}</span>
                        <i class="fa-solid fa-folder text-xs opacity-40"></i>
                    </a>
                @endforeach
            </div>
        </div>

        <!-- Sidebar Footer / Profile Info -->
        <div class="p-4 border-t border-slate-200/50 dark:border-slate-800/50 flex flex-col gap-3">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl flex items-center justify-center text-white font-bold shadow-md" style="background-color: {{ Auth::user()->avatar_color }}">
                    {{ Auth::user()->name[0] }}
                </div>
                <div class="flex-grow min-w-0">
                    <h4 class="text-sm font-bold truncate text-slate-900 dark:text-white">{{ Auth::user()->name }}</h4>
                    <p class="text-xs text-slate-400 truncate">{{ Auth::user()->email }}</p>
                </div>
            </div>
            <div class="flex items-center gap-2">
                <a href="{{ route('profile') }}" class="flex-grow h-9 rounded-xl border border-slate-200/60 dark:border-slate-800/60 hover:bg-slate-100 dark:hover:bg-slate-800/80 flex items-center justify-center text-xs font-semibold text-slate-600 dark:text-slate-300">
                    <i class="fa-solid fa-gear mr-2 text-xs"></i> Settings
                </a>
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="w-9 h-9 rounded-xl border border-slate-200/60 dark:border-slate-800/60 text-slate-500 hover:bg-rose-500/10 hover:text-rose-500 hover:border-rose-500/30 flex items-center justify-center cursor-pointer">
                        <i class="fa-solid fa-arrow-right-from-bracket text-xs"></i>
                    </button>
                </form>
            </div>
        </div>
    </aside>

    <!-- Main Content Area -->
    <main class="flex-1 flex flex-col overflow-hidden relative">
        <!-- Top Navigation Header -->
        <header class="h-16 px-6 border-b border-slate-200/50 dark:border-slate-800/50 flex items-center justify-between glass-strong shadow-sm relative z-50">
            <div class="flex items-center gap-4">
                <button @click="sidebarOpen = true" class="md:hidden text-slate-500 hover:text-slate-700">
                    <i class="fa-solid fa-bars text-lg"></i>
                </button>
                <!-- Search bar -->
                <form action="{{ route('dashboard') }}" method="GET" class="relative max-w-xs sm:max-w-md">
                    <input type="hidden" name="filter" value="{{ $filter }}">
                    <input type="hidden" name="category" value="{{ $category }}">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-slate-400">
                        <i class="fa-solid fa-magnifying-glass text-xs"></i>
                    </span>
                    <input type="text" name="search" value="{{ $search }}"
                           placeholder="Search notes..."
                           class="block w-full pl-9 pr-4 py-1.5 rounded-xl border border-slate-200 dark:border-slate-800 bg-slate-50 dark:bg-slate-900/50 text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent text-sm">
                </form>
            </div>

            <div class="flex items-center gap-4">
                <!-- Notifications -->
                <div x-data="{ 
                    notificationsOpen: false, 
                    unreadCount: 3, 
                    buttonRect: null,
                    notifications: [
                        { id: 1, read: false, icon: 'fa-user-plus', color: 'indigo', title: 'New Collaborator', message: 'John Doe joined \"Project Planning\"', time: '2 minutes ago' },
                        { id: 2, read: false, icon: 'fa-comment', color: 'emerald', title: 'New Comment', message: 'Sarah commented on your note', time: '1 hour ago' },
                        { id: 3, read: false, icon: 'fa-share-nodes', color: 'purple', title: 'Note Shared', message: '\"Meeting Notes\" was shared with you', time: 'Yesterday' }
                    ],
                    markAllRead() {
                        this.notifications.forEach(function(n) { n.read = true; });
                        this.unreadCount = 0;
                    },
                    markAsRead(id) {
                        let notif = this.notifications.find(function(n) { return n.id === id; });
                        if (notif && !notif.read) {
                            notif.read = true;
                            this.unreadCount = Math.max(0, this.unreadCount - 1);
                        }
                    }
                }" class="relative">
                    <button @click="notificationsOpen = !notificationsOpen; buttonRect = $el.getBoundingClientRect()" 
                            class="relative p-2 rounded-lg glass-button text-slate-600 dark:text-slate-300 cursor-pointer">
                        <i class="fa-solid fa-bell"></i>
                        <span x-show="unreadCount > 0" 
                              class="absolute -top-1 -right-1 bg-rose-500 text-white text-[10px] font-bold rounded-full w-5 h-5 flex items-center justify-center animate-pulse"
                              x-text="unreadCount"></span>
                    </button>

                    <!-- Notifications Dropdown -->
                    <div x-show="notificationsOpen" 
                         @click.away="notificationsOpen = false"
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 translate-y-1"
                         x-transition:enter-end="opacity-100 translate-y-0"
                         x-transition:leave="transition ease-in duration-150"
                         x-transition:leave-start="opacity-100 translate-y-0"
                         x-transition:leave-end="opacity-0 translate-y-1"
                         class="fixed w-80 glass-strong rounded-2xl shadow-2xl overflow-hidden z-[9999] border border-slate-200/50 dark:border-slate-800/50"
                         :style="`top: ${buttonRect ? buttonRect.bottom + 8 : 0}px; right: ${buttonRect ? window.innerWidth - buttonRect.right : 0}px;`"
                         style="display: none;">
                        
                        <!-- Header -->
                        <div class="px-4 py-3 border-b border-slate-200/50 dark:border-slate-800/50 flex items-center justify-between">
                            <h3 class="font-bold text-sm text-slate-900 dark:text-white">Notifications</h3>
                            <button @click="markAllRead()" 
                                    x-show="unreadCount > 0"
                                    class="text-xs text-indigo-600 dark:text-indigo-400 font-semibold hover:underline cursor-pointer">
                                Mark all read
                            </button>
                            <span x-show="unreadCount === 0" class="text-xs text-slate-400 font-semibold">
                                All caught up!
                            </span>
                        </div>

                        <!-- Notifications List -->
                        <div class="max-h-96 overflow-y-auto">
                            <template x-for="notif in notifications" :key="notif.id">
                                <div @click="markAsRead(notif.id)" 
                                     class="px-4 py-3 hover:bg-slate-50 dark:hover:bg-slate-900/50 cursor-pointer border-b border-slate-200/30 dark:border-slate-800/30 transition-colors last:border-b-0"
                                     :class="{ 'opacity-60': notif.read }">
                                    <div class="flex gap-3">
                                        <div class="w-10 h-10 rounded-full flex items-center justify-center flex-shrink-0"
                                             :class="{
                                                 'bg-indigo-500/10 text-indigo-600 dark:text-indigo-400': notif.color === 'indigo',
                                                 'bg-emerald-500/10 text-emerald-600 dark:text-emerald-400': notif.color === 'emerald',
                                                 'bg-purple-500/10 text-purple-600 dark:text-purple-400': notif.color === 'purple'
                                             }">
                                            <i class="fa-solid text-sm" :class="notif.icon"></i>
                                        </div>
                                        <div class="flex-grow min-w-0">
                                            <p class="text-sm font-semibold text-slate-900 dark:text-white" x-text="notif.title"></p>
                                            <p class="text-xs text-slate-500 dark:text-slate-400 mt-0.5" x-text="notif.message"></p>
                                            <p class="text-[10px] text-slate-400 mt-1" x-text="notif.time"></p>
                                        </div>
                                        <div x-show="!notif.read" 
                                             class="w-2 h-2 rounded-full flex-shrink-0 mt-2"
                                             :class="{
                                                 'bg-indigo-500': notif.color === 'indigo',
                                                 'bg-emerald-500': notif.color === 'emerald',
                                                 'bg-purple-500': notif.color === 'purple'
                                             }"></div>
                                    </div>
                                </div>
                            </template>

                            <!-- Empty State -->
                            <div x-show="notifications.length === 0" class="px-4 py-12 text-center">
                                <div class="w-16 h-16 bg-slate-100 dark:bg-slate-900/60 text-slate-400 rounded-2xl flex items-center justify-center mx-auto mb-4 text-2xl">
                                    <i class="fa-solid fa-bell-slash"></i>
                                </div>
                                <p class="text-sm font-semibold text-slate-900 dark:text-white">No notifications</p>
                                <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">You're all caught up!</p>
                            </div>
                        </div>

                        <!-- Footer -->
                        <div class="px-4 py-3 border-t border-slate-200/50 dark:border-slate-800/50 text-center">
                            <button @click="notificationsOpen = false" 
                                    class="text-xs text-indigo-600 dark:text-indigo-400 font-semibold hover:underline cursor-pointer">
                                Close notifications
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Create Note Button -->
                <button @click="createNoteModal = true" class="px-4 h-9 flex items-center justify-center rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white font-semibold text-xs shadow-md shadow-indigo-600/10 hover:shadow-indigo-600/20 hover:-translate-y-0.5 transition-all cursor-pointer">
                    <i class="fa-solid fa-plus mr-2"></i> Create Note
                </button>
            </div>
        </header>

        <!-- Scrollable Dashboard Content -->
        <div class="flex-grow overflow-y-auto p-6 space-y-8 relative z-0">
            <!-- Greeting & Quick Stats -->
            <div>
                <h1 class="text-3xl font-extrabold text-slate-900 dark:text-white">Hello, {{ Auth::user()->name }}</h1>
                <p class="text-sm text-slate-500 mt-1">Here is a quick overview of your notebooks.</p>
            </div>

            <!-- Statistics Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Total Notes -->
                <div class="glass-card rounded-2xl p-6 hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs font-bold uppercase tracking-wider text-slate-400">Total Notes</p>
                            <h3 class="text-3xl font-extrabold text-slate-900 dark:text-white mt-2">{{ $stats['total_notes'] }}</h3>
                        </div>
                        <div class="w-12 h-12 rounded-xl bg-indigo-500/10 text-indigo-600 dark:text-indigo-400 flex items-center justify-center">
                            <i class="fa-solid fa-file-lines text-xl"></i>
                        </div>
                    </div>
                    <p class="text-xs text-emerald-500 font-semibold mt-3">
                        <i class="fa-solid fa-arrow-up"></i> {{ $stats['notes_this_week'] }} this week
                    </p>
                </div>

                <!-- Shared Notes -->
                <div class="glass-card rounded-2xl p-6 hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs font-bold uppercase tracking-wider text-slate-400">Shared Notes</p>
                            <h3 class="text-3xl font-extrabold text-slate-900 dark:text-white mt-2">{{ $stats['shared_notes'] }}</h3>
                        </div>
                        <div class="w-12 h-12 rounded-xl bg-purple-500/10 text-purple-600 dark:text-purple-400 flex items-center justify-center">
                            <i class="fa-solid fa-users text-xl"></i>
                        </div>
                    </div>
                    <p class="text-xs text-slate-400 font-semibold mt-3">
                        Collaborative documents
                    </p>
                </div>

                <!-- Collaborators -->
                <div class="glass-card rounded-2xl p-6 hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs font-bold uppercase tracking-wider text-slate-400">Collaborators</p>
                            <h3 class="text-3xl font-extrabold text-slate-900 dark:text-white mt-2">{{ $stats['total_collaborators'] }}</h3>
                        </div>
                        <div class="w-12 h-12 rounded-xl bg-pink-500/10 text-pink-600 dark:text-pink-400 flex items-center justify-center">
                            <i class="fa-solid fa-user-group text-xl"></i>
                        </div>
                    </div>
                    <p class="text-xs text-slate-400 font-semibold mt-3">
                        Active team members
                    </p>
                </div>

                <!-- Categories -->
                <div class="glass-card rounded-2xl p-6 hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs font-bold uppercase tracking-wider text-slate-400">Categories</p>
                            <h3 class="text-3xl font-extrabold text-slate-900 dark:text-white mt-2">{{ count($categories) }}</h3>
                        </div>
                        <div class="w-12 h-12 rounded-xl bg-amber-500/10 text-amber-600 dark:text-amber-400 flex items-center justify-center">
                            <i class="fa-solid fa-folder text-xl"></i>
                        </div>
                    </div>
                    <p class="text-xs text-slate-400 font-semibold mt-3">
                        Organized folders
                    </p>
                </div>
            </div>

            <!-- Recent Notes Widget -->
            @if ($recentNotes->isNotEmpty() && !$search)
                <div>
                    <h2 class="text-xs font-bold uppercase tracking-wider text-slate-400 mb-4">Recent Notes</h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach ($recentNotes as $recent)
                            <div class="p-6 rounded-2xl glass-card shadow-md hover:shadow-xl hover:-translate-y-0.5 transition-all duration-300 relative flex flex-col justify-between h-40">
                                <div>
                                    <div class="flex items-start justify-between">
                                        <span class="px-2 py-0.5 rounded-lg bg-indigo-100 dark:bg-indigo-900/30 text-[10px] font-bold text-indigo-600 dark:text-indigo-400">
                                            {{ $recent->category }}
                                        </span>
                                        <div class="flex items-center gap-1">
                                            @if ($recent->is_favorite)
                                                <i class="fa-solid fa-star text-amber-400 text-xs"></i>
                                            @endif
                                            @if ($recent->share_token)
                                                <i class="fa-solid fa-link text-indigo-400 text-xs" title="Public Share Active"></i>
                                            @endif
                                        </div>
                                    </div>
                                    <h3 class="text-base font-extrabold text-slate-900 dark:text-white mt-3 truncate">
                                        <a href="{{ route('notes.show', $recent->id) }}" class="hover:underline">{{ $recent->title }}</a>
                                    </h3>
                                    <p class="text-xs text-slate-400 line-clamp-2 mt-1">{{ strip_tags($recent->content) }}</p>
                                </div>
                                <div class="text-[10px] font-medium text-slate-400 flex items-center justify-between border-t border-slate-200/50 dark:border-slate-800/50 pt-3 mt-4">
                                    <span>Updated {{ $recent->updated_at->diffForHumans() }}</span>
                                    <a href="{{ route('notes.show', $recent->id) }}" class="text-indigo-600 dark:text-indigo-400 font-bold hover:underline">
                                        Open <i class="fa-solid fa-arrow-right ml-1"></i>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Pinned Notes Section -->
            @php
                $pinnedNotes = $notes->where('is_pinned', true);
                $unpinnedNotes = $notes->where('is_pinned', false);
            @endphp

            @if ($pinnedNotes->isNotEmpty())
                <div class="mb-8">
                    <h2 class="text-xs font-bold uppercase tracking-wider text-slate-400 mb-4 flex items-center gap-2">
                        <i class="fa-solid fa-thumbtack text-indigo-500"></i> Pinned Notes
                    </h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach ($pinnedNotes as $note)
                            <div class="p-6 rounded-2xl frosted border-2 border-indigo-200/50 dark:border-indigo-800/50 shadow-lg hover:shadow-xl hover:-translate-y-0.5 transition-all duration-300 relative flex flex-col justify-between h-48">
                                <div>
                                    <div class="flex items-start justify-between mb-3">
                                        <span class="px-2 py-0.5 rounded-lg bg-indigo-100 dark:bg-indigo-900/30 text-[10px] font-bold text-indigo-600 dark:text-indigo-400">
                                            {{ $note->category }}
                                        </span>
                                        <div class="flex items-center gap-1">
                                            <i class="fa-solid fa-thumbtack text-indigo-500 text-xs"></i>
                                            @if ($note->is_favorite)
                                                <i class="fa-solid fa-star text-amber-400 text-xs"></i>
                                            @endif
                                        </div>
                                    </div>
                                    <h3 class="text-base font-extrabold text-slate-900 dark:text-white truncate">
                                        <a href="{{ route('notes.show', $note->id) }}" class="hover:underline">{{ $note->title }}</a>
                                    </h3>
                                    <p class="text-xs text-slate-400 line-clamp-2 mt-2">{{ strip_tags($note->content) }}</p>
                                    @if (!empty($note->tags))
                                        <div class="flex flex-wrap gap-1 mt-2">
                                            @foreach (array_slice($note->tags, 0, 3) as $tag)
                                                <span class="px-2 py-0.5 rounded-lg bg-indigo-100 dark:bg-indigo-900/30 text-[10px] font-bold text-indigo-600 dark:text-indigo-400">
                                                    #{{ $tag }}
                                                </span>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                                <div class="text-[10px] font-medium text-slate-400 flex items-center justify-between border-t border-slate-200/50 dark:border-slate-800/50 pt-3 mt-4">
                                    <span>{{ $note->updated_at->diffForHumans() }}</span>
                                    <a href="{{ route('notes.show', $note->id) }}" class="text-indigo-600 dark:text-indigo-400 font-bold hover:underline">
                                        Open <i class="fa-solid fa-arrow-right ml-1"></i>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Main Notes List -->
            <div>
                <div class="flex items-center justify-between mb-4 border-b border-slate-200/50 dark:border-slate-800/50 pb-3">
                    <h2 class="text-xs font-bold uppercase tracking-wider text-slate-400">
                        {{ $filter === 'favorites' ? 'Starred' : ($filter === 'shared_with_me' ? 'Shared' : 'All') }} Documents 
                        @if ($category !== 'All')
                            in "{{ $category }}"
                        @endif
                        ({{ $unpinnedNotes->count() }})
                    </h2>
                </div>

                @if ($unpinnedNotes->isEmpty())
                    <div class="py-16 text-center">
                        <div class="w-16 h-16 bg-slate-100 dark:bg-slate-900/60 text-slate-400 rounded-2xl flex items-center justify-center mx-auto mb-4 text-2xl shadow-inner">
                            <i class="fa-solid fa-notebook"></i>
                        </div>
                        <h3 class="text-lg font-bold text-slate-900 dark:text-white">No documents found</h3>
                        <p class="text-sm text-slate-500 mt-1 max-w-xs mx-auto">Try creating a new document or adjusting your search filters.</p>
                        <button @click="createNoteModal = true" class="mt-4 px-4 h-9 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white font-semibold text-xs shadow-md cursor-pointer">
                            Create First Note
                        </button>
                    </div>
                @else
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="text-[10px] uppercase font-bold text-slate-400 tracking-widest border-b border-slate-200/50 dark:border-slate-800/50">
                                    <th class="pb-3 pl-4">Title</th>
                                    <th class="pb-3 hidden sm:table-cell">Folder</th>
                                    <th class="pb-3 hidden md:table-cell">Last Updated</th>
                                    <th class="pb-3 pr-4 text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-200/50 dark:divide-slate-800/50">
                                @foreach ($unpinnedNotes as $note)
                                    <tr class="group hover:bg-slate-100/40 dark:hover:bg-slate-900/20 transition-all">
                                        <td class="py-4 pl-4">
                                            <div class="flex items-center gap-3">
                                                <div class="w-8 h-8 rounded-lg bg-slate-100 dark:bg-slate-900 text-slate-400 group-hover:text-indigo-500 group-hover:bg-indigo-500/10 flex items-center justify-center transition-all">
                                                    <i class="fa-regular fa-file-lines text-sm"></i>
                                                </div>
                                                <div class="min-w-0">
                                                    <a href="{{ route('notes.show', $note->id) }}" class="font-bold text-sm text-slate-900 dark:text-white hover:underline truncate block">
                                                        {{ $note->title }}
                                                    </a>
                                                    <span class="sm:hidden text-xs text-slate-400 block mt-0.5">{{ $note->category }} &bull; {{ $note->updated_at->diffForHumans() }}</span>
                                                    @if (!empty($note->tags))
                                                        <div class="flex flex-wrap gap-1 mt-1">
                                                            @foreach ($note->tags as $tag)
                                                                <span class="px-2 py-0.5 rounded-lg bg-indigo-100 dark:bg-indigo-900/30 text-[10px] font-bold text-indigo-600 dark:text-indigo-400">
                                                                    #{{ $tag }}
                                                                </span>
                                                            @endforeach
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </td>
                                        <td class="py-4 hidden sm:table-cell">
                                            <span class="px-2 py-0.5 rounded-lg bg-slate-100 dark:bg-slate-900 text-[10px] font-bold text-slate-600 dark:text-slate-400 border border-slate-200/30 dark:border-slate-800/30">
                                                {{ $note->category }}
                                            </span>
                                        </td>
                                        <td class="py-4 hidden md:table-cell text-sm text-slate-400 font-medium">
                                            {{ $note->updated_at->diffForHumans() }}
                                        </td>
                                        <td class="py-4 pr-4 text-right">
                                            <div class="inline-flex items-center gap-2">
                                                <!-- Pin/Unpin button -->
                                                <form action="{{ route('notes.pin', $note->id) }}" method="POST" class="inline">
                                                    @csrf
                                                    <button type="submit" class="p-2 rounded-lg hover:bg-slate-200/80 dark:hover:bg-slate-850 text-slate-400 dark:text-slate-500 cursor-pointer" title="{{ $note->is_pinned ? 'Unpin Note' : 'Pin Note' }}">
                                                        <i class="fa-solid fa-thumbtack text-sm {{ $note->is_pinned ? 'text-indigo-500' : 'opacity-40 group-hover:opacity-100' }}"></i>
                                                    </button>
                                                </form>

                                                <!-- Star/Unstar button -->
                                                <form action="{{ route('notes.favorite', $note->id) }}" method="POST" class="inline">
                                                    @csrf
                                                    <button type="submit" class="p-2 rounded-lg hover:bg-slate-200/80 dark:hover:bg-slate-850 text-slate-400 dark:text-slate-500 cursor-pointer">
                                                        <i class="fa-solid fa-star text-sm {{ $note->is_favorite ? 'text-amber-400' : 'opacity-40 group-hover:opacity-100' }}"></i>
                                                    </button>
                                                </form>

                                                <!-- Edit button -->
                                                <a href="{{ route('notes.show', $note->id) }}" class="p-2 rounded-lg hover:bg-slate-200/80 dark:hover:bg-slate-850 text-slate-400 dark:text-slate-500 cursor-pointer" title="Edit Note">
                                                    <i class="fa-regular fa-pen-to-square text-sm"></i>
                                                </a>

                                                <!-- Delete button (Only owner can delete) -->
                                                @if ($note->user_id === Auth::id())
                                                    <form action="{{ route('notes.destroy', $note->id) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this note?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="p-2 rounded-lg hover:bg-rose-500/10 text-slate-400 dark:text-slate-500 hover:text-rose-500 cursor-pointer" title="Delete Note">
                                                            <i class="fa-regular fa-trash-can text-sm"></i>
                                                        </button>
                                                    </form>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </main>

    <!-- Create Note Modal -->
    <div x-show="createNoteModal" class="fixed inset-0 z-50 flex items-center justify-center p-4" x-cloak>
        <!-- Backdrop -->
        <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm" @click="createNoteModal = false" x-transition:enter="transition-opacity ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"></div>

        <!-- Card container -->
        <div class="w-full max-w-md frosted rounded-2xl shadow-2xl p-6 relative z-10"
             x-transition:enter="transition ease-out duration-300 transform"
             x-transition:enter-start="opacity-0 translate-y-4 scale-95"
             x-transition:enter-end="opacity-100 translate-y-0 scale-100"
             x-transition:leave="transition ease-in duration-200 transform"
             x-transition:leave-start="opacity-100 translate-y-0 scale-100"
             x-transition:leave-end="opacity-0 translate-y-4 scale-95">
            
            <div class="flex items-center justify-between border-b border-slate-200/50 dark:border-slate-800/50 pb-3 mb-5">
                <h3 class="text-lg font-bold text-slate-900 dark:text-white">Create New Note</h3>
                <button @click="createNoteModal = false" class="text-slate-400 hover:text-slate-600 dark:hover:text-slate-200">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>

            <form action="{{ route('notes.store') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label for="title" class="block text-xs font-semibold uppercase tracking-wider text-slate-500 mb-2">Note Title</label>
                    <input type="text" id="title" name="title" required
                           class="block w-full px-4 py-2.5 rounded-xl border border-slate-200 dark:border-slate-800 bg-white/50 dark:bg-slate-950/50 text-slate-950 dark:text-white focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent text-sm"
                           placeholder="E.g., Algorithms Revision">
                </div>

                <div>
                    <label for="category" class="block text-xs font-semibold uppercase tracking-wider text-slate-500 mb-2">Folder / Tag</label>
                    <input type="text" id="category" name="category" list="folders"
                           class="block w-full px-4 py-2.5 rounded-xl border border-slate-200 dark:border-slate-800 bg-white/50 dark:bg-slate-950/50 text-slate-950 dark:text-white focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent text-sm"
                           placeholder="E.g., College, Personal (default: Uncategorized)">
                    <datalist id="folders">
                        @foreach ($categories as $cat)
                            <option value="{{ $cat }}">
                        @endforeach
                    </datalist>
                </div>

                <div>
                    <label for="tags" class="block text-xs font-semibold uppercase tracking-wider text-slate-500 mb-2">
                        Tags (comma-separated)
                    </label>
                    <input type="text" 
                           id="tags" 
                           name="tags"
                           class="block w-full px-4 py-2.5 rounded-xl border border-slate-200 dark:border-slate-800 bg-white/50 dark:bg-slate-950/50 text-slate-950 dark:text-white focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent text-sm"
                           placeholder="work, important, urgent">
                    <p class="text-xs text-slate-400 mt-1">Separate tags with commas</p>
                </div>

                <div class="flex justify-end gap-3 pt-3">
                    <button type="button" @click="createNoteModal = false" class="px-4 h-10 rounded-xl border border-slate-200 dark:border-slate-800 text-slate-700 dark:text-slate-300 font-semibold text-xs hover:bg-slate-100 dark:hover:bg-slate-800/80 cursor-pointer">
                        Cancel
                    </button>
                    <button type="submit" class="px-4 h-10 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white font-semibold text-xs shadow-md cursor-pointer">
                        Create Document
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
