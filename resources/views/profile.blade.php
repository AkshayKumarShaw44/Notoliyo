@extends('layouts.layout')

@section('title', 'Profile & Settings - Notoliyo')

@section('content')
<div class="h-screen flex overflow-hidden bg-slate-50 dark:bg-slate-950" x-data="{ sidebarOpen: false }">

    <!-- Mobile Sidebar Backdrop -->
    <div x-show="sidebarOpen" class="fixed inset-0 z-30 bg-slate-900/40 backdrop-blur-sm md:hidden" @click="sidebarOpen = false" x-transition:enter="transition-opacity ease-linear duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity ease-linear duration-300" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"></div>

    <!-- Sidebar Layout -->
    <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full md:translate-x-0'" class="fixed inset-y-0 left-0 z-40 w-64 glass border-r border-slate-200/50 dark:border-slate-800/50 flex flex-col transition-transform duration-300 ease-in-out md:static md:h-full">
        <!-- Sidebar Header -->
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
        <div class="flex-1 overflow-y-auto px-4 py-6">
            <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-3 py-2 rounded-xl text-sm font-semibold text-slate-600 dark:text-slate-400 hover:bg-slate-200/50 dark:hover:bg-slate-800/50 transition-all">
                <i class="fa-solid fa-arrow-left w-5 text-left text-base"></i> Back to Notes
            </a>
        </div>

        <!-- Profile footer -->
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
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full h-9 rounded-xl border border-slate-200/60 dark:border-slate-800/60 hover:bg-rose-500/10 hover:text-rose-500 hover:border-rose-500/30 flex items-center justify-center text-xs font-semibold text-slate-600 dark:text-slate-350 cursor-pointer">
                    <i class="fa-solid fa-arrow-right-from-bracket mr-2 text-xs"></i> Log Out
                </button>
            </form>
        </div>
    </aside>

    <!-- Main settings area -->
    <main class="flex-1 flex flex-col overflow-hidden">
        <!-- Header -->
        <header class="h-16 px-6 border-b border-slate-200/50 dark:border-slate-800/50 flex items-center justify-between bg-white dark:bg-slate-950">
            <div class="flex items-center gap-4">
                <button @click="sidebarOpen = true" class="md:hidden text-slate-500 hover:text-slate-700">
                    <i class="fa-solid fa-bars text-lg"></i>
                </button>
                <h1 class="text-lg font-bold text-slate-900 dark:text-white">Account Settings</h1>
            </div>
        </header>

        <!-- Profile Panels -->
        <div class="flex-grow overflow-y-auto p-6 lg:p-8 grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Left 2 Columns: Edit Form -->
            <div class="lg:col-span-2 space-y-6">
                <div class="glass border border-slate-200/50 dark:border-slate-800/50 rounded-2xl p-6 bg-white dark:bg-slate-900">
                    <h2 class="text-base font-extrabold text-slate-900 dark:text-white mb-6">Profile Information</h2>
                    
                    <form action="{{ route('profile.update') }}" method="POST" class="space-y-6" x-data="{ selectedColor: '{{ $user->avatar_color }}' }">
                        @csrf
                        
                        <!-- Color palette selection -->
                        <div>
                            <label class="block text-xs font-semibold uppercase tracking-wider text-slate-500 mb-3">Collaborator Cursor & Avatar Color</label>
                            <input type="hidden" name="avatar_color" x-model="selectedColor">
                            <div class="flex flex-wrap gap-3">
                                @foreach (['#EF4444', '#3B82F6', '#10B981', '#F59E0B', '#8B5CF6', '#EC4899', '#06B6D4', '#14B8A6', '#6366F1'] as $color)
                                    <button type="button" @click="selectedColor = '{{ $color }}'"
                                            class="w-10 h-10 rounded-full border-2 transition-all flex items-center justify-center cursor-pointer shadow-sm hover:scale-105"
                                            :class="selectedColor === '{{ $color }}' ? 'border-indigo-600 scale-105 shadow-md shadow-indigo-600/10' : 'border-transparent'"
                                            style="background-color: {{ $color }}">
                                        <i class="fa-solid fa-check text-white text-xs" x-show="selectedColor === '{{ $color }}'"></i>
                                    </button>
                                @endforeach
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label for="name" class="block text-xs font-semibold uppercase tracking-wider text-slate-500 mb-2">Display Name</label>
                                <input type="text" id="name" name="name" required value="{{ old('name', $user->name) }}"
                                       class="block w-full px-4 py-2.5 rounded-xl border border-slate-200 dark:border-slate-800 bg-white/50 dark:bg-slate-950/50 text-slate-950 dark:text-white focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent text-sm">
                                @error('name')
                                    <p class="mt-1 text-xs text-rose-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="email" class="block text-xs font-semibold uppercase tracking-wider text-slate-500 mb-2">Email Address</label>
                                <input type="email" id="email" name="email" required value="{{ old('email', $user->email) }}"
                                       class="block w-full px-4 py-2.5 rounded-xl border border-slate-200 dark:border-slate-800 bg-white/50 dark:bg-slate-950/50 text-slate-950 dark:text-white focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent text-sm">
                                @error('email')
                                    <p class="mt-1 text-xs text-rose-500">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <hr class="border-slate-200/50 dark:border-slate-800/50">

                        <h3 class="text-sm font-bold text-slate-900 dark:text-white">Change Password (Optional)</h3>
                        
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label for="password" class="block text-xs font-semibold uppercase tracking-wider text-slate-500 mb-2">New Password</label>
                                <input type="password" id="password" name="password"
                                       class="block w-full px-4 py-2.5 rounded-xl border border-slate-200 dark:border-slate-800 bg-white/50 dark:bg-slate-950/50 text-slate-950 dark:text-white focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent text-sm"
                                       placeholder="••••••••">
                                @error('password')
                                    <p class="mt-1 text-xs text-rose-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="password_confirmation" class="block text-xs font-semibold uppercase tracking-wider text-slate-500 mb-2">Confirm Password</label>
                                <input type="password" id="password_confirmation" name="password_confirmation"
                                       class="block w-full px-4 py-2.5 rounded-xl border border-slate-200 dark:border-slate-800 bg-white/50 dark:bg-slate-950/50 text-slate-950 dark:text-white focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent text-sm"
                                       placeholder="••••••••">
                            </div>
                        </div>

                        <div class="flex justify-end pt-3">
                            <button type="submit" class="px-5 h-10 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white font-semibold text-xs shadow-md shadow-indigo-600/10 hover:shadow-indigo-600/20 hover:-translate-y-0.5 transition-all cursor-pointer">
                                Save Profile Changes
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Right Column: Recent Activities Audit Feed -->
            <div class="space-y-6">
                <div class="glass border border-slate-200/50 dark:border-slate-800/50 rounded-2xl p-6 bg-white dark:bg-slate-900">
                    <h2 class="text-xs font-bold uppercase tracking-wider text-slate-400 mb-4">Workspace Activity Feed</h2>
                    
                    @if ($activities->isEmpty())
                        <div class="py-6 text-center text-slate-400">
                            <i class="fa-solid fa-list-check opacity-45 text-xl mb-2"></i>
                            <p class="text-xs">No recent actions recorded.</p>
                        </div>
                    @else
                        <div class="relative pl-4 border-l border-slate-200 dark:border-slate-800 space-y-5">
                            @foreach ($activities as $act)
                                <div class="relative">
                                    <!-- Bullet indicator -->
                                    <span class="absolute -left-[21px] top-1.5 w-2.5 h-2.5 rounded-full border bg-white dark:bg-slate-900 border-indigo-500"></span>
                                    <div>
                                        <p class="text-xs font-bold text-slate-900 dark:text-white leading-snug">{{ $act->description }}</p>
                                        <span class="text-[10px] text-slate-400 font-medium block mt-0.5">{{ $act->created_at->diffForHumans() }}</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </main>
</div>
@endsection
