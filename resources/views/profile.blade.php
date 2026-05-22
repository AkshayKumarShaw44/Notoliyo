@extends('layouts.layout')

@section('title', 'Profile & Settings - Notoliyo')

@section('content')
<div class="h-screen flex overflow-hidden bg-slate-50 dark:bg-slate-950" x-data="{ sidebarOpen: false, showDeleteModal: false }">

    <!-- Mobile Sidebar Backdrop -->
    <div x-show="sidebarOpen" class="fixed inset-0 z-30 bg-slate-900/40 backdrop-blur-sm md:hidden" @click="sidebarOpen = false" x-transition:enter="transition-opacity ease-linear duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity ease-linear duration-300" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"></div>

    <!-- Sidebar Layout -->
    <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full md:translate-x-0'" class="fixed inset-y-0 left-0 z-40 w-64 glass-strong border-r border-slate-200/50 dark:border-slate-800/50 flex flex-col transition-transform duration-300 ease-in-out md:static md:h-full shadow-xl">
        <!-- Sidebar Header / Logo with Animation -->
        <div class="h-24 px-4 border-b border-slate-200/50 dark:border-slate-800/50 flex items-center justify-between relative overflow-hidden">
            <!-- Animated Background Gradient -->
            <div class="absolute inset-0 bg-gradient-to-r from-indigo-500/10 via-purple-500/10 to-pink-500/10 animate-gradient-x"></div>
            
            <a href="{{ route('dashboard') }}" class="flex items-center gap-3 relative z-10">
                <!-- Animated Icon -->
                <div class="relative w-12 h-12">
                    <!-- Rotating Gradient Background -->
                    <div class="absolute inset-0 rounded-xl bg-gradient-to-tr from-indigo-500 via-purple-500 to-pink-500 animate-spin-slow"></div>
                    <!-- Icon Container -->
                    <div class="absolute inset-0.5 rounded-xl bg-slate-900 flex items-center justify-center">
                        <svg class="w-7 h-7" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <!-- Animated Note Icon -->
                            <path d="M14 2H6C5.46957 2 4.96086 2.21071 4.58579 2.58579C4.21071 2.96086 4 3.46957 4 4V20C4 20.5304 4.21071 21.0391 4.58579 21.4142C4.96086 21.7893 5.46957 22 6 22H18C18.5304 22 19.0391 21.7893 19.4142 21.4142C19.7893 21.0391 20 20.5304 20 20V8L14 2Z" class="fill-indigo-400 animate-pulse-slow"/>
                            <path d="M14 2V8H20" class="stroke-purple-400 animate-pulse-slow" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M8 13H16M8 17H16" class="stroke-pink-400" stroke-width="2" stroke-linecap="round"/>
                        </svg>
                    </div>
                    <!-- Glow Effect -->
                    <div class="absolute inset-0 rounded-xl bg-gradient-to-tr from-indigo-500 via-purple-500 to-pink-500 blur-md opacity-50 animate-pulse-slow"></div>
                </div>
                
                <!-- Animated Text -->
                <div class="flex flex-col">
                    <span class="font-black text-2xl tracking-tight bg-gradient-to-r from-indigo-400 via-purple-400 to-pink-400 bg-clip-text text-transparent animate-gradient-x bg-300% leading-none">
                        Notoliyo
                    </span>
                    <span class="text-[9px] font-bold text-slate-400 tracking-widest uppercase mt-1">
                        Premium Notes
                    </span>
                </div>
            </a>
            
            <button @click="sidebarOpen = false" class="md:hidden text-slate-400 hover:text-slate-600 relative z-10 transition-colors">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>

        <!-- Navigation Links -->
        <div class="flex-1 overflow-y-auto px-4 py-6">
            <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold text-slate-600 dark:text-slate-400 hover:bg-slate-200/50 dark:hover:bg-slate-800/50 hover:text-indigo-600 dark:hover:text-indigo-400 transition-all group">
                <i class="fa-solid fa-arrow-left w-5 text-left text-base group-hover:-translate-x-1 transition-transform"></i> 
                <span>Back to Dashboard</span>
            </a>
        </div>

        <!-- Profile footer -->
        <div class="p-4 border-t border-slate-200/50 dark:border-slate-800/50 flex flex-col gap-3">
            <div class="flex items-center gap-3 group">
                <div class="relative w-12 h-12 rounded-xl flex items-center justify-center text-white font-bold text-lg shadow-lg transition-all group-hover:scale-105" style="background-color: {{ Auth::user()->avatar_color }}">
                    {{ Auth::user()->name[0] }}
                    <div class="absolute inset-0 rounded-xl bg-gradient-to-tr from-white/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                </div>
                <div class="flex-grow min-w-0">
                    <h4 class="text-sm font-bold truncate bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 bg-clip-text text-transparent animate-gradient-x">{{ Auth::user()->name }}</h4>
                    <p class="text-xs text-slate-400 truncate">{{ Auth::user()->email }}</p>
                </div>
            </div>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full h-10 rounded-xl glass-button border border-slate-200/60 dark:border-slate-800/60 hover:bg-rose-500/10 hover:text-rose-500 hover:border-rose-500/30 hover:scale-105 flex items-center justify-center text-sm font-semibold text-slate-600 dark:text-slate-350 cursor-pointer transition-all group">
                    <i class="fa-solid fa-arrow-right-from-bracket mr-2 text-sm group-hover:translate-x-1 transition-transform"></i> Log Out
                </button>
            </form>
        </div>
    </aside>

    <!-- Main settings area -->
    <main class="flex-1 flex flex-col overflow-hidden">
        <!-- Header -->
        <header class="h-16 px-6 border-b border-slate-200/50 dark:border-slate-800/50 flex items-center justify-between glass-strong">
            <div class="flex items-center gap-4">
                <button @click="sidebarOpen = true" class="md:hidden text-slate-500 hover:text-slate-700 transition-colors">
                    <i class="fa-solid fa-bars text-lg"></i>
                </button>
                <div class="flex items-center gap-3">
                    <i class="fa-solid fa-user-gear text-indigo-600 text-xl"></i>
                    <h1 class="text-xl font-bold text-slate-900 dark:text-white">Account Settings</h1>
                </div>
            </div>
        </header>

        <!-- Profile Content -->
        <div class="flex-grow overflow-y-auto p-6 lg:p-8">
            <!-- Success Message -->
            @if (session('success'))
                <div class="mb-6 p-4 rounded-xl glass-card border border-emerald-500/30 bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 flex items-center gap-3">
                    <i class="fa-solid fa-circle-check text-lg"></i>
                    <span class="font-semibold">{{ session('success') }}</span>
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Left 2 Columns: Main Content -->
                <div class="lg:col-span-2 space-y-6">
                    
                    <!-- Profile Header Card -->
                    <div class="glass-card border border-slate-200/50 dark:border-slate-800/50 rounded-2xl p-8 bg-gradient-to-br from-indigo-500/5 via-purple-500/5 to-pink-500/5">
                        <div class="flex flex-col sm:flex-row items-center gap-6">
                            <!-- Large Profile Avatar -->
                            <div class="relative group">
                                <div class="w-32 h-32 rounded-2xl flex items-center justify-center text-white font-bold text-5xl shadow-2xl transition-all group-hover:scale-105" style="background: linear-gradient(135deg, {{ Auth::user()->avatar_color }}, {{ Auth::user()->avatar_color }}dd);">
                                    {{ Auth::user()->name[0] }}
                                    <div class="absolute inset-0 rounded-2xl bg-gradient-to-tr from-white/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                                </div>
                                <div class="absolute inset-0 rounded-2xl bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 blur-xl opacity-20 group-hover:opacity-40 transition-opacity -z-10"></div>
                            </div>
                            
                            <!-- User Info -->
                            <div class="flex-1 text-center sm:text-left">
                                <h2 class="text-3xl font-bold mb-2 bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 bg-clip-text text-transparent animate-gradient-x">{{ Auth::user()->name }}</h2>
                                <p class="text-slate-600 dark:text-slate-400 mb-4">{{ Auth::user()->email }}</p>
                                
                                <!-- User Stats Badges -->
                                <div class="flex flex-wrap gap-3 justify-center sm:justify-start">
                                    <div class="px-4 py-2 rounded-xl glass-light border border-indigo-500/30 bg-indigo-500/10">
                                        <div class="flex items-center gap-2">
                                            <i class="fa-solid fa-calendar-days text-indigo-600 dark:text-indigo-400"></i>
                                            <span class="text-xs font-semibold text-slate-700 dark:text-slate-300">Joined {{ Auth::user()->created_at->format('M Y') }}</span>
                                        </div>
                                    </div>
                                    <div class="px-4 py-2 rounded-xl glass-light border border-purple-500/30 bg-purple-500/10">
                                        <div class="flex items-center gap-2">
                                            <i class="fa-solid fa-note-sticky text-purple-600 dark:text-purple-400"></i>
                                            <span class="text-xs font-semibold text-slate-700 dark:text-slate-300">{{ $stats['total_notes'] }} Notes</span>
                                        </div>
                                    </div>
                                    <div class="px-4 py-2 rounded-xl glass-light border border-pink-500/30 bg-pink-500/10">
                                        <div class="flex items-center gap-2">
                                            <i class="fa-solid fa-users text-pink-600 dark:text-pink-400"></i>
                                            <span class="text-xs font-semibold text-slate-700 dark:text-slate-300">{{ $stats['total_collaborators'] }} Collaborators</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Profile Information Form -->
                    <div class="glass-card border border-slate-200/50 dark:border-slate-800/50 rounded-2xl p-6 bg-white dark:bg-slate-900">
                        <div class="flex items-center gap-3 mb-6">
                            <i class="fa-solid fa-id-card text-indigo-600 text-xl"></i>
                            <h3 class="text-lg font-bold text-slate-900 dark:text-white">Profile Information</h3>
                        </div>
                        
                        <form action="{{ route('profile.update') }}" method="POST" class="space-y-6" x-data="{ selectedColor: '{{ $user->avatar_color }}' }">
                            @csrf
                            
                            <!-- Color palette selection -->
                            <div>
                                <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-3">
                                    <i class="fa-solid fa-palette text-indigo-600 mr-2"></i>
                                    Avatar & Cursor Color
                                </label>
                                <input type="hidden" name="avatar_color" x-model="selectedColor">
                                <div class="flex flex-wrap gap-3">
                                    @foreach (['#EF4444', '#3B82F6', '#10B981', '#F59E0B', '#8B5CF6', '#EC4899', '#06B6D4', '#14B8A6', '#6366F1'] as $color)
                                        <button type="button" @click="selectedColor = '{{ $color }}'"
                                                class="w-12 h-12 rounded-xl border-2 transition-all flex items-center justify-center cursor-pointer shadow-lg hover:scale-110 relative group"
                                                :class="selectedColor === '{{ $color }}' ? 'border-white scale-110 ring-4 ring-offset-2 ring-offset-slate-900' : 'border-transparent'"
                                                style="background-color: {{ $color }}; ring-color: {{ $color }}40;">
                                            <i class="fa-solid fa-check text-white text-lg" x-show="selectedColor === '{{ $color }}'"></i>
                                            <div class="absolute inset-0 rounded-xl bg-gradient-to-tr from-white/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                                        </button>
                                    @endforeach
                                </div>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label for="name" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">
                                        <i class="fa-solid fa-user text-indigo-600 mr-2"></i>Display Name
                                    </label>
                                    <input type="text" id="name" name="name" required value="{{ old('name', $user->name) }}"
                                           class="block w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-800 glass-light text-slate-950 dark:text-white focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent text-sm font-medium transition-all">
                                    @error('name')
                                        <p class="mt-2 text-xs text-rose-500 flex items-center gap-1">
                                            <i class="fa-solid fa-circle-exclamation"></i>{{ $message }}
                                        </p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="email" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">
                                        <i class="fa-solid fa-envelope text-indigo-600 mr-2"></i>Email Address
                                    </label>
                                    <input type="email" id="email" name="email" required value="{{ old('email', $user->email) }}"
                                           class="block w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-800 glass-light text-slate-950 dark:text-white focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent text-sm font-medium transition-all">
                                    @error('email')
                                        <p class="mt-2 text-xs text-rose-500 flex items-center gap-1">
                                            <i class="fa-solid fa-circle-exclamation"></i>{{ $message }}
                                        </p>
                                    @enderror
                                </div>
                            </div>

                            <div class="flex justify-end pt-3">
                                <button type="submit" class="px-6 py-3 rounded-xl bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white font-semibold text-sm shadow-lg shadow-indigo-600/30 hover:shadow-indigo-600/50 hover:-translate-y-0.5 hover:scale-105 transition-all cursor-pointer flex items-center gap-2">
                                    <i class="fa-solid fa-floppy-disk"></i>
                                    Save Profile Changes
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- Security Settings Card -->
                    <div class="glass-card border border-purple-500/30 dark:border-purple-500/30 rounded-2xl p-6 bg-purple-500/5">
                        <div class="flex items-center gap-3 mb-6">
                            <i class="fa-solid fa-shield-halved text-purple-600 text-xl"></i>
                            <h3 class="text-lg font-bold text-slate-900 dark:text-white">Security Settings</h3>
                        </div>
                        
                        <form action="{{ route('profile.update') }}" method="POST" class="space-y-6">
                            @csrf
                            
                            <!-- Hidden fields to preserve other data -->
                            <input type="hidden" name="name" value="{{ $user->name }}">
                            <input type="hidden" name="email" value="{{ $user->email }}">
                            <input type="hidden" name="avatar_color" value="{{ $user->avatar_color }}">
                            
                            <p class="text-sm text-slate-600 dark:text-slate-400 mb-4">
                                <i class="fa-solid fa-info-circle text-purple-600 mr-2"></i>
                                Leave password fields empty to keep your current password
                            </p>
                            
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label for="password" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">
                                        <i class="fa-solid fa-lock text-purple-600 mr-2"></i>New Password
                                    </label>
                                    <input type="password" id="password" name="password"
                                           class="block w-full px-4 py-3 rounded-xl border border-purple-200 dark:border-purple-800 glass-light text-slate-950 dark:text-white focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent text-sm font-medium transition-all"
                                           placeholder="••••••••">
                                    @error('password')
                                        <p class="mt-2 text-xs text-rose-500 flex items-center gap-1">
                                            <i class="fa-solid fa-circle-exclamation"></i>{{ $message }}
                                        </p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="password_confirmation" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">
                                        <i class="fa-solid fa-lock-open text-purple-600 mr-2"></i>Confirm Password
                                    </label>
                                    <input type="password" id="password_confirmation" name="password_confirmation"
                                           class="block w-full px-4 py-3 rounded-xl border border-purple-200 dark:border-purple-800 glass-light text-slate-950 dark:text-white focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent text-sm font-medium transition-all"
                                           placeholder="••••••••">
                                </div>
                            </div>

                            <div class="flex justify-end pt-3">
                                <button type="submit" class="px-6 py-3 rounded-xl bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 text-white font-semibold text-sm shadow-lg shadow-purple-600/30 hover:shadow-purple-600/50 hover:-translate-y-0.5 hover:scale-105 transition-all cursor-pointer flex items-center gap-2">
                                    <i class="fa-solid fa-key"></i>
                                    Update Password
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- Danger Zone Card -->
                    <div class="glass-card border border-rose-500/50 dark:border-rose-500/50 rounded-2xl p-6 bg-rose-500/5">
                        <div class="flex items-center gap-3 mb-4">
                            <i class="fa-solid fa-triangle-exclamation text-rose-600 text-xl"></i>
                            <h3 class="text-lg font-bold text-rose-600 dark:text-rose-400">Danger Zone</h3>
                        </div>
                        
                        <div class="space-y-4">
                            <div class="p-4 rounded-xl bg-rose-500/10 border border-rose-500/30">
                                <h4 class="font-bold text-slate-900 dark:text-white mb-2 flex items-center gap-2">
                                    <i class="fa-solid fa-skull-crossbones text-rose-600"></i>
                                    Delete Account Permanently
                                </h4>
                                <p class="text-sm text-slate-600 dark:text-slate-400 mb-4">
                                    Once you delete your account, there is no going back. This will permanently delete:
                                </p>
                                <ul class="text-sm text-slate-600 dark:text-slate-400 space-y-1 mb-4 ml-4">
                                    <li class="flex items-center gap-2">
                                        <i class="fa-solid fa-xmark text-rose-600"></i>
                                        All your notes and content
                                    </li>
                                    <li class="flex items-center gap-2">
                                        <i class="fa-solid fa-xmark text-rose-600"></i>
                                        All collaborations and shared notes
                                    </li>
                                    <li class="flex items-center gap-2">
                                        <i class="fa-solid fa-xmark text-rose-600"></i>
                                        All comments and activities
                                    </li>
                                    <li class="flex items-center gap-2">
                                        <i class="fa-solid fa-xmark text-rose-600"></i>
                                        Your account and profile data
                                    </li>
                                </ul>
                                <button @click="showDeleteModal = true" type="button" class="px-6 py-3 rounded-xl bg-rose-600 hover:bg-rose-700 text-white font-semibold text-sm shadow-lg shadow-rose-600/30 hover:shadow-rose-600/50 hover:-translate-y-0.5 hover:scale-105 transition-all cursor-pointer flex items-center gap-2">
                                    <i class="fa-solid fa-trash-can"></i>
                                    Delete My Account
                                </button>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Right Column: Stats & Activity -->
                <div class="space-y-6">
                    
                    <!-- Quick Stats Card -->
                    <div class="glass-card border border-slate-200/50 dark:border-slate-800/50 rounded-2xl p-6 bg-white dark:bg-slate-900">
                        <h3 class="text-sm font-bold uppercase tracking-wider text-slate-400 mb-4 flex items-center gap-2">
                            <i class="fa-solid fa-chart-simple"></i>
                            Quick Stats
                        </h3>
                        
                        <div class="space-y-3">
                            <!-- Total Notes -->
                            <div class="p-4 rounded-xl glass-light border border-indigo-500/30 bg-indigo-500/5 hover:scale-105 transition-transform group">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-xs font-semibold text-slate-600 dark:text-slate-400 mb-1">Total Notes</p>
                                        <p class="text-2xl font-bold text-indigo-600 dark:text-indigo-400">{{ $stats['total_notes'] }}</p>
                                    </div>
                                    <div class="w-12 h-12 rounded-xl bg-indigo-600/20 flex items-center justify-center group-hover:rotate-12 transition-transform">
                                        <i class="fa-solid fa-note-sticky text-indigo-600 dark:text-indigo-400 text-xl"></i>
                                    </div>
                                </div>
                            </div>

                            <!-- Shared Notes -->
                            <div class="p-4 rounded-xl glass-light border border-purple-500/30 bg-purple-500/5 hover:scale-105 transition-transform group">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-xs font-semibold text-slate-600 dark:text-slate-400 mb-1">Shared Notes</p>
                                        <p class="text-2xl font-bold text-purple-600 dark:text-purple-400">{{ $stats['shared_notes'] }}</p>
                                    </div>
                                    <div class="w-12 h-12 rounded-xl bg-purple-600/20 flex items-center justify-center group-hover:rotate-12 transition-transform">
                                        <i class="fa-solid fa-share-nodes text-purple-600 dark:text-purple-400 text-xl"></i>
                                    </div>
                                </div>
                            </div>

                            <!-- Collaborators -->
                            <div class="p-4 rounded-xl glass-light border border-pink-500/30 bg-pink-500/5 hover:scale-105 transition-transform group">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-xs font-semibold text-slate-600 dark:text-slate-400 mb-1">Collaborators</p>
                                        <p class="text-2xl font-bold text-pink-600 dark:text-pink-400">{{ $stats['total_collaborators'] }}</p>
                                    </div>
                                    <div class="w-12 h-12 rounded-xl bg-pink-600/20 flex items-center justify-center group-hover:rotate-12 transition-transform">
                                        <i class="fa-solid fa-users text-pink-600 dark:text-pink-400 text-xl"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Activity Feed Card -->
                    <div class="glass-card border border-slate-200/50 dark:border-slate-800/50 rounded-2xl p-6 bg-white dark:bg-slate-900">
                        <h3 class="text-sm font-bold uppercase tracking-wider text-slate-400 mb-4 flex items-center gap-2">
                            <i class="fa-solid fa-clock-rotate-left"></i>
                            Recent Activity
                        </h3>
                        
                        @if ($activities->isEmpty())
                            <div class="py-8 text-center">
                                <i class="fa-solid fa-list-check opacity-20 text-4xl mb-3 text-slate-400"></i>
                                <p class="text-sm text-slate-400">No recent activity</p>
                            </div>
                        @else
                            <div class="space-y-3 max-h-96 overflow-y-auto pr-2">
                                @foreach ($activities as $act)
                                    <div class="group">
                                        <!-- Thread Card -->
                                        <div class="relative p-4 rounded-xl glass-light hover:bg-indigo-500/5 transition-all border border-slate-200/50 dark:border-slate-800/50 hover:border-indigo-500/30 hover:shadow-lg hover:shadow-indigo-500/10">
                                            <!-- Thread Line Connector (except for last item) -->
                                            @if (!$loop->last)
                                                <div class="absolute left-6 top-full w-0.5 h-3 bg-gradient-to-b from-slate-300 to-transparent dark:from-slate-700"></div>
                                            @endif
                                            
                                            <div class="flex gap-3">
                                                <!-- Icon Circle -->
                                                <div class="flex-shrink-0 w-10 h-10 rounded-full bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform">
                                                    @if(str_contains($act->action, 'login'))
                                                        <i class="fa-solid fa-right-to-bracket text-white text-sm"></i>
                                                    @elseif(str_contains($act->action, 'logout'))
                                                        <i class="fa-solid fa-right-from-bracket text-white text-sm"></i>
                                                    @elseif(str_contains($act->action, 'register'))
                                                        <i class="fa-solid fa-user-plus text-white text-sm"></i>
                                                    @elseif(str_contains($act->action, 'note'))
                                                        <i class="fa-solid fa-note-sticky text-white text-sm"></i>
                                                    @elseif(str_contains($act->action, 'profile'))
                                                        <i class="fa-solid fa-user-gear text-white text-sm"></i>
                                                    @else
                                                        <i class="fa-solid fa-bolt text-white text-sm"></i>
                                                    @endif
                                                </div>
                                                
                                                <!-- Content -->
                                                <div class="flex-1 min-w-0">
                                                    <p class="text-sm font-semibold text-slate-900 dark:text-white leading-snug mb-1">{{ $act->description }}</p>
                                                    <div class="flex items-center gap-2 text-xs text-slate-400 font-medium">
                                                        <i class="fa-solid fa-clock text-[10px]"></i>
                                                        <span>{{ $act->created_at ? $act->created_at->diffForHumans() : 'Recently' }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </main>

    <!-- Delete Account Confirmation Modal -->
    <div x-show="showDeleteModal" class="fixed inset-0 z-50 flex items-center justify-center p-4" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" style="display: none;">
        <!-- Backdrop -->
        <div @click="showDeleteModal = false" class="absolute inset-0 bg-slate-900/80 backdrop-blur-sm"></div>
        
        <!-- Modal Content -->
        <div class="relative glass-strong border border-rose-500/50 rounded-2xl p-8 max-w-md w-full shadow-2xl" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-90" x-data="{ confirmation: '' }">
            
            <!-- Warning Icon -->
            <div class="w-16 h-16 rounded-full bg-rose-500/20 flex items-center justify-center mx-auto mb-4">
                <i class="fa-solid fa-triangle-exclamation text-rose-600 text-3xl"></i>
            </div>
            
            <!-- Title -->
            <h3 class="text-2xl font-bold text-center text-slate-900 dark:text-white mb-2">Delete Account?</h3>
            <p class="text-center text-slate-600 dark:text-slate-400 mb-6">This action cannot be undone. All your data will be permanently deleted.</p>
            
            <!-- Confirmation Form -->
            <form action="{{ route('profile.delete') }}" method="POST" class="space-y-4">
                @csrf
                @method('DELETE')
                
                <div>
                    <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">
                        Type <span class="text-rose-600 font-bold">DELETE</span> to confirm:
                    </label>
                    <input type="text" name="confirmation" x-model="confirmation" required
                           class="block w-full px-4 py-3 rounded-xl border border-rose-500/50 glass-light text-slate-950 dark:text-white focus:outline-none focus:ring-2 focus:ring-rose-500 focus:border-transparent text-sm font-bold text-center transition-all"
                           placeholder="DELETE">
                    @error('confirmation')
                        <p class="mt-2 text-xs text-rose-500 flex items-center gap-1">
                            <i class="fa-solid fa-circle-exclamation"></i>{{ $message }}
                        </p>
                    @enderror
                </div>
                
                <!-- Action Buttons -->
                <div class="flex gap-3 pt-2">
                    <button type="button" @click="showDeleteModal = false" class="flex-1 px-4 py-3 rounded-xl glass-button border border-slate-200 dark:border-slate-800 hover:bg-slate-200/50 dark:hover:bg-slate-800/50 text-slate-700 dark:text-slate-300 font-semibold text-sm transition-all hover:scale-105">
                        Cancel
                    </button>
                    <button type="submit" :disabled="confirmation !== 'DELETE'" :class="confirmation === 'DELETE' ? 'bg-rose-600 hover:bg-rose-700 cursor-pointer' : 'bg-slate-400 cursor-not-allowed opacity-50'" class="flex-1 px-4 py-3 rounded-xl text-white font-semibold text-sm shadow-lg transition-all hover:scale-105 disabled:hover:scale-100">
                        Delete Forever
                    </button>
                </div>
            </form>
            
            <!-- Close Button -->
            <button @click="showDeleteModal = false" class="absolute top-4 right-4 w-8 h-8 rounded-lg hover:bg-slate-200/50 dark:hover:bg-slate-800/50 flex items-center justify-center text-slate-400 hover:text-slate-600 dark:hover:text-slate-300 transition-colors">
                <i class="fa-solid fa-xmark text-lg"></i>
            </button>
        </div>
    </div>

</div>
@endsection
