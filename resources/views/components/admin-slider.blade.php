@php
    $navItems = [
        ['route' => 'admindashboard', 'path' => 'admindashboard', 'icon' => 'dashboard', 'label' => 'نظرة عامة'],
        ['route' => 'casemanage', 'path' => 'casemanage', 'icon' => 'folder_shared', 'label' => 'إدارة الحالات'],
        ['route' => 'orders', 'path' => 'orders', 'icon' => 'volunteer_activism', 'label' => 'طلبات التبرع'],
        ['route' => 'doners', 'path' => 'doners', 'icon' => 'group', 'label' => 'قائمة المتبرعين'],
        ['route' => 'reports', 'path' => 'reports', 'icon' => 'assessment', 'label' => 'التقارير'],
    ];
    $user = auth()->user();
    $userName = $user?->name ?? 'مدير المنصة';
    $userEmail = $user?->email ?? 'admin@example.com';
    $currentPath = request()->path();
    $currentRouteName = request()->route()?->getName();
@endphp

<aside class="fixed inset-y-0 right-0 z-50 flex w-72 flex-col border-l border-slate-200 bg-white dark:border-slate-800 dark:bg-slate-900">
    <div class="flex items-center gap-3 border-b border-slate-100 p-6 dark:border-slate-800">
        <div class="flex size-10 items-center justify-center rounded-xl bg-primary text-white">
            <img src="{{ asset('assets/img/logo.jpeg') }}" alt="Logo" width="50" height="50" class="rounded-xl shadow-lg transition-transform duration-300">
        </div>
        <div>
            <h1 class="leading-tight text-xl font-bold text-slate-900 dark:text-white">بداية جديدة</h1>
            <p class="text-xs font-semibold text-primary">لوحة تحكم المشرف</p>
        </div>
    </div>

    <nav class="flex-1 space-y-2 overflow-y-auto px-4 py-6">
        @foreach ($navItems as $navItem)
            @php
                $isActive = $currentPath === $navItem['path'] || $currentRouteName === $navItem['route'];
            @endphp

            <a
                href="{{ route($navItem['route']) }}"
                @class([
                    'flex items-center gap-3 rounded-lg px-4 py-3 transition-colors',
                    'bg-primary/10 font-bold text-primary' => $isActive,
                    'text-slate-600 hover:bg-slate-50 dark:text-slate-400 dark:hover:bg-slate-800' => ! $isActive,
                ])
            >
                <span class="material-symbols-outlined">{{ $navItem['icon'] }}</span>
                <span>{{ $navItem['label'] }}</span>
            </a>
        @endforeach
    </nav>

    <div class="mt-auto space-y-3 border-t border-slate-100 p-4 dark:border-slate-800">
        <div class="rounded-xl bg-primary/10 p-4 text-center">
            <p class="text-sm font-bold text-primary">مرحباً {{ $userName }}</p>
            <p class="mt-1 text-xs text-slate-600 dark:text-slate-400">{{ $userEmail }}</p>
            <div class="mt-3 inline-flex items-center gap-2 rounded-full bg-primary px-3 py-1 text-xs font-bold text-white">
                <span class="material-symbols-outlined text-sm">shield</span>
                <span>صلاحيات كاملة</span>
            </div>
        </div>

        <form method="POST" action="{{ route('logout') }}" onsubmit="return confirm('هل أنت متأكد من تسجيل الخروج؟');">
            @csrf
            <button type="submit" class="flex w-full items-center justify-center gap-3 rounded-xl px-4 py-3 text-red-500 transition-colors hover:bg-red-50 dark:hover:bg-red-900/20">
                <span class="material-symbols-outlined">logout</span>
                <span class="font-bold">تسجيل الخروج</span>
            </button>
        </form>
    </div>
</aside>
