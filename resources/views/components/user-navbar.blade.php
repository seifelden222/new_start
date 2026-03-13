@php
    $user = auth()->user();
    $userName = $user?->name ?? 'مستخدم المنصة';
    $userEmail = $user?->email ?? 'user@example.com';
    $avatarUrl = 'https://ui-avatars.com/api/?name=' . urlencode($userName) . '&background=007bff&color=fff';
@endphp

<header class="sticky top-0 z-40 flex h-16 items-center justify-between border-b border-slate-200 bg-white/80 px-8 backdrop-blur-md dark:border-slate-800 dark:bg-slate-900/80">
    <div class="relative w-96">
        <span class="material-symbols-outlined absolute right-3 top-1/2 -translate-y-1/2 text-slate-400">search</span>
        <input id="searchInput" class="w-full rounded-full border-none bg-slate-100 pr-10 pl-4 text-sm focus:ring-2 focus:ring-primary/50 dark:bg-slate-800" placeholder="ابحث عن حالات أو مبادرات..." type="text" />
    </div>

    <div class="flex items-center gap-4">
        <button onclick="toggleNotifications()" class="relative rounded-full p-2 text-slate-500 transition-colors hover:bg-slate-100 dark:hover:bg-slate-800">
            <span class="material-symbols-outlined">notifications</span>
            <span class="absolute top-2 left-2 h-2 w-2 rounded-full border-2 border-white bg-red-500 dark:border-slate-900"></span>
        </button>
        <div class="mx-2 h-8 w-px bg-slate-200 dark:bg-slate-700"></div>
        <div class="flex items-center gap-3">
            <div class="text-left">
                <p class="text-xs font-bold leading-none">{{ $userName }}</p>
                <p class="mt-1 text-[10px] leading-none text-slate-400">{{ $userEmail }}</p>
            </div>
            <div class="flex h-10 w-10 items-center justify-center overflow-hidden rounded-full border-2 border-primary/30 bg-primary/20">
                <img class="h-full w-full object-cover" src="{{ $avatarUrl }}" alt="{{ $userName }}" />
            </div>
        </div>
    </div>
</header>
