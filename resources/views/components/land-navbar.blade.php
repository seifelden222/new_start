@php
    $currentRouteName = request()->route()?->getName();
    $navItems = [
        ['route' => null, 'label' => 'الرئيسية', 'url' => url('/')],
        ['route' => 'caseslist', 'label' => 'الحالات', 'url' => route('caseslist')],
        ['route' => 'cases.urgent', 'label' => 'الحالات العاجلة', 'url' => route('cases.urgent')],
        ['route' => 'donation', 'label' => 'خدمتنا', 'url' => route('donation')],
        ['route' => 'aboutus', 'label' => 'من نحن', 'url' => route('aboutus')],
    ];
@endphp

<header class="sticky top-0 z-50 border-b border-white/5 bg-[#020617]/95 shadow-xl backdrop-blur-md">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex h-20 items-center justify-between">
            <a href="{{ url('/') }}" class="group flex items-center gap-4">
                <div class="relative">
                    <img src="{{ asset('assets/img/logo.jpeg') }}" alt="Logo" width="50" height="50" class="rounded-xl shadow-lg transition-transform duration-300 group-hover:scale-105">
                    <div class="absolute inset-0 -z-10 rounded-full bg-blue-500/20 blur-xl opacity-0 transition-opacity group-hover:opacity-100"></div>
                </div>
                <span class="text-2xl font-bold tracking-tight text-white">بداية <span class="text-blue-500">جديدة</span></span>
            </a>

            <nav class="hidden items-center gap-10 md:flex">
                @foreach ($navItems as $navItem)
                    @php
                        $isHome = $navItem['route'] === null;
                        $isActive = $isHome ? request()->path() === '/' : $currentRouteName === $navItem['route'];
                    @endphp

                    <a
                        href="{{ $navItem['url'] }}"
                        @class([
                            'relative font-medium transition-all after:absolute after:bottom-[-4px] after:right-0 after:h-0.5 after:bg-blue-500 after:transition-all',
                            'font-bold text-[#007bff] after:w-full' => $isActive,
                            'text-slate-300 hover:text-white after:w-0 hover:after:w-full' => ! $isActive,
                        ])
                    >
                        {{ $navItem['label'] }}
                    </a>
                @endforeach
            </nav>

            <div class="flex items-center gap-4">
                <a
                    href="{{ auth()->check() ? route(auth()->user()->dashboardRouteName()) : route('login') }}"
                    class="hidden items-center gap-2 rounded-xl bg-blue-600 px-6 py-2.5 font-bold text-white shadow-lg shadow-blue-500/20 transition-all hover:bg-blue-700 active:scale-95 sm:inline-flex"
                >
                    <span class="material-symbols-outlined text-[20px]">{{ auth()->check() ? 'dashboard' : 'volunteer_activism' }}</span>
                    <span>{{ auth()->check() ? 'لوحة التحكم' : 'تسجيل دخول' }}</span>
                </a>

                <button class="p-2 text-white md:hidden" type="button">
                    <span class="material-symbols-outlined">menu</span>
                </button>
            </div>
        </div>
    </div>
</header>
