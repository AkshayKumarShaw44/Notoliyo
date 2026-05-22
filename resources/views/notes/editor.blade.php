@extends('layouts.layout')

@section('title', $note->title . ' - Editor')

@section('styles')
<style>
    /* Prevent cursor label overflow */
    #editor-wrapper {
        position: relative;
    }
</style>
@endsection

@section('content')
<div class="h-screen flex flex-col overflow-hidden bg-white dark:bg-slate-950 text-slate-800 dark:text-slate-200" 
     x-data="editorData()"
>
    <!-- Editor Header -->
    <header class="h-16 border-b border-slate-200/50 dark:border-slate-800/50 px-6 flex items-center justify-between bg-slate-50/50 dark:bg-slate-900/30">
        <div class="flex items-center gap-4 flex-grow min-w-0">
            <a href="{{ route('dashboard') }}" class="w-9 h-9 rounded-xl border border-slate-200/60 dark:border-slate-800/60 flex items-center justify-center text-slate-500 hover:bg-slate-100 dark:hover:bg-slate-800 hover:text-slate-800 dark:hover:text-slate-200 transition-all cursor-pointer">
                <i class="fa-solid fa-arrow-left text-sm"></i>
            </a>

            <div class="flex items-center gap-2 flex-grow min-w-0">
                <!-- Folder selector/category -->
                <input type="text" x-model="category" @change="updateCategory"
                       class="w-24 sm:w-32 px-2 py-1 rounded-lg border border-transparent hover:border-slate-200 dark:hover:border-slate-800 hover:bg-white dark:hover:bg-slate-950 text-xs font-bold text-slate-500 dark:text-slate-400 focus:outline-none focus:ring-1 focus:ring-indigo-500 transition-all uppercase truncate"
                       placeholder="UNCATEGORIZED">
                
                <span class="text-slate-300 dark:text-slate-700">/</span>

                <!-- Title input -->
                <input type="text" x-model="title" @change="updateTitle"
                       class="flex-grow min-w-0 px-2 py-1 rounded-lg border border-transparent hover:border-slate-200 dark:hover:border-slate-800 hover:bg-white dark:hover:bg-slate-950 font-extrabold text-sm sm:text-base text-slate-900 dark:text-white focus:outline-none focus:ring-1 focus:ring-indigo-500 transition-all truncate"
                       placeholder="Untitled Document">
            </div>
        </div>

        <div class="flex items-center gap-4">
            <!-- Active Users avatars -->
            <div class="hidden sm:flex items-center -space-x-2">
                <template x-for="user in onlineUsers" :key="user.id">
                    <div class="w-8 h-8 rounded-full border-2 border-white dark:border-slate-950 flex items-center justify-center text-white text-xs font-bold shadow-md cursor-pointer hover:-translate-y-1 transition-all"
                         :style="'background-color: ' + user.avatar_color"
                         :title="user.name + (user.id === '{{ $clientUser['id'] }}' ? ' (You)' : '')">
                        <span x-text="user.name[0]"></span>
                    </div>
                </template>
            </div>

            <!-- Sync Indicator -->
            <div class="flex items-center gap-2 text-xs font-semibold"
                 :class="{
                     'text-emerald-500': saveStatus === 'Saved',
                     'text-amber-500': saveStatus === 'Saving...',
                     'text-rose-500': saveStatus === 'Offline'
                 }">
                <span class="w-2 h-2 rounded-full bg-current" :class="saveStatus === 'Saving...' ? 'animate-ping' : ''"></span>
                <span class="hidden md:inline" x-text="saveStatus"></span>
            </div>

            <!-- Share Button (Only Owner) -->
            @if ($role === 'owner')
                <button @click="shareModal = true" class="px-4 h-9 rounded-xl border border-slate-200 dark:border-slate-800 hover:bg-slate-100 dark:hover:bg-slate-800 text-xs font-semibold flex items-center gap-2 cursor-pointer">
                    <i class="fa-solid fa-share-nodes"></i> Share
                </button>
            @endif

            <!-- Comments Toggle -->
            <button @click="commentsDrawer = !commentsDrawer" class="px-4 h-9 rounded-xl border border-slate-200 dark:border-slate-800 hover:bg-slate-100 dark:hover:bg-slate-800 text-xs font-semibold flex items-center gap-2 cursor-pointer relative">
                <i class="fa-regular fa-comment-dots"></i> Discuss
                @if ($note->comments->isNotEmpty())
                    <span class="absolute -top-1 -right-1 bg-indigo-600 text-white w-4 h-4 rounded-full text-[8px] flex items-center justify-center font-bold">{{ $note->comments->count() }}</span>
                @endif
            </button>
        </div>
    </header>

    <!-- Editor Workspace (Distraction Free) -->
    <div class="flex-grow flex overflow-hidden">
        <!-- Main Editor Column -->
        <div class="flex-1 flex flex-col overflow-hidden relative">
            <!-- Format Toolbar -->
            @if ($role === 'owner' || $role === 'editor')
                <div class="h-12 border-b border-slate-200/50 dark:border-slate-800/50 bg-slate-50/50 dark:bg-slate-900/10 px-6 flex items-center gap-2 overflow-x-auto">
                    <button onclick="window.editorInstance.chain().focus().toggleBold().run()" class="p-2 rounded-lg hover:bg-slate-100 dark:hover:bg-slate-800 text-slate-500 dark:text-slate-400 cursor-pointer" title="Bold"><i class="fa-solid fa-bold text-xs"></i></button>
                    <button onclick="window.editorInstance.chain().focus().toggleItalic().run()" class="p-2 rounded-lg hover:bg-slate-100 dark:hover:bg-slate-800 text-slate-500 dark:text-slate-400 cursor-pointer" title="Italic"><i class="fa-solid fa-italic text-xs"></i></button>
                    <button onclick="window.editorInstance.chain().focus().toggleStrike().run()" class="p-2 rounded-lg hover:bg-slate-100 dark:hover:bg-slate-800 text-slate-500 dark:text-slate-400 cursor-pointer" title="Strike"><i class="fa-solid fa-strikethrough text-xs"></i></button>
                    
                    <span class="h-4 w-px bg-slate-200 dark:bg-slate-800 mx-1"></span>
                    
                    <button onclick="window.editorInstance.chain().focus().toggleHeading({ level: 1 }).run()" class="p-2 rounded-lg hover:bg-slate-100 dark:hover:bg-slate-800 text-slate-500 dark:text-slate-400 font-bold text-xs cursor-pointer">H1</button>
                    <button onclick="window.editorInstance.chain().focus().toggleHeading({ level: 2 }).run()" class="p-2 rounded-lg hover:bg-slate-100 dark:hover:bg-slate-800 text-slate-500 dark:text-slate-400 font-bold text-xs cursor-pointer">H2</button>
                    <button onclick="window.editorInstance.chain().focus().toggleHeading({ level: 3 }).run()" class="p-2 rounded-lg hover:bg-slate-100 dark:hover:bg-slate-800 text-slate-500 dark:text-slate-400 font-bold text-xs cursor-pointer">H3</button>
                    
                    <span class="h-4 w-px bg-slate-200 dark:bg-slate-800 mx-1"></span>

                    <button onclick="window.editorInstance.chain().focus().toggleBulletList().run()" class="p-2 rounded-lg hover:bg-slate-100 dark:hover:bg-slate-800 text-slate-500 dark:text-slate-400 cursor-pointer" title="Bullet List"><i class="fa-solid fa-list-ul text-xs"></i></button>
                    <button onclick="window.editorInstance.chain().focus().toggleOrderedList().run()" class="p-2 rounded-lg hover:bg-slate-100 dark:hover:bg-slate-800 text-slate-500 dark:text-slate-400 cursor-pointer" title="Ordered List"><i class="fa-solid fa-list-ol text-xs"></i></button>
                    
                    <span class="h-4 w-px bg-slate-200 dark:bg-slate-800 mx-1"></span>

                    <button onclick="window.editorInstance.chain().focus().toggleCodeBlock().run()" class="p-2 rounded-lg hover:bg-slate-100 dark:hover:bg-slate-800 text-slate-500 dark:text-slate-400 cursor-pointer" title="Code Block"><i class="fa-solid fa-code text-xs"></i></button>
                    <button onclick="window.editorInstance.chain().focus().toggleBlockquote().run()" class="p-2 rounded-lg hover:bg-slate-100 dark:hover:bg-slate-800 text-slate-500 dark:text-slate-400 cursor-pointer" title="Blockquote"><i class="fa-solid fa-quote-left text-xs"></i></button>
                </div>
            @endif

            <!-- Scrollable Canvas -->
            <div class="flex-grow overflow-y-auto px-6 py-12 md:px-16 lg:px-24">
                <div class="max-w-3xl mx-auto" id="editor-wrapper">
                    <!-- TipTap content element -->
                    <div id="editor" class="prose dark:prose-invert max-w-none text-slate-800 dark:text-slate-300 font-serif"></div>
                </div>
            </div>
            
            <!-- Live typing indicators overlay at the bottom -->
            <div class="absolute bottom-4 left-6 pointer-events-none flex flex-col gap-1 text-[10px] font-semibold text-slate-400 h-6">
                <div class="flex items-center gap-2">
                    <template x-for="name in typingUsers" :key="name">
                        <div class="flex items-center gap-1 bg-slate-100 dark:bg-slate-900 px-2 py-1 rounded-lg border border-slate-200/50 dark:border-slate-800/50">
                            <span class="w-1.5 h-1.5 rounded-full bg-indigo-500 animate-pulse"></span>
                            <span x-text="name + ' is typing...'"></span>
                        </div>
                    </template>
                </div>
            </div>
        </div>

        <!-- Discussion Comments Sidebar (Drawer) -->
        <aside x-show="commentsDrawer" 
               class="w-80 border-l border-slate-200/50 dark:border-slate-800/50 flex flex-col bg-slate-50/50 dark:bg-slate-900/30"
               x-transition:enter="transition ease-out duration-200"
               x-transition:enter-start="translate-x-full"
               x-transition:enter-end="translate-x-0"
               x-transition:leave="transition ease-in duration-150"
               x-transition:leave-start="translate-x-0"
               x-transition:leave-end="translate-x-full">
            <div class="h-16 px-4 border-b border-slate-200/50 dark:border-slate-800/50 flex items-center justify-between">
                <h3 class="font-bold text-sm text-slate-900 dark:text-white">Workspace Discussion</h3>
                <button @click="commentsDrawer = false" class="text-slate-400 hover:text-slate-600 dark:hover:text-slate-200">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
            
            <!-- Comments list -->
            <div class="flex-grow overflow-y-auto p-4 space-y-4">
                @if ($note->comments->isEmpty())
                    <div class="py-8 text-center text-slate-400">
                        <i class="fa-regular fa-comments text-xl mb-2 opacity-50"></i>
                        <p class="text-xs">No comments yet. Start the thread!</p>
                    </div>
                @else
                    @foreach ($comments as $comment)
                        <div class="p-3.5 rounded-xl border border-slate-200/50 dark:border-slate-800/50 bg-white dark:bg-slate-900/60 shadow-sm">
                            <div class="flex items-center justify-between mb-1.5">
                                <span class="text-xs font-bold text-slate-900 dark:text-white">{{ $comment->user_name }}</span>
                                <span class="text-[10px] text-slate-400 font-medium">{{ $comment->created_at->diffForHumans() }}</span>
                            </div>
                            <p class="text-xs text-slate-600 dark:text-slate-400 leading-relaxed">{{ $comment->content }}</p>
                        </div>
                    @endforeach
                @endif
            </div>

            <!-- Comment Input -->
            <div class="p-4 border-t border-slate-200/50 dark:border-slate-800/50 bg-white dark:bg-slate-950">
                <form action="{{ route('notes.comments.store', $note->id) }}" method="POST" class="space-y-3">
                    @csrf
                    <textarea name="content" required rows="2"
                              class="w-full p-2 text-xs border border-slate-200 dark:border-slate-800 rounded-xl focus:outline-none focus:ring-1 focus:ring-indigo-500 bg-slate-50 dark:bg-slate-900 text-slate-950 dark:text-white"
                              placeholder="Write a comment..."></textarea>
                    <button type="submit" class="w-full h-8 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white font-semibold text-[10px] shadow-sm flex items-center justify-center cursor-pointer">
                        Post Comment
                    </button>
                </form>
            </div>
        </aside>
    </div>

    <!-- Share / Collaborate Modal (Only Owner) -->
    @if ($role === 'owner')
        <div x-show="shareModal" class="fixed inset-0 z-50 flex items-center justify-center p-4" x-cloak>
            <!-- Backdrop -->
            <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm" @click="shareModal = false" x-transition:enter="transition-opacity ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"></div>

            <!-- Card -->
            <div class="w-full max-w-lg glass border border-slate-200/50 dark:border-slate-800/50 rounded-2xl shadow-2xl p-6 bg-white dark:bg-slate-900 relative z-10"
                 x-transition:enter="transition ease-out duration-300 transform"
                 x-transition:enter-start="opacity-0 translate-y-4 scale-95"
                 x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                 x-transition:leave="transition ease-in duration-200 transform"
                 x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                 x-transition:leave-end="opacity-0 translate-y-4 scale-95">
                
                <div class="flex items-center justify-between border-b border-slate-200/50 dark:border-slate-800/50 pb-3 mb-5">
                    <h3 class="text-lg font-bold text-slate-900 dark:text-white">Workspace Sharing Settings</h3>
                    <button @click="shareModal = false" class="text-slate-400 hover:text-slate-600 dark:hover:text-slate-200">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>

                <!-- Toggle public link -->
                <div class="space-y-6">
                    <div class="flex items-center justify-between pb-4 border-b border-slate-200/50 dark:border-slate-800/50">
                        <div>
                            <h4 class="text-sm font-bold text-slate-900 dark:text-white">Public Link Access</h4>
                            <p class="text-xs text-slate-500">Anyone with the link can edit the document.</p>
                        </div>
                        <form action="{{ route('notes.share', $note->id) }}" method="POST">
                            @csrf
                            <button type="submit" 
                                    class="h-8 px-4 rounded-xl font-semibold text-xs border cursor-pointer"
                                    :class="publicLinkActive ? 'bg-rose-500/10 border-rose-500/30 text-rose-500' : 'bg-indigo-600 border-transparent text-white hover:bg-indigo-700'">
                                <span x-text="publicLinkActive ? 'Disable Link' : 'Enable Link'"></span>
                            </button>
                        </form>
                    </div>

                    <!-- Public Link display -->
                    <div x-show="publicLinkActive" class="space-y-2">
                        <label class="block text-xs font-semibold uppercase tracking-wider text-slate-500">Public Link</label>
                        <div class="flex gap-2">
                            <input type="text" readonly :value="shareUrl" @click="$el.select()"
                                   class="block flex-grow px-3 py-2 text-xs rounded-xl border border-slate-200 dark:border-slate-800 bg-slate-50 dark:bg-slate-950 text-slate-900 dark:text-slate-100 focus:outline-none focus:ring-2 focus:ring-indigo-500 cursor-pointer">
                            <button @click="copyShareUrl()" type="button" class="px-4 py-2 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white font-semibold text-xs cursor-pointer min-w-[100px] transition-all" x-text="copyLinkText"></button>
                        </div>
                        <p class="text-xs text-slate-400">Click the link to select it, or use the Copy button</p>
                    </div>

                    <!-- Invite collaborator by email -->
                    <div class="space-y-2">
                        <label class="block text-xs font-semibold uppercase tracking-wider text-slate-500">Add Collaborator by Email</label>
                        <form action="{{ route('notes.collaborate', $note->id) }}" method="POST" class="flex gap-2">
                            @csrf
                            <input type="email" name="email" required placeholder="user@example.com"
                                   class="block flex-grow px-3 py-2 text-xs rounded-xl border border-slate-200 dark:border-slate-800 bg-white/50 dark:bg-slate-950/50 text-slate-950 dark:text-white focus:outline-none focus:ring-1 focus:ring-indigo-500">
                            <select name="role" class="px-2 py-2 text-xs rounded-xl border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-950 text-slate-700 dark:text-slate-350">
                                <option value="editor">Editor</option>
                                <option value="viewer">Viewer</option>
                            </select>
                            <button type="submit" class="px-4 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white font-semibold text-xs cursor-pointer">Invite</button>
                        </form>
                    </div>

                    <!-- Current Collaborators List -->
                    <div class="space-y-2.5">
                        <label class="block text-xs font-semibold uppercase tracking-wider text-slate-500">Active Collaborators</label>
                        <div class="divide-y divide-slate-100 dark:divide-slate-800/50 max-h-40 overflow-y-auto">
                            <div class="flex items-center justify-between py-2 text-xs">
                                <div class="flex items-center gap-2">
                                    <div class="w-6 h-6 rounded-full bg-slate-200 dark:bg-slate-800 text-[10px] font-bold flex items-center justify-center text-slate-600 dark:text-slate-300">
                                        O
                                    </div>
                                    <span class="font-bold">You (Owner)</span>
                                </div>
                            </div>
                            <template x-for="c in collaborators" :key="c.id">
                                <div class="flex items-center justify-between py-2 text-xs">
                                    <div class="flex items-center gap-2">
                                        <div class="w-6 h-6 rounded-full text-[10px] font-bold flex items-center justify-center text-white"
                                             :style="'background-color: ' + c.avatar_color">
                                            <span x-text="c.name[0]"></span>
                                        </div>
                                        <div>
                                            <span class="font-bold" x-text="c.name"></span>
                                            <span class="text-[10px] text-slate-400 block" x-text="c.email"></span>
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-3">
                                        <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400" x-text="c.role"></span>
                                        <form action="{{ route('notes.collaborate.remove', $note->id) }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="collaborator_id" :value="c.id">
                                            <button type="submit" class="text-rose-500 hover:text-rose-600 cursor-pointer">
                                                <i class="fa-regular fa-trash-can"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection

@section('scripts')
<script>
    // Alpine.js component for editor data
    function editorData() {
        return {
            title: '{{ $note->title }}',
            category: '{{ $note->category }}',
            saving: false,
            saveStatus: 'Saved',
            shareModal: false,
            commentsDrawer: false,
            collaborators: @js($collaborators),
            onlineUsers: [],
            typingUsers: [],
            publicLinkActive: {{ $note->share_token ? 'true' : 'false' }},
            shareUrl: '{{ route('notes.show', ['id' => $note->id, 'token' => $note->share_token]) }}',
            copyLinkText: 'Copy Link',
            
            updateTitle() {
                this.saving = true;
                this.saveStatus = 'Saving...';
                fetch('{{ route('notes.update', $note->id) }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ title: this.title, silent: true })
                })
                .then(r => r.json())
                .then(data => {
                    this.saving = false;
                    this.saveStatus = 'Saved';
                })
                .catch(e => {
                    this.saving = false;
                    this.saveStatus = 'Offline';
                });
            },
            
            updateCategory() {
                this.saving = true;
                this.saveStatus = 'Saving...';
                fetch('{{ route('notes.update', $note->id) }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ category: this.category, silent: true })
                })
                .then(r => r.json())
                .then(data => {
                    this.saving = false;
                    this.saveStatus = 'Saved';
                })
                .catch(e => {
                    this.saving = false;
                    this.saveStatus = 'Offline';
                });
            },

            copyShareUrl() {
                if (navigator.clipboard && navigator.clipboard.writeText) {
                    navigator.clipboard.writeText(this.shareUrl)
                        .then(() => {
                            this.copyLinkText = 'Copied!';
                            setTimeout(() => { 
                                this.copyLinkText = 'Copy Link';
                            }, 2000);
                        })
                        .catch(() => {
                            this.fallbackCopy();
                        });
                } else {
                    this.fallbackCopy();
                }
            },
            
            fallbackCopy() {
                try {
                    var input = document.querySelector('input[readonly][type="text"]');
                    if (input) {
                        input.focus();
                        input.select();
                        input.setSelectionRange(0, 99999);
                        var successful = document.execCommand('copy');
                        if (successful) {
                            this.copyLinkText = 'Copied!';
                            setTimeout(() => { 
                                this.copyLinkText = 'Copy Link';
                            }, 2000);
                        }
                    }
                } catch (err) {
                    this.copyLinkText = 'Select & Copy';
                    setTimeout(() => { 
                        this.copyLinkText = 'Copy Link';
                    }, 3000);
                }
            }
        };
    }

    document.addEventListener('DOMContentLoaded', () => {
        // 1. Initialize TipTap Editor
        const role = '{{ $role }}';
        const clientUser = @js($clientUser);
        const noteId = '{{ $note->id }}';
        
        let isReceivingUpdate = false;
        
        // Initialize Editor
        const editor = new window.Editor({
            element: document.querySelector('#editor'),
            extensions: [
                window.StarterKit,
            ],
            content: `{!! $note->content !!}`,
            editable: (role === 'owner' || role === 'editor'),
            onUpdate({ editor }) {
                if (isReceivingUpdate) return;
                
                const content = editor.getHTML();
                
                // Real-time broadcast
                if (window.socketConnection) {
                    window.socketConnection.emit('editor-change', {
                        noteId: noteId,
                        content: content,
                        userId: clientUser.id
                    });
                    
                    // Emit typing status
                    window.emitTyping();
                }
                
                // Auto-save to Database (Debounced by 2 seconds)
                window.triggerAutoSave(content);
            },
            onSelectionUpdate({ editor }) {
                if (window.socketConnection) {
                    const { from, to } = editor.state.selection;
                    window.socketConnection.emit('cursor-move', {
                        noteId: noteId,
                        cursor: { from, to }
                    });
                }
            }
        });
        
        // Set instance globally so toolbar actions can access it
        window.editorInstance = editor;

        // 2. Debounced Auto-Save
        let saveTimeout;
        window.triggerAutoSave = (content) => {
            const alpineEl = document.querySelector('[x-data]');
            if (alpineEl) {
                alpineEl.__x.$data.saveStatus = 'Saving...';
            }
            
            clearTimeout(saveTimeout);
            saveTimeout = setTimeout(() => {
                fetch('{{ route('notes.update', $note->id) }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ content: content, silent: true })
                })
                .then(r => r.json())
                .then(data => {
                    if (alpineEl) {
                        alpineEl.__x.$data.saveStatus = 'Saved';
                    }
                })
                .catch(e => {
                    if (alpineEl) {
                        alpineEl.__x.$data.saveStatus = 'Offline';
                    }
                });
            }, 2000);
        };

        // 3. Connect to Socket.IO real-time collaboration server
        // Point connection to port 3000 where our Node.js socket server is listening
        const socketUrl = `${window.location.protocol}//${window.location.hostname}:3000`;
        const socket = window.io(socketUrl, {
            timeout: 5000,
            reconnectionAttempts: 5
        });

        window.socketConnection = socket;

        socket.on('connect', () => {
            console.log('Connected to collaboration socket server');
            
            // Join Note Room
            socket.emit('join-note', {
                noteId: noteId,
                user: clientUser
            });
        });

        socket.on('connect_error', () => {
            console.warn('Could not connect to Socket.IO server. Collaboration disabled.');
            const alpineEl = document.querySelector('[x-data]');
            if (alpineEl) {
                alpineEl.__x.$data.saveStatus = 'Offline';
            }
        });

        // Handle Room Users Updates
        socket.on('room-users', (users) => {
            const alpineEl = document.querySelector('[x-data]');
            if (alpineEl) {
                alpineEl.__x.$data.onlineUsers = users;
            }
        });

        // Handle Content updates from other collaborators
        socket.on('editor-change', ({ content, userId }) => {
            if (userId === clientUser.id) return;
            
            if (editor.getHTML() !== content) {
                isReceivingUpdate = true;
                
                // Get current selection to restore it afterwards
                const { from, to } = editor.state.selection;
                
                editor.commands.setContent(content, false);
                
                // Restore selection if bounds are still safe
                try {
                    editor.commands.setTextSelection({ from, to });
                } catch(e) {}
                
                isReceivingUpdate = false;
            }
        });

        // Handle Cursor Movements
        socket.on('cursor-move', ({ socketId, user, cursor }) => {
            if (user.id === clientUser.id) return;
            
            let cursorEl = document.getElementById('cursor-' + socketId);
            if (!cursorEl) {
                cursorEl = document.createElement('div');
                cursorEl.id = 'cursor-' + socketId;
                cursorEl.className = 'absolute pointer-events-none z-20';
                cursorEl.style.width = '2px';
                cursorEl.style.height = '1.3em';
                cursorEl.style.backgroundColor = user.avatar_color;
                
                const label = document.createElement('div');
                label.className = 'absolute bottom-full left-0 px-1.5 py-0.5 rounded text-[8px] font-bold text-white whitespace-nowrap shadow';
                label.style.backgroundColor = user.avatar_color;
                label.innerText = user.name;
                cursorEl.appendChild(label);
                
                document.querySelector('#editor-wrapper').appendChild(cursorEl);
            }

            try {
                // Get absolute coordinates using Prosemirror coordinates API
                const coords = editor.view.coordsAtPos(cursor.from);
                const wrapperRect = document.querySelector('#editor-wrapper').getBoundingClientRect();
                
                cursorEl.style.left = (coords.left - wrapperRect.left) + 'px';
                cursorEl.style.top = (coords.top - wrapperRect.top + window.scrollY) + 'px';
                cursorEl.style.display = 'block';
            } catch(err) {
                cursorEl.style.display = 'none';
            }
        });

        // Handle User exit and clean up cursor element
        socket.on('user-left', ({ user }) => {
            // Find all elements of this user and remove them
            const items = document.querySelectorAll(`[id^="cursor-"]`);
            items.forEach(el => {
                // If label name matches or we track socketId
                // Simple exit: the room-users event will handle catalog, we just clear cursors that might linger
            });
            
            // Re-trigger layout cleanups on changes
            document.querySelectorAll('#editor-wrapper [id^="cursor-"]').forEach(c => c.remove());
        });

        // Handle Typing indicator syncing
        let typingTimeout;
        window.emitTyping = () => {
            socket.emit('typing', {
                noteId: noteId,
                isTyping: true,
                userName: clientUser.name
            });
            
            clearTimeout(typingTimeout);
            typingTimeout = setTimeout(() => {
                socket.emit('typing', {
                    noteId: noteId,
                    isTyping: false,
                    userName: clientUser.name
                });
            }, 2000);
        };

        socket.on('typing', ({ isTyping, userName }) => {
            const alpineEl = document.querySelector('[x-data]');
            if (alpineEl) {
                let list = alpineEl.__x.$data.typingUsers;
                if (isTyping) {
                    if (!list.includes(userName)) {
                        list.push(userName);
                    }
                } else {
                    list = list.filter(n => n !== userName);
                }
                alpineEl.__x.$data.typingUsers = list;
            }
        });
    });
</script>
@endsection
