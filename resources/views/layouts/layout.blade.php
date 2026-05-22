<!DOCTYPE html>
<html lang="en" class="dark h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Notoliyo - Collaborative Workspace')</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Instrument+Sans:ital,wght@0,400..700;1,400..700&family=Outfit:wght@100..900&display=swap" rel="stylesheet">
    
    <!-- FontAwesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Vite Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    @yield('styles')
</head>
<body class="h-full bg-slate-50 dark:bg-slate-950 text-slate-800 dark:text-slate-200 font-sans transition-colors duration-200">

    <!-- Toast Notifications -->
    <div x-data="{ 
            toasts: [],
            addToast(message, type = 'success') {
                const id = Date.now();
                this.toasts.push({ id, message, type });
                setTimeout(() => {
                    this.toasts = this.toasts.filter(t => t.id !== id);
                }, 4000);
            }
         }"
         @toast.window="addToast($event.detail.message, $event.detail.type)"
         class="fixed top-5 right-5 z-50 flex flex-col gap-3 max-w-sm pointer-events-none"
    >
        <template x-for="toast in toasts" :key="toast.id">
            <div x-transition:enter="transition ease-out duration-300 transform"
                 x-transition:enter-start="opacity-0 translate-y-2 translate-x-2"
                 x-transition:enter-end="opacity-100 translate-y-0 translate-x-0"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0 scale-95"
                 class="p-4 rounded-xl shadow-lg border pointer-events-auto flex items-center gap-3 glass min-w-[280px]"
                 :class="{
                     'border-emerald-500/20 bg-emerald-500/10 text-emerald-600 dark:text-emerald-400': toast.type === 'success',
                     'border-rose-500/20 bg-rose-500/10 text-rose-600 dark:text-rose-400': toast.type === 'error',
                     'border-blue-500/20 bg-blue-500/10 text-blue-600 dark:text-blue-400': toast.type === 'info'
                 }"
            >
                <div class="flex-shrink-0">
                    <i class="fa-solid" :class="{
                        'fa-circle-check': toast.type === 'success',
                        'fa-circle-xmark': toast.type === 'error',
                        'fa-circle-info': toast.type === 'info'
                    }"></i>
                </div>
                <div class="text-sm font-semibold flex-grow" x-text="toast.message"></div>
                <button @click="toasts = toasts.filter(t => t.id !== toast.id)" class="text-slate-400 hover:text-slate-600 dark:hover:text-slate-200">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
        </template>
        
        <!-- Flash Session Messages -->
        @if (session('success'))
            <div x-init="$nextTick(() => { $dispatch('toast', { message: '{{ session('success') }}', type: 'success' }) })"></div>
        @endif
        @if (session('error'))
            <div x-init="$nextTick(() => { $dispatch('toast', { message: '{{ session('error') }}', type: 'error' }) })"></div>
        @endif
    </div>

    <!-- Main Content Slot -->
    @yield('content')

    @yield('scripts')
</body>
</html>
