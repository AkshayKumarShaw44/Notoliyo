@extends('layouts.layout')

@section('title', 'Notoliyo - Real-time Collaborative Notepad')

@section('content')
<div class="min-h-screen flex flex-col overflow-x-hidden">
    <!-- Navigation -->
    <header class="sticky top-0 z-40 w-full frosted border-b border-slate-200/50 dark:border-slate-800/50 shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
            <a href="{{ route('landing') }}" class="flex items-center gap-3 group">
                <!-- Animated Icon -->
                <div class="relative w-10 h-10">
                    <!-- Rotating Gradient Background -->
                    <div class="absolute inset-0 rounded-xl bg-gradient-to-tr from-indigo-500 via-purple-500 to-pink-500 animate-spin-slow"></div>
                    <!-- Icon Container -->
                    <div class="absolute inset-0.5 rounded-xl bg-slate-900 flex items-center justify-center group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <!-- Animated Note Icon -->
                            <path d="M14 2H6C5.46957 2 4.96086 2.21071 4.58579 2.58579C4.21071 2.96086 4 3.46957 4 4V20C4 20.5304 4.21071 21.0391 4.58579 21.4142C4.96086 21.7893 5.46957 22 6 22H18C18.5304 22 19.0391 21.7893 19.4142 21.4142C19.7893 21.0391 20 20.5304 20 20V8L14 2Z" class="fill-indigo-400 animate-pulse-slow"/>
                            <path d="M14 2V8H20" class="stroke-purple-400 animate-pulse-slow" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M8 13H16M8 17H16" class="stroke-pink-400" stroke-width="2" stroke-linecap="round"/>
                        </svg>
                    </div>
                    <!-- Glow Effect -->
                    <div class="absolute inset-0 rounded-xl bg-gradient-to-tr from-indigo-500 via-purple-500 to-pink-500 blur-md opacity-40 animate-pulse-slow group-hover:opacity-60 transition-opacity"></div>
                </div>
                
                <!-- Animated Text -->
                <span class="text-xl font-black tracking-tight bg-gradient-to-r from-indigo-400 via-purple-400 to-pink-400 bg-clip-text text-transparent animate-gradient-x bg-300% group-hover:scale-105 transition-transform">
                    Notoliyo
                </span>
            </a>
            
            <nav class="hidden md:flex items-center gap-8 text-sm font-semibold">
                <a href="#features" class="text-slate-600 hover:text-indigo-600 dark:text-slate-300 dark:hover:text-indigo-400 transition-colors">Features</a>
                <a href="#demo" class="text-slate-600 hover:text-indigo-600 dark:text-slate-300 dark:hover:text-indigo-400 transition-colors">Interactive Demo</a>
                <a href="https://github.com" target="_blank" class="text-slate-600 hover:text-indigo-600 dark:text-slate-300 dark:hover:text-indigo-400 transition-colors">Docs</a>
            </nav>

            <div class="flex items-center gap-4">
                @auth
                    <a href="{{ route('dashboard') }}" class="px-4 h-10 flex items-center justify-center rounded-lg bg-indigo-600 hover:bg-indigo-700 text-white font-semibold shadow-md shadow-indigo-600/10 hover:shadow-indigo-600/20 hover:-translate-y-0.5 transition-all text-sm">
                        Go to Dashboard <i class="fa-solid fa-arrow-right ml-2 text-xs"></i>
                    </a>
                @else
                    <a href="{{ route('login') }}" class="hidden sm:inline-flex text-sm font-semibold text-slate-600 hover:text-indigo-600 dark:text-slate-300 dark:hover:text-indigo-400">Log In</a>
                    <a href="{{ route('register') }}" class="px-4 h-10 flex items-center justify-center rounded-lg bg-indigo-600 hover:bg-indigo-700 text-white font-semibold shadow-md shadow-indigo-600/10 hover:shadow-indigo-600/20 hover:-translate-y-0.5 transition-all text-sm">
                        Get Started Free
                    </a>
                @endauth
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="relative pt-20 pb-24 lg:pt-32 lg:pb-32 bg-slate-50 dark:bg-slate-950 flex-grow">
        <!-- Animated Background Gradient -->
        <style>
        @keyframes gradient {
            0% {
                background-position: 0% 50%;
            }
            50% {
                background-position: 100% 50%;
            }
            100% {
                background-position: 0% 50%;
            }
        }

        .animated-gradient {
            background: linear-gradient(-45deg, #6366f1, #8b5cf6, #ec4899, #f59e0b);
            background-size: 400% 400%;
            animation: gradient 15s ease infinite;
        }
        </style>
        
        <!-- Background Gradient Orbs -->
        <div class="absolute inset-0 animated-gradient opacity-10 blur-3xl"></div>
        <div class="absolute top-1/4 left-1/4 -translate-x-1/2 -translate-y-1/2 w-96 h-96 rounded-full bg-indigo-500/10 blur-3xl pointer-events-none"></div>
        <div class="absolute bottom-1/4 right-1/4 translate-x-1/2 translate-y-1/2 w-96 h-96 rounded-full bg-purple-500/10 blur-3xl pointer-events-none"></div>
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-indigo-50 dark:bg-indigo-900/30 border border-indigo-100 dark:border-indigo-900/50 text-indigo-600 dark:text-indigo-400 text-xs font-semibold mb-6 animate-pulse"
                 data-aos="fade-down">
                <i class="fa-solid fa-bolt"></i> Real-time collaboration is here
            </div>

            <h1 class="text-5xl sm:text-6xl md:text-7xl font-extrabold tracking-tight text-slate-900 dark:text-white leading-[1.1] mb-6"
                data-aos="fade-up"
                data-aos-delay="100">
                Your ideas, synched <br class="hidden sm:block">
                <span class="bg-clip-text text-transparent bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500">
                    in perfect harmony.
                </span>
            </h1>

            <p class="max-w-2xl mx-auto text-lg sm:text-xl text-slate-600 dark:text-slate-400 mb-10 font-medium"
               data-aos="fade-up"
               data-aos-delay="200">
                Notoliyo is a beautifully fast collaborative notepad built for students and developers. Register, create documents, and invite peers to write together instantly.
            </p>

            <div class="flex flex-col sm:flex-row items-center justify-center gap-4"
                 data-aos="fade-up"
                 data-aos-delay="300">
                @auth
                    <a href="{{ route('dashboard') }}" class="w-full sm:w-auto px-8 h-12 flex items-center justify-center rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white font-semibold shadow-lg shadow-indigo-600/20 hover:shadow-indigo-600/35 hover:-translate-y-0.5 transition-all">
                        Enter Dashboard <i class="fa-solid fa-arrow-right ml-2"></i>
                    </a>
                @else
                    <a href="{{ route('register') }}" class="w-full sm:w-auto px-8 h-12 flex items-center justify-center rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white font-semibold shadow-lg shadow-indigo-600/20 hover:shadow-indigo-600/35 hover:-translate-y-0.5 transition-all">
                        Get Started For Free
                    </a>
                    <a href="#demo" class="w-full sm:w-auto px-8 h-12 flex items-center justify-center rounded-xl bg-slate-200/50 dark:bg-slate-800/50 hover:bg-slate-200 dark:hover:bg-slate-800 text-slate-800 dark:text-slate-200 font-semibold border border-slate-300/30 dark:border-slate-700/30 hover:-translate-y-0.5 transition-all">
                        Watch Live Sync
                    </a>
                @endauth
            </div>

            <!-- Simulated live collaboration mockup -->
            <div id="demo" class="mt-20 max-w-4xl mx-auto"
                 data-aos="fade-up"
                 data-aos-delay="400"
                 x-data="{ 
                text: '<h1>Weekly Project Alignment</h1><p>Hey team, here are the main milestones for our final presentation:</p>',
                collaborators: [
                    { name: 'Sarah', color: '#EC4899', text: ' Let\'s make sure we test the socket server thoroughly!', typing: true },
                    { name: 'David', color: '#10B981', text: ' Added MongoDB indexes to the collection model.', typing: false }
                ],
                activeTypeIndex: 0,
                simulateType() {
                    const messages = [
                        ' Adding the new dashboard layouts today.',
                        ' The real-time comments look amazing!',
                        ' Don\'t forget to use the toggle sharing link!'
                    ];
                    setInterval(() => {
                        const colIndex = this.activeTypeIndex % this.collaborators.length;
                        const col = this.collaborators[colIndex];
                        col.typing = true;
                        
                        setTimeout(() => {
                            this.text += `<p style='color:${col.color}'><strong>${col.name}:</strong> ${messages[Math.floor(Math.random() * messages.length)]}</p>`;
                            col.typing = false;
                        }, 1500);

                        this.activeTypeIndex++;
                    }, 5000);
                }
            }" x-init="simulateType()">
                <div class="rounded-2xl frosted shadow-2xl overflow-hidden">
                    <!-- Editor Bar -->
                    <div class="h-12 glass-light border-b border-slate-200/80 dark:border-slate-800/80 px-4 flex items-center justify-between">
                        <div class="flex items-center gap-1.5">
                            <span class="w-3 h-3 rounded-full bg-rose-500"></span>
                            <span class="w-3 h-3 rounded-full bg-amber-500"></span>
                            <span class="w-3 h-3 rounded-full bg-emerald-500"></span>
                            <span class="text-xs font-semibold text-slate-500 ml-2">Simulated Live Notepad</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <template x-for="user in collaborators">
                                <div class="w-7 h-7 rounded-full flex items-center justify-center text-white text-xs font-bold shadow-md"
                                     :style="'background-color: ' + user.color"
                                     :title="user.name">
                                    <span x-text="user.name[0]"></span>
                                </div>
                            </template>
                        </div>
                    </div>

                    <!-- Editor Workspace Preview -->
                    <div class="p-8 text-left h-72 overflow-y-auto glass-strong font-serif">
                        <div class="tiptap prose dark:prose-invert max-w-none text-slate-800 dark:text-slate-300" x-html="text"></div>
                        
                        <!-- Typing indicator -->
                        <div class="mt-4 flex items-center gap-2 text-xs text-slate-400 font-semibold h-4">
                            <template x-for="c in collaborators">
                                <div x-show="c.typing" class="flex items-center gap-1">
                                    <span class="w-1.5 h-1.5 rounded-full animate-bounce" :style="'background-color: ' + c.color"></span>
                                    <span x-text="c.name + ' is typing...'"></span>
                                </div>
                            </template>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-24 bg-slate-100/50 dark:bg-slate-900/20 border-t border-slate-200/50 dark:border-slate-800/50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-16"
                 data-aos="fade-up">
                <h2 class="text-3xl sm:text-4xl font-bold text-slate-900 dark:text-white mb-4">
                    Built for fast, modern collaborations
                </h2>
                <p class="text-slate-600 dark:text-slate-400 font-medium">
                    Notoliyo simplifies how groups take notes, collaborate, and share records without clunky menus or installation steps.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="p-6 rounded-2xl glass-card shadow-lg hover:shadow-2xl hover:-translate-y-2 hover:scale-105 transition-all duration-300 cursor-pointer group"
                     data-aos="fade-up"
                     data-aos-delay="100">
                    <div class="w-12 h-12 rounded-xl bg-indigo-500/10 text-indigo-600 dark:text-indigo-400 flex items-center justify-center mb-6 text-xl group-hover:bg-indigo-500 group-hover:text-white group-hover:rotate-12 group-hover:scale-110 transition-all duration-300">
                        <i class="fa-solid fa-arrows-rotate"></i>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-2 group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition-colors">Real-time Collaboration</h3>
                    <p class="text-slate-600 dark:text-slate-400 text-sm leading-relaxed">
                        Simultaneously edit notes, see typing indicators, and track other users' cursors live over websockets.
                    </p>
                </div>

                <!-- Feature 2 -->
                <div class="p-6 rounded-2xl glass-card shadow-lg hover:shadow-2xl hover:-translate-y-2 hover:scale-105 transition-all duration-300 cursor-pointer group"
                     data-aos="fade-up"
                     data-aos-delay="200">
                    <div class="w-12 h-12 rounded-xl bg-purple-500/10 text-purple-600 dark:text-purple-400 flex items-center justify-center mb-6 text-xl group-hover:bg-purple-500 group-hover:text-white group-hover:rotate-12 group-hover:scale-110 transition-all duration-300">
                        <i class="fa-solid fa-cubes"></i>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-2 group-hover:text-purple-600 dark:group-hover:text-purple-400 transition-colors">TipTap Rich Text</h3>
                    <p class="text-slate-600 dark:text-slate-400 text-sm leading-relaxed">
                        A distraction-free rich text editor supporting headings, lists, bold, italics, code blocks, and blockquotes.
                    </p>
                </div>

                <!-- Feature 3 -->
                <div class="p-6 rounded-2xl glass-card shadow-lg hover:shadow-2xl hover:-translate-y-2 hover:scale-105 transition-all duration-300 cursor-pointer group"
                     data-aos="fade-up"
                     data-aos-delay="300">
                    <div class="w-12 h-12 rounded-xl bg-pink-500/10 text-pink-600 dark:text-pink-400 flex items-center justify-center mb-6 text-xl group-hover:bg-pink-500 group-hover:text-white group-hover:rotate-12 group-hover:scale-110 transition-all duration-300">
                        <i class="fa-solid fa-link"></i>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-2 group-hover:text-pink-600 dark:group-hover:text-pink-400 transition-colors">Instant Public Sharing</h3>
                    <p class="text-slate-600 dark:text-slate-400 text-sm leading-relaxed">
                        Toggle sharing to generate a public invite link. Guest readers or writers can collaborate without registration.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-slate-100 dark:bg-slate-950 border-t border-slate-200/50 dark:border-slate-800/50 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Main Footer Content -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-8">
                <!-- Brand Section -->
                <div>
                    <div class="flex items-center gap-3 mb-4 group cursor-pointer">
                        <!-- Animated Icon -->
                        <div class="relative w-10 h-10">
                            <!-- Rotating Gradient Background -->
                            <div class="absolute inset-0 rounded-xl bg-gradient-to-tr from-indigo-500 via-purple-500 to-pink-500 animate-spin-slow"></div>
                            <!-- Icon Container -->
                            <div class="absolute inset-0.5 rounded-xl bg-slate-900 flex items-center justify-center group-hover:scale-110 transition-transform">
                                <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <!-- Animated Note Icon -->
                                    <path d="M14 2H6C5.46957 2 4.96086 2.21071 4.58579 2.58579C4.21071 2.96086 4 3.46957 4 4V20C4 20.5304 4.21071 21.0391 4.58579 21.4142C4.96086 21.7893 5.46957 22 6 22H18C18.5304 22 19.0391 21.7893 19.4142 21.4142C19.7893 21.0391 20 20.5304 20 20V8L14 2Z" class="fill-indigo-400 animate-pulse-slow"/>
                                    <path d="M14 2V8H20" class="stroke-purple-400 animate-pulse-slow" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M8 13H16M8 17H16" class="stroke-pink-400" stroke-width="2" stroke-linecap="round"/>
                                </svg>
                            </div>
                            <!-- Glow Effect -->
                            <div class="absolute inset-0 rounded-xl bg-gradient-to-tr from-indigo-500 via-purple-500 to-pink-500 blur-md opacity-40 animate-pulse-slow group-hover:opacity-60 transition-opacity"></div>
                        </div>
                        
                        <!-- Animated Text -->
                        <span class="text-xl font-black bg-gradient-to-r from-indigo-400 via-purple-400 to-pink-400 bg-clip-text text-transparent animate-gradient-x bg-300%">
                            Notoliyo
                        </span>
                    </div>
                    <p class="text-sm text-slate-600 dark:text-slate-400 leading-relaxed">
                        A beautifully fast collaborative notepad built for students and developers. Real-time collaboration made simple.
                    </p>
                </div>

                <!-- Quick Links -->
                <div>
                    <h3 class="text-sm font-bold uppercase tracking-wider text-slate-900 dark:text-white mb-4">Quick Links</h3>
                    <ul class="space-y-2">
                        <li><a href="#features" class="text-sm text-slate-600 dark:text-slate-400 hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors">Features</a></li>
                        <li><a href="#demo" class="text-sm text-slate-600 dark:text-slate-400 hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors">Demo</a></li>
                        <li><a href="{{ route('register') }}" class="text-sm text-slate-600 dark:text-slate-400 hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors">Get Started</a></li>
                        <li><a href="{{ route('login') }}" class="text-sm text-slate-600 dark:text-slate-400 hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors">Login</a></li>
                    </ul>
                </div>

                <!-- Contact Section -->
                <div>
                    <h3 class="text-sm font-bold uppercase tracking-wider text-slate-900 dark:text-white mb-4">Connect</h3>
                    <div class="space-y-3">
                        <a href="mailto:akshaykumarshaw44@gmail.com" class="flex items-center gap-2 text-sm text-slate-600 dark:text-slate-400 hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors">
                            <i class="fa-solid fa-envelope w-4"></i>
                            <span>akshaykumarshaw44@gmail.com</span>
                        </a>
                        <div class="flex items-center gap-4 pt-2">
                            <a href="https://github.com/AkshayKumarShaw44" target="_blank" rel="noopener noreferrer" class="text-slate-600 dark:text-slate-400 hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors" title="GitHub">
                                <i class="fa-brands fa-github text-xl"></i>
                            </a>
                            <a href="https://x.com/Akshaykrshaw" target="_blank" rel="noopener noreferrer" class="text-slate-600 dark:text-slate-400 hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors" title="X (Twitter)">
                                <i class="fa-brands fa-twitter text-xl"></i>
                            </a>
                            <a href="https://www.instagram.com/akshay_kr_shaw/" target="_blank" rel="noopener noreferrer" class="text-slate-600 dark:text-slate-400 hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors" title="Instagram">
                                <i class="fa-brands fa-instagram text-xl"></i>
                            </a>
                            <a href="https://www.linkedin.com/in/akshaykumarshaw44" target="_blank" rel="noopener noreferrer" class="text-slate-600 dark:text-slate-400 hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors" title="LinkedIn">
                                <i class="fa-brands fa-linkedin text-xl"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bottom Bar -->
            <div class="pt-8 border-t border-slate-200/50 dark:border-slate-800/50 flex flex-col sm:flex-row items-center justify-between gap-4">
                <p class="text-sm text-slate-500 dark:text-slate-400">
                    &copy; {{ date('Y') }} All rights reserved by <a href="mailto:akshaykumarshaw44@gmail.com" class="text-indigo-600 dark:text-indigo-400 hover:underline font-semibold">Akshay Kumar Shaw</a>
                </p>
                <p class="text-xs text-slate-400">
                    Built with Laravel, MongoDB & Socket.IO
                </p>
            </div>
        </div>
    </footer>
</div>
@endsection
