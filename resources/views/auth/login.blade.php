<x-guest-layout full-page="true" class="min-h-screen bg-slate-100 [font-family:Cairo,sans-serif]">
    <div dir="rtl" class="flex min-h-screen flex-col">
        <header class="relative z-10 w-full bg-slate-950 px-6 py-5 text-white shadow-2xl md:px-10">
            <div class="mx-auto flex w-full max-w-7xl items-center justify-between gap-6">
                <a href="{{ url('/') }}" class="flex items-center gap-3">
                    <img src="{{ asset('assets/img/logo.jpeg') }}" alt="بداية جديدة" class="h-12 w-12 rounded-xl border border-white/20 object-cover">
                    <span class="text-2xl font-black tracking-tight">
                        بداية <span class="text-blue-500">جديدة</span>
                    </span>
                </a>

                <nav class="hidden items-center gap-8 md:flex">
                    <a href="{{ url('/') }}" class="text-sm font-bold text-slate-300 transition hover:text-white">
                        الرئيسية
                    </a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="rounded-full border border-white/15 px-5 py-2 text-sm font-extrabold text-white transition hover:border-blue-400 hover:bg-blue-500/10">
                            إنشاء حساب
                        </a>
                    @endif
                </nav>
            </div>
        </header>

        <main class="flex flex-1 items-center justify-center px-4 py-8 md:px-8 md:py-12">
            <div class="grid w-full max-w-6xl overflow-hidden rounded-[2rem] border border-slate-200 bg-white shadow-[0_30px_80px_rgba(15,23,42,0.18)] md:grid-cols-2">
                <section class="relative hidden min-h-[620px] overflow-hidden md:flex">
                    <img src="{{ asset('assets/img/child.jpg') }}" alt="Helping children" class="absolute inset-0 h-full w-full object-cover">
                    <div class="absolute inset-0 bg-linear-to-b from-blue-900/80 via-slate-900/70 to-slate-950/95"></div>

                    <div class="relative z-10 flex h-full w-full flex-col justify-between p-12 text-white">
                        <div class="max-w-sm">
                            <span class="inline-flex rounded-full border border-white/15 bg-white/10 px-4 py-1 text-xs font-extrabold tracking-[0.3em] text-blue-100">
                                NEW START
                            </span>
                            <h2 class="mt-6 text-5xl font-black leading-tight">
                                أهلاً بك!
                            </h2>
                            <p class="mt-5 text-lg font-medium leading-8 text-blue-50/90">
                                أدخل بياناتك وابدأ رحلة العطاء معنا من خلال منصة مصممة لتسهيل الوصول والمساهمة.
                            </p>
                        </div>

                        @if (Route::has('register'))
                            <div class="max-w-sm">
                                <p class="mb-5 text-sm font-bold text-white/70">
                                    ليس لديك حساب حتى الآن؟
                                </p>
                                <a href="{{ route('register') }}" class="inline-flex items-center justify-center rounded-2xl border-2 border-white/80 px-8 py-3 text-sm font-black text-white transition hover:bg-white hover:text-blue-900">
                                    إنشاء حساب جديد
                                </a>
                            </div>
                        @endif
                    </div>
                </section>

                <section class="flex items-center bg-white">
                    <div class="w-full px-6 py-10 sm:px-10 md:px-12 md:py-14">
                        <div class="mb-10 text-right">
                            <p class="text-sm font-extrabold tracking-[0.3em] text-blue-700">
                                LOGIN
                            </p>
                            <h1 class="mt-4 text-3xl font-black tracking-tight text-slate-900 md:text-4xl">
                                تسجيل الدخول
                            </h1>
                            <div class="mt-4 h-1.5 w-20 rounded-full bg-blue-600"></div>
                            <p class="mt-5 text-sm font-bold leading-7 text-slate-500">
                                استخدم بريدك الإلكتروني وكلمة المرور للوصول إلى حسابك.
                            </p>
                        </div>

                        <x-auth-session-status :status="session('status')" class="mb-6 rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-right text-sm font-bold text-emerald-700" />

                        <form method="POST" action="{{ route('login') }}" class="space-y-6 text-right">
                            @csrf

                            <div>
                                <label for="email" class="mb-2 me-1 block text-[11px] font-black uppercase tracking-[0.25em] text-slate-400">
                                    البريد الإلكتروني
                                </label>
                                <div class="relative">
                                    <span class="material-symbols-outlined pointer-events-none absolute right-4 top-1/2 -translate-y-1/2 text-slate-300">
                                        mail
                                    </span>
                                    <input
                                        id="email"
                                        name="email"
                                        type="email"
                                        value="{{ old('email') }}"
                                        required
                                        autofocus
                                        autocomplete="username"
                                        placeholder="example@gmail.com"
                                        class="w-full rounded-2xl border border-slate-200 bg-slate-50 py-5 pr-12 pl-4 text-base font-bold text-slate-800 outline-none transition placeholder:font-semibold placeholder:text-slate-400 focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-100"
                                    >
                                </div>
                                <x-input-error :messages="$errors->get('email')" class="mt-2 text-right text-xs font-extrabold text-red-500" />
                            </div>

                            <div>
                                <div class="mb-2 flex items-center justify-between gap-4 px-1">
                                    @if (Route::has('password.request'))
                                        <a href="{{ route('password.request') }}" class="text-[11px] font-extrabold text-blue-600 transition hover:text-blue-800">
                                            هل نسيت كلمة السر؟
                                        </a>
                                    @endif
                                    <label for="password" class="block text-[11px] font-black uppercase tracking-[0.25em] text-slate-400">
                                        كلمة المرور
                                    </label>
                                </div>

                                <div class="relative">
                                    <span class="material-symbols-outlined pointer-events-none absolute right-4 top-1/2 -translate-y-1/2 text-slate-300">
                                        lock
                                    </span>
                                    <input
                                        id="password"
                                        name="password"
                                        type="password"
                                        required
                                        autocomplete="current-password"
                                        placeholder="8 رموز أو أكثر"
                                        class="w-full rounded-2xl border border-slate-200 bg-slate-50 py-5 pr-12 pl-12 text-base font-bold text-slate-800 outline-none transition placeholder:font-semibold placeholder:text-slate-400 focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-100"
                                    >
                                    <button
                                        type="button"
                                        data-toggle-password
                                        data-password-target="password"
                                        class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-300 transition hover:text-blue-600"
                                        aria-label="إظهار أو إخفاء كلمة المرور"
                                    >
                                        <span class="material-symbols-outlined text-xl">visibility</span>
                                    </button>
                                </div>
                                <x-input-error :messages="$errors->get('password')" class="mt-2 text-right text-xs font-extrabold text-red-500" />
                            </div>

                            <label for="remember_me" class="flex items-center justify-between gap-3 rounded-2xl border border-slate-200 bg-slate-50 px-4 py-4">
                                <span class="text-sm font-bold text-slate-600">
                                    تذكرني في المرات القادمة
                                </span>
                                <input
                                    id="remember_me"
                                    type="checkbox"
                                    name="remember"
                                    class="h-5 w-5 rounded border-slate-300 text-blue-700 shadow-sm focus:ring-2 focus:ring-blue-500"
                                >
                            </label>

                            <button type="submit" class="group inline-flex w-full items-center justify-center gap-3 rounded-2xl bg-blue-700 px-6 py-5 text-lg font-black text-white shadow-[0_20px_45px_rgba(29,78,216,0.28)] transition hover:bg-blue-800">
                                <span>دخول آمن</span>
                                <span class="material-symbols-outlined text-xl transition group-hover:-translate-x-1">
                                    arrow_back
                                </span>
                            </button>
                        </form>

                        @if (Route::has('register'))
                            <div class="mt-10 text-center text-sm font-bold text-slate-400">
                                ليس لديك حساب؟
                                <a href="{{ route('register') }}" class="font-black text-blue-600 transition hover:text-blue-800 hover:underline">
                                    سجل الآن
                                </a>
                            </div>
                        @endif
                    </div>
                </section>
            </div>
        </main>

        <footer class="w-full border-t border-white/5 bg-slate-950 px-6 py-6 text-xs font-bold text-white/40 md:px-10">
            <div class="mx-auto flex w-full max-w-7xl flex-col items-center justify-between gap-4 md:flex-row">
                <div class="flex items-center gap-3">
                    <span class="material-symbols-outlined text-blue-500">volunteer_activism</span>
                    <p>© 2026 منصة بداية جديدة. يد واحدة لمستقبل أفضل.</p>
                </div>

                <a href="{{ route('privacy') }}" class="transition hover:text-blue-400">
                    سياسة الخصوصية
                </a>
            </div>
        </footer>
    </div>

    <script>
        document.querySelectorAll('[data-toggle-password]').forEach((button) => {
            button.addEventListener('click', () => {
                const targetId = button.getAttribute('data-password-target');
                const passwordField = document.getElementById(targetId);
                const icon = button.querySelector('.material-symbols-outlined');

                if (! passwordField || ! icon) {
                    return;
                }

                const isPassword = passwordField.type === 'password';

                passwordField.type = isPassword ? 'text' : 'password';
                icon.textContent = isPassword ? 'visibility_off' : 'visibility';
            });
        });
    </script>
</x-guest-layout>
