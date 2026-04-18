<x-guest-layout full-page="true" class="min-h-screen bg-slate-100 [font-family:Cairo,sans-serif]">
    @php($accountTypes = \App\Models\User::accountTypes())

    <div dir="rtl" class="flex min-h-screen flex-col">
        <header class="relative z-10 w-full bg-slate-950 px-6 py-5 text-white shadow-2xl md:px-10">
            <div class="mx-auto flex w-full max-w-7xl items-center justify-between gap-6">
                <a href="{{ url('/') }}" class="flex items-center gap-3">
                    <img src="{{ asset('assets/img/logo.jpeg') }}" alt="بداية جديدة" class="h-12 w-12 rounded-xl border border-white/20 object-cover">
                    <span class="text-2xl font-black tracking-tight">
                        بداية <span class="text-blue-500">جديدة</span>
                    </span>
                </a>

                <a href="{{ route('login') }}" class="rounded-full border border-white/15 px-5 py-2 text-sm font-extrabold text-white transition hover:border-blue-400 hover:bg-blue-500/10">
                    تسجيل الدخول
                </a>
            </div>
        </header>

        <main class="flex flex-1 items-center justify-center px-4 py-8 md:px-8 md:py-12">
            <div class="grid w-full max-w-7xl overflow-hidden rounded-[2rem] border border-slate-200 bg-white shadow-[0_30px_80px_rgba(15,23,42,0.18)] lg:grid-cols-[0.92fr,1.08fr]">
                <section class="relative hidden min-h-[860px] overflow-hidden lg:flex">
                    <img src="{{ asset('assets/img/child.jpg') }}" alt="Helping others" class="absolute inset-0 h-full w-full object-cover">
                    <div class="absolute inset-0 bg-linear-to-b from-blue-900/80 via-slate-900/70 to-slate-950/95"></div>

                    <div class="relative z-10 flex h-full w-full flex-col justify-between p-12 text-white">
                        <div class="max-w-sm">
                            <span class="inline-flex rounded-full border border-white/15 bg-white/10 px-4 py-1 text-xs font-extrabold tracking-[0.3em] text-blue-100">
                                REGISTER
                            </span>
                            <h2 class="mt-6 text-5xl font-black leading-tight">
                                سجل بطريقة واضحة وآمنة
                            </h2>
                            <p class="mt-5 text-lg font-medium leading-8 text-blue-50/90">
                                اختر نوع الحساب من البداية، وراجع شروط كلمة المرور بوضوح، ثم أكمل التسجيل لتنتقل مباشرة إلى لوحة التحكم الخاصة بك.
                            </p>
                        </div>

                        <div class="space-y-4">
                            <div class="rounded-3xl border border-white/20 bg-white/10 p-5 backdrop-blur-md">
                                <p class="text-sm font-black text-white">خطوات سريعة</p>
                                <ul class="mt-4 space-y-3 text-sm font-bold text-blue-50/90">
                                    <li>1. اختر نوع الحساب: متبرع أو موظف أو أخصائي.</li>
                                    <li>2. استخدم كلمة مرور تحتوي على Small و Capital ورقم واحد على الأقل.</li>
                                    <li>3. تابع الملاحظات الظاهرة أسفل الحقول قبل إرسال الطلب.</li>
                                </ul>
                            </div>
                            <p class="text-sm font-bold text-white/70">
                                بعد إنشاء الحساب سيتم تسجيل دخولك مباشرة وتحويلك إلى لوحة التحكم.
                            </p>
                        </div>
                    </div>
                </section>

                <section class="flex items-center bg-white">
                    <div class="w-full px-6 py-10 sm:px-10 md:px-12 md:py-14">
                        <div class="mb-8 text-right">
                            <p class="text-sm font-extrabold tracking-[0.3em] text-blue-700">
                                REGISTER
                            </p>
                            <h1 class="mt-4 text-3xl font-black tracking-tight text-slate-900 md:text-4xl">
                                إنشاء حساب جديد
                            </h1>
                            <p class="mt-3 max-w-2xl text-sm font-bold leading-7 text-slate-500">
                                أدخل بياناتك مرة واحدة بشكل صحيح. ستظهر شروط كلمة المرور ورسائل التحقق بوضوح داخل الصفحة أثناء الكتابة.
                            </p>
                            <div class="mt-4 h-1.5 w-20 rounded-full bg-blue-600"></div>
                        </div>

                        @if ($errors->any())
                            <div class="mb-6 rounded-3xl border border-red-200 bg-red-50 p-5 text-right">
                                <p class="text-sm font-black text-red-700">يرجى مراجعة الملاحظات التالية قبل إكمال التسجيل:</p>
                                <ul class="mt-3 space-y-2 text-sm font-bold text-red-600">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('register') }}" class="space-y-5 text-right">
                            @csrf

                            <div>
                                <label for="name" class="mb-2 me-1 block text-[11px] font-black uppercase tracking-[0.25em] text-slate-400">
                                    الاسم الكامل
                                </label>
                                <input
                                    id="name"
                                    name="name"
                                    type="text"
                                    value="{{ old('name') }}"
                                    required
                                    autofocus
                                    autocomplete="name"
                                    placeholder="الاسم بالحروف فقط"
                                    class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-4 text-base font-bold text-slate-800 outline-none transition placeholder:font-semibold placeholder:text-slate-400 focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-100"
                                >
                                <x-input-error :messages="$errors->get('name')" class="mt-2 text-right text-xs font-extrabold text-red-500" />
                            </div>

                            <div>
                                <label for="email" class="mb-2 me-1 block text-[11px] font-black uppercase tracking-[0.25em] text-slate-400">
                                    البريد الإلكتروني
                                </label>
                                <input
                                    id="email"
                                    name="email"
                                    type="email"
                                    value="{{ old('email') }}"
                                    required
                                    autocomplete="username"
                                    placeholder="example@mail.com"
                                    class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-4 text-base font-bold text-slate-800 outline-none transition placeholder:font-semibold placeholder:text-slate-400 focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-100"
                                >
                                <x-input-error :messages="$errors->get('email')" class="mt-2 text-right text-xs font-extrabold text-red-500" />
                            </div>

                            <div>
                                <div class="mb-2 flex items-center justify-between gap-3">
                                    <label class="me-1 block text-[11px] font-black uppercase tracking-[0.25em] text-slate-400">
                                        نوع الحساب
                                    </label>
                                    <span class="text-xs font-black text-blue-600">اختيار أساسي عند التسجيل</span>
                                </div>

                                <div class="grid gap-3 sm:grid-cols-3">
                                    @foreach ($accountTypes as $value => $label)
                                        <label class="account-type-option cursor-pointer rounded-3xl border border-slate-200 bg-slate-50 p-4 transition hover:border-blue-300 hover:bg-blue-50">
                                            <input
                                                type="radio"
                                                name="account_type"
                                                value="{{ $value }}"
                                                class="peer sr-only"
                                                @checked(old('account_type', \App\Models\User::ACCOUNT_TYPE_DONOR) === $value)
                                            >
                                            <div class="rounded-2xl border border-transparent p-3 text-center transition peer-checked:border-blue-500 peer-checked:bg-white peer-checked:shadow-sm">
                                                <p class="text-base font-black text-slate-900">{{ $label }}</p>
                                                <p class="mt-2 text-xs font-bold leading-6 text-slate-500">
                                                    @if ($value === \App\Models\User::ACCOUNT_TYPE_DONOR)
                                                        لمتابعة التبرعات ورصيد المحفظة والحالات المدعومة.
                                                    @elseif ($value === \App\Models\User::ACCOUNT_TYPE_EMPLOYEE)
                                                        لحسابات المتابعة التشغيلية والإدارية داخل النظام.
                                                    @else
                                                        لحسابات المتخصصين المشاركين في دراسة ودعم الحالات.
                                                    @endif
                                                </p>
                                            </div>
                                        </label>
                                    @endforeach
                                </div>
                                <x-input-error :messages="$errors->get('account_type')" class="mt-2 text-right text-xs font-extrabold text-red-500" />
                            </div>

                            <div class="rounded-3xl border border-slate-200 bg-slate-50 p-5">
                                <div class="flex items-center justify-between gap-3">
                                    <div>
                                        <label for="password" class="mb-2 me-1 block text-[11px] font-black uppercase tracking-[0.25em] text-slate-400">
                                            كلمة المرور
                                        </label>
                                        <p class="text-xs font-bold text-slate-500">مطلوب: 8 أحرف فأكثر مع Small و Capital ورقم واحد على الأقل.</p>
                                    </div>
                                    <button
                                        type="button"
                                        data-toggle-password
                                        data-password-target="password"
                                        class="rounded-full border border-slate-200 bg-white px-3 py-2 text-xs font-black text-slate-500 transition hover:border-blue-300 hover:text-blue-600"
                                    >
                                        إظهار
                                    </button>
                                </div>

                                <input
                                    id="password"
                                    name="password"
                                    type="password"
                                    required
                                    autocomplete="new-password"
                                    placeholder="Example123"
                                    class="mt-4 w-full rounded-2xl border border-slate-200 bg-white px-4 py-4 text-base font-bold text-slate-800 outline-none transition placeholder:font-semibold placeholder:text-slate-400 focus:border-blue-500 focus:ring-4 focus:ring-blue-100"
                                >

                                <div class="mt-4 grid gap-3 sm:grid-cols-2">
                                    <div id="password-rule-length" class="rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm font-bold text-slate-500">8 أحرف على الأقل</div>
                                    <div id="password-rule-case" class="rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm font-bold text-slate-500">حرف صغير وحرف كبير</div>
                                    <div id="password-rule-number" class="rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm font-bold text-slate-500 sm:col-span-2">رقم واحد على الأقل</div>
                                </div>

                                <x-input-error :messages="$errors->get('password')" class="mt-3 text-right text-xs font-extrabold text-red-500" />
                            </div>

                            <div>
                                <div class="flex items-center justify-between gap-3">
                                    <label for="password_confirmation" class="mb-2 me-1 block text-[11px] font-black uppercase tracking-[0.25em] text-slate-400">
                                        تأكيد كلمة المرور
                                    </label>
                                    <button
                                        type="button"
                                        data-toggle-password
                                        data-password-target="password_confirmation"
                                        class="rounded-full border border-slate-200 bg-white px-3 py-2 text-xs font-black text-slate-500 transition hover:border-blue-300 hover:text-blue-600"
                                    >
                                        إظهار
                                    </button>
                                </div>
                                <input
                                    id="password_confirmation"
                                    name="password_confirmation"
                                    type="password"
                                    required
                                    autocomplete="new-password"
                                    placeholder="أعد كتابة كلمة المرور"
                                    class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-4 text-base font-bold text-slate-800 outline-none transition placeholder:font-semibold placeholder:text-slate-400 focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-100"
                                >
                                <p id="confirmLiveError" class="hidden mt-2 text-right text-xs font-extrabold text-red-500">كلمة المرور غير متطابقة.</p>
                                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-right text-xs font-extrabold text-red-500" />
                            </div>

                            <div class="pt-4">
                                <button type="submit" class="group inline-flex w-full items-center justify-center gap-4 rounded-2xl bg-blue-700 px-6 py-5 text-lg font-black text-white shadow-[0_20px_45px_rgba(29,78,216,0.28)] transition hover:bg-blue-800">
                                    <span>إنشاء الحساب الآن</span>
                                    <span class="material-symbols-outlined text-2xl transition group-hover:-translate-x-1">
                                        how_to_reg
                                    </span>
                                </button>
                            </div>

                            <div class="pt-2 text-center text-sm font-bold text-slate-400">
                                لديك حساب بالفعل؟
                                <a href="{{ route('login') }}" class="font-black text-blue-600 transition hover:text-blue-800 hover:underline">
                                    تسجيل الدخول
                                </a>
                            </div>
                        </form>
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
        const passwordField = document.getElementById('password');
        const passwordConfirmationField = document.getElementById('password_confirmation');
        const confirmLiveError = document.getElementById('confirmLiveError');

        document.querySelectorAll('[data-toggle-password]').forEach((button) => {
            button.addEventListener('click', () => {
                const targetId = button.getAttribute('data-password-target');
                const field = document.getElementById(targetId);

                if (! field) {
                    return;
                }

                const isPassword = field.type === 'password';

                field.type = isPassword ? 'text' : 'password';
                button.textContent = isPassword ? 'إخفاء' : 'إظهار';
            });
        });

        function markPasswordRule(id, valid) {
            const element = document.getElementById(id);

            element.classList.toggle('border-emerald-300', valid);
            element.classList.toggle('bg-emerald-50', valid);
            element.classList.toggle('text-emerald-700', valid);
            element.classList.toggle('border-slate-200', ! valid);
            element.classList.toggle('bg-white', ! valid);
            element.classList.toggle('text-slate-500', ! valid);
        }

        function validatePassword() {
            const value = passwordField.value;
            const hasLength = value.length >= 8;
            const hasMixedCase = /[a-z]/.test(value) && /[A-Z]/.test(value);
            const hasNumber = /\d/.test(value);

            markPasswordRule('password-rule-length', hasLength);
            markPasswordRule('password-rule-case', hasMixedCase);
            markPasswordRule('password-rule-number', hasNumber);

            validatePasswordConfirmation();
        }

        function validatePasswordConfirmation() {
            const hasMismatch = passwordConfirmationField.value !== '' && passwordConfirmationField.value !== passwordField.value;

            confirmLiveError.classList.toggle('hidden', ! hasMismatch);
            passwordConfirmationField.classList.toggle('border-red-400', hasMismatch);
        }

        passwordField.addEventListener('input', validatePassword);
        passwordConfirmationField.addEventListener('input', validatePasswordConfirmation);
        validatePassword();
    </script>
</x-guest-layout>
