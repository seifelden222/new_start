@php
    $user = auth()->user();
    $userName = $user?->name ?? 'مدير المنصة';
    $userEmail = $user?->email ?? 'admin@example.com';
    $avatarUrl = 'https://ui-avatars.com/api/?name=' . urlencode($userName) . '&background=0f172a&color=fff';
    $pageTitles = [
        'admindashboard' => 'لوحة التحكم',
        'addcase' => 'إضافة حالة جديدة',
        'casemanage' => 'إدارة الحالات',
        'orders' => 'طلبات التبرع',
        'donors' => 'قائمة المتبرعين',
        'reports' => 'التقارير',
    ];
    $currentRouteName = request()->route()?->getName();
    $pageTitle = $pageTitles[$currentRouteName] ?? 'لوحة تحكم المشرف';
@endphp

<header class="sticky top-0 z-40 flex h-20 items-center justify-between border-b border-slate-200 bg-white/80 px-8 backdrop-blur-md">
    <div class="flex flex-1 items-center gap-6">
        <h2 class="text-xl font-bold text-slate-800">{{ $pageTitle }}</h2>
    </div>
    <div class="flex items-center gap-4">
        <button onclick="toggleNotifications()" class="relative flex size-10 items-center justify-center rounded-full text-slate-600 hover:bg-slate-100">
            <span class="material-symbols-outlined">notifications</span>
            <span class="absolute top-2 right-2 size-2 rounded-full border-2 border-white bg-red-500"></span>
        </button>
        <button onclick="toggleSettings()" class="flex size-10 items-center justify-center rounded-full text-slate-600 hover:bg-slate-100">
            <span class="material-symbols-outlined">settings</span>
        </button>
        <div class="mx-2 h-8 w-px bg-slate-200"></div>
        <div class="flex cursor-pointer items-center gap-3">
            <div class="text-left">
                <p class="text-sm font-bold text-slate-900">{{ $userName }}</p>
                <p class="text-[10px] font-medium text-slate-500">{{ $userEmail }}</p>
            </div>
            <img class="size-10 rounded-full bg-slate-200 object-cover" src="{{ $avatarUrl }}" alt="{{ $userName }}" />
        </div>
    </div>
</header>
