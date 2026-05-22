@extends('layouts.layout')

@section('title', 'Log In - Notoliyo')

@section('content')
<div class="min-h-screen flex items-center justify-center relative bg-slate-50 dark:bg-slate-950 px-4">
    <!-- Gradient Background blobs -->
    <div class="absolute top-10 left-10 w-72 h-72 rounded-full bg-indigo-500/10 blur-3xl pointer-events-none"></div>
    <div class="absolute bottom-10 right-10 w-72 h-72 rounded-full bg-purple-500/10 blur-3xl pointer-events-none"></div>

    <div class="w-full max-w-md relative z-10">
        <div class="text-center mb-8">
            <a href="{{ route('landing') }}" class="inline-flex items-center gap-3 mb-6 group">
                <!-- Animated Icon -->
                <div class="relative w-14 h-14">
                    <!-- Rotating Gradient Background -->
                    <div class="absolute inset-0 rounded-xl bg-gradient-to-tr from-indigo-500 via-purple-500 to-pink-500 animate-spin-slow"></div>
                    <!-- Icon Container -->
                    <div class="absolute inset-0.5 rounded-xl bg-slate-900 flex items-center justify-center group-hover:scale-110 transition-transform">
                        <svg class="w-8 h-8" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <!-- Animated Note Icon -->
                            <path d="M14 2H6C5.46957 2 4.96086 2.21071 4.58579 2.58579C4.21071 2.96086 4 3.46957 4 4V20C4 20.5304 4.21071 21.0391 4.58579 21.4142C4.96086 21.7893 5.46957 22 6 22H18C18.5304 22 19.0391 21.7893 19.4142 21.4142C19.7893 21.0391 20 20.5304 20 20V8L14 2Z" class="fill-indigo-400 animate-pulse-slow"/>
                            <path d="M14 2V8H20" class="stroke-purple-400 animate-pulse-slow" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M8 13H16M8 17H16" class="stroke-pink-400" stroke-width="2" stroke-linecap="round"/>
                        </svg>
                    </div>
                    <!-- Glow Effect -->
                    <div class="absolute inset-0 rounded-xl bg-gradient-to-tr from-indigo-500 via-purple-500 to-pink-500 blur-lg opacity-50 animate-pulse-slow group-hover:opacity-75 transition-opacity"></div>
                </div>
                
                <!-- Animated Text -->
                <span class="text-3xl font-black tracking-tight bg-gradient-to-r from-indigo-400 via-purple-400 to-pink-400 bg-clip-text text-transparent animate-gradient-x bg-300% group-hover:scale-105 transition-transform">
                    Notoliyo
                </span>
            </a>
            <h2 class="text-3xl font-extrabold tracking-tight text-slate-900 dark:text-white">Welcome back</h2>
            <p class="mt-2 text-sm text-slate-500">Simplify your collaborative brainstorming</p>
        </div>

        <div class="frosted rounded-2xl shadow-2xl p-8">
            <form action="{{ route('login') }}" method="POST" class="space-y-6">
                @csrf

                <div>
                    <label for="email" class="block text-xs font-semibold uppercase tracking-wider text-slate-500 mb-2">Email Address</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-slate-400">
                            <i class="fa-solid fa-envelope"></i>
                        </span>
                        <input id="email" name="email" type="email" autocomplete="email" required value="{{ old('email') }}"
                               class="block w-full pl-10 pr-4 py-2.5 rounded-xl border border-slate-200 dark:border-slate-800 bg-white/50 dark:bg-slate-950/50 text-slate-950 dark:text-white focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all text-sm @error('email') border-rose-500 @enderror"
                               placeholder="you@example.com">
                    </div>
                    @error('email')
                        <p class="mt-1.5 text-xs text-rose-500 font-semibold">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <div class="flex items-center justify-between mb-2">
                        <label for="password" class="block text-xs font-semibold uppercase tracking-wider text-slate-500">Password</label>
                    </div>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-slate-400">
                            <i class="fa-solid fa-lock"></i>
                        </span>
                        <input id="password" name="password" type="password" required
                               class="block w-full pl-10 pr-4 py-2.5 rounded-xl border border-slate-200 dark:border-slate-800 bg-white/50 dark:bg-slate-955/50 text-slate-955 dark:text-white focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all text-sm @error('password') border-rose-500 @enderror"
                               placeholder="••••••••">
                    </div>
                </div>

                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input id="remember" name="remember" type="checkbox"
                               class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-slate-300 dark:border-slate-700 rounded bg-white/50 dark:bg-slate-950/50">
                        <label for="remember" class="ml-2 block text-sm text-slate-600 dark:text-slate-400 font-medium">Remember me</label>
                    </div>
                </div>

                <div>
                    <button type="submit"
                            class="w-full flex justify-center py-3 px-4 border border-transparent rounded-xl shadow-md text-sm font-semibold text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 hover:shadow-lg transition-all hover:-translate-y-0.5 cursor-pointer">
                        Log In
                    </button>
                </div>
            </form>
        </div>

        <p class="mt-6 text-center text-sm text-slate-600 dark:text-slate-400">
            Don't have an account?
            <a href="{{ route('register') }}" class="font-bold text-indigo-600 dark:text-indigo-400 hover:underline">Sign up for free</a>
        </p>
    </div>
</div>
@endsection
