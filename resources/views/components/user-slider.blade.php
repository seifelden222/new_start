@php
    $navItems = [
        ['route' => 'userdashboard', 'path' => 'userdashboard', 'icon' => 'dashboard', 'label' => 'نظرة عامة'],
        ['route' => 'mydonate', 'path' => 'mydonate', 'icon' => 'volunteer_activism', 'label' => 'تبرعاتي'],
        ['route' => 'mycases', 'path' => 'mycases', 'icon' => 'favorite', 'label' => 'حالات أتابعها'],
        ['route' => 'settings', 'path' => 'settings', 'icon' => 'settings', 'label' => 'إعدادات الملف الشخصي'],
    ];

    $currentPath = request()->path();
    $currentRouteName = request()->route()?->getName();
@endphp

<aside class="fixed right-0 z-50 flex h-full w-64 flex-col border-l border-slate-200 bg-white dark:border-slate-800 dark:bg-slate-900">
    <div class="flex items-center gap-3 p-6">
        <div class="rounded-lg p-2">
            <img src="{{ asset('assets/img/logo.jpeg') }}" alt="Logo" width="50" height="50" class="rounded-xl shadow-lg transition-transform duration-300">
        </div>
        <h1 class="text-xl font-black tracking-tight text-primary">بداية جديدة</h1>
    </div>

    <nav class="mt-6 flex-1 space-y-2 px-4">
        @foreach ($navItems as $navItem)
            @php
                $isActive = $currentPath === $navItem['path'] || $currentRouteName === $navItem['route'];
            @endphp

            <a
                href="{{ route($navItem['route']) }}"
                @class([
                    'group flex items-center gap-3 rounded-lg px-4 py-3 transition-colors',
                    'active-nav font-bold' => $isActive,
                    'text-slate-600 hover:bg-slate-50 dark:text-slate-400 dark:hover:bg-slate-800' => ! $isActive,
                ])
            >
                <span class="material-symbols-outlined">{{ $navItem['icon'] }}</span>
                <span class="{{ $isActive ? 'font-bold' : 'font-medium' }}">{{ $navItem['label'] }}</span>
            </a>
        @endforeach
    </nav>

    <div class="border-t border-slate-200 p-4 dark:border-slate-800">
        <form method="POST" action="{{ route('logout') }}" onsubmit="return confirm('هل أنت متأكد من تسجيل الخروج؟');">
            @csrf
            <button type="submit" class="flex w-full items-center gap-3 rounded-lg px-4 py-3 text-red-500 transition-colors hover:bg-red-50 dark:hover:bg-red-900/20">
                <span class="material-symbols-outlined">logout</span>
                <span class="font-medium">تسجيل الخروج</span>
            </button>
        </form>
    </div>
</aside>
