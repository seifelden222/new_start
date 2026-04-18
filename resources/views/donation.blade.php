<!DOCTYPE html>
<html dir="rtl" lang="ar">

<head>
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>بداية جديدة - خدماتنا</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700;900&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&display=swap" rel="stylesheet" />
    <style>
        body {
            font-family: 'Cairo', sans-serif;
        }
    </style>
</head>

<body class="bg-slate-50 text-slate-900 overflow-x-hidden">
    @php($user = auth()->user())

    <x-land-navbar />

    <main class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8 lg:py-10">
        <section class="overflow-hidden rounded-[2rem] bg-slate-950 text-white shadow-2xl">
            <div class="grid gap-8 px-6 py-8 lg:grid-cols-[1.1fr,0.9fr] lg:px-10 lg:py-10">
                <div>
                    <p class="text-sm font-black tracking-[0.35em] text-blue-300">OUR SERVICES</p>
                    <h1 class="mt-4 text-4xl font-black leading-tight">خدماتنا مرتبطة بحسابك الحالي بالكامل</h1>
                    <p class="mt-5 max-w-3xl text-base font-bold leading-8 text-slate-300">
                        كل عملية تتم من هذا القسم مرتبطة مباشرة بالحساب المسجل دخوله الآن. شحن الرصيد يتم داخل الحساب، والتبرع يتم بالخصم من محفظتك الحالية فقط، مع توضيح وسيلة الشحن المستخدمة.
                    </p>

                    <div class="mt-8 grid gap-4 md:grid-cols-3">
                        <div class="rounded-3xl border border-white/10 bg-white/5 p-5">
                            <p class="text-xs font-black tracking-[0.25em] text-blue-200">الحساب الحالي</p>
                            <p class="mt-3 text-2xl font-black">{{ $user?->name }}</p>
                            <p class="mt-2 text-sm font-bold text-slate-300">{{ $user?->accountTypeLabel() }}</p>
                        </div>
                        <div class="rounded-3xl border border-white/10 bg-white/5 p-5">
                            <p class="text-xs font-black tracking-[0.25em] text-blue-200">رصيد المحفظة</p>
                            <p class="mt-3 text-2xl font-black"><span id="wallet-balance">{{ number_format($user?->balance ?? 0) }}</span> ج.م</p>
                            <p class="mt-2 text-sm font-bold text-slate-300">أي تبرع سيُخصم من هذا الرصيد.</p>
                        </div>
                        <div class="rounded-3xl border border-white/10 bg-white/5 p-5">
                            <p class="text-xs font-black tracking-[0.25em] text-blue-200">الحالات العاجلة</p>
                            <a href="{{ route('cases.urgent') }}" class="mt-3 inline-flex items-center gap-2 text-lg font-black text-white hover:text-blue-300">
                                اطلع عليها الآن
                                <span class="material-symbols-outlined text-xl">arrow_left_alt</span>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="rounded-[2rem] border border-white/10 bg-white/5 p-6 backdrop-blur-md">
                    <h2 class="text-xl font-black">دليل سريع لاستخدام الصفحة</h2>
                    <div class="mt-6 space-y-4 text-sm font-bold text-slate-200">
                        <div class="rounded-2xl border border-white/10 bg-white/5 p-4">
                            1. اختر وسيلة شحن الرصيد المناسبة لك: كاش أو إنستا باي.
                        </div>
                        <div class="rounded-2xl border border-white/10 bg-white/5 p-4">
                            2. أضف المبلغ إلى محفظتك أولًا، وسيظهر الرصيد المحدث مباشرة.
                        </div>
                        <div class="rounded-2xl border border-white/10 bg-white/5 p-4">
                            3. اختر الحالة والمبلغ المطلوب، ثم أكّد التبرع من نفس الحساب الحالي.
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <div id="page-message" class="mt-6 hidden rounded-3xl border px-5 py-4 text-sm font-black"></div>

        <section class="mt-8 grid gap-8 xl:grid-cols-[0.95fr,1.05fr]">
            <div class="space-y-8">
                <div class="rounded-[2rem] border border-slate-200 bg-white p-6 shadow-sm">
                    <div class="flex items-center justify-between gap-4">
                        <div>
                            <p class="text-sm font-black tracking-[0.25em] text-blue-600">WALLET TOP-UP</p>
                            <h2 class="mt-2 text-2xl font-black text-slate-900">شحن رصيد الحساب</h2>
                        </div>
                        <span class="rounded-full bg-emerald-50 px-4 py-2 text-xs font-black text-emerald-600">مرتبط بالحساب الحالي</span>
                    </div>

                    <div class="mt-6 grid gap-4 md:grid-cols-2">
                        @foreach ($paymentMethods as $method)
                            <label class="payment-method-card cursor-pointer rounded-3xl border border-slate-200 bg-slate-50 p-5 transition hover:border-blue-300 hover:bg-blue-50">
                                <input
                                    type="radio"
                                    name="wallet_payment_method"
                                    value="{{ $method['value'] }}"
                                    class="peer sr-only"
                                    @checked($loop->first)
                                >
                                <div class="rounded-2xl border border-transparent p-1 peer-checked:border-blue-500">
                                    <div class="flex items-center justify-between gap-3">
                                        <p class="text-lg font-black text-slate-900">{{ $method['label'] }}</p>
                                        <span class="rounded-full bg-white px-3 py-1 text-xs font-black text-blue-600">وسيلة دفع</span>
                                    </div>
                                    <p class="mt-3 text-sm font-bold leading-7 text-slate-500">{{ $method['description'] }}</p>
                                </div>
                            </label>
                        @endforeach
                    </div>

                    <form id="wallet-charge-form" class="mt-6 space-y-4">
                        <div>
                            <label for="wallet_amount" class="mb-2 me-1 block text-xs font-black tracking-[0.25em] text-slate-400">مبلغ الشحن</label>
                            <input id="wallet_amount" name="amount" min="1" type="number" placeholder="100" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-4 text-base font-bold text-slate-900 focus:border-blue-500 focus:ring-4 focus:ring-blue-100" required>
                        </div>

                        <button type="submit" class="inline-flex w-full items-center justify-center gap-3 rounded-2xl bg-blue-700 px-6 py-4 text-base font-black text-white shadow-[0_20px_45px_rgba(29,78,216,0.18)] transition hover:bg-blue-800">
                            <span>إضافة الرصيد إلى حسابي</span>
                            <span class="material-symbols-outlined">account_balance_wallet</span>
                        </button>
                    </form>
                </div>

                <div class="rounded-[2rem] border border-slate-200 bg-white p-6 shadow-sm">
                    <div class="flex items-center justify-between gap-4">
                        <div>
                            <p class="text-sm font-black tracking-[0.25em] text-red-500">URGENT CASES</p>
                            <h2 class="mt-2 text-2xl font-black text-slate-900">الحالات المتاحة للتبرع الآن</h2>
                        </div>
                        <a href="{{ route('cases.urgent') }}" class="rounded-full border border-red-200 px-4 py-2 text-xs font-black text-red-500 transition hover:bg-red-50">
                            عرض الحالات العاجلة
                        </a>
                    </div>

                    @if ($featuredCases->isEmpty())
                        <div class="mt-6 rounded-3xl border border-dashed border-slate-200 bg-slate-50 p-8 text-center">
                            <p class="text-lg font-black text-slate-700">لا توجد حالات متاحة حاليًا.</p>
                            <p class="mt-2 text-sm font-bold text-slate-500">يمكنك العودة لاحقًا أو متابعة صفحة الحالات لمعرفة المستجدات.</p>
                        </div>
                    @else
                        <div class="mt-6 grid gap-4">
                            @foreach ($featuredCases as $charityCase)
                                <button
                                    type="button"
                                    class="case-select-btn flex w-full items-center gap-4 rounded-3xl border border-slate-200 bg-slate-50 p-4 text-right transition hover:border-blue-300 hover:bg-blue-50"
                                    data-case-id="{{ $charityCase->id }}"
                                    data-case-title="{{ $charityCase->title }}"
                                >
                                    <img src="{{ $charityCase->imageUrl() }}" alt="{{ $charityCase->title }}" class="h-24 w-24 rounded-2xl object-cover">
                                    <div class="flex-1">
                                        <div class="flex flex-wrap items-center gap-2">
                                            <p class="text-lg font-black text-slate-900">{{ $charityCase->title }}</p>
                                            <span class="rounded-full px-3 py-1 text-xs font-black {{ $charityCase->status === 'عاجلة' ? 'bg-red-50 text-red-500' : 'bg-blue-50 text-blue-600' }}">
                                                {{ $charityCase->status }}
                                            </span>
                                        </div>
                                        <p class="mt-2 text-sm font-bold text-slate-500">{{ $charityCase->category }}</p>
                                        <p class="mt-3 text-sm font-bold text-slate-600">المتبقي: {{ number_format($charityCase->remainingAmount()) }} ج.م</p>
                                    </div>
                                    <span class="material-symbols-outlined text-slate-400">arrow_left_alt</span>
                                </button>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>

            <div class="rounded-[2rem] border border-slate-200 bg-white p-6 shadow-sm">
                <div class="flex items-center justify-between gap-4">
                    <div>
                        <p class="text-sm font-black tracking-[0.25em] text-blue-600">DONATION FLOW</p>
                        <h2 class="mt-2 text-2xl font-black text-slate-900">تنفيذ التبرع من حسابك</h2>
                    </div>
                    <span class="rounded-full bg-slate-100 px-4 py-2 text-xs font-black text-slate-600">الخصم يتم من المحفظة فقط</span>
                </div>

                <form id="donation-form" class="mt-8 space-y-5">
                    <div class="rounded-3xl border border-slate-200 bg-slate-50 p-5">
                        <p class="text-xs font-black tracking-[0.25em] text-slate-400">المستخدم الحالي</p>
                        <div class="mt-3 flex flex-wrap items-center gap-3">
                            <span class="rounded-full bg-white px-4 py-2 text-sm font-black text-slate-900">{{ $user?->name }}</span>
                            <span class="rounded-full bg-white px-4 py-2 text-sm font-black text-blue-600">{{ $user?->accountTypeLabel() }}</span>
                        </div>
                    </div>

                    <div>
                        <label for="charity_case_id" class="mb-2 me-1 block text-xs font-black tracking-[0.25em] text-slate-400">الحالة المراد دعمها</label>
                        <select id="charity_case_id" name="charity_case_id" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-4 text-base font-bold text-slate-900 focus:border-blue-500 focus:ring-4 focus:ring-blue-100" required>
                            <option value="">اختر الحالة</option>
                            @foreach ($featuredCases as $charityCase)
                                <option value="{{ $charityCase->id }}" @selected($selectedCaseId === $charityCase->id)>{{ $charityCase->title }} - {{ $charityCase->status }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="donation_amount" class="mb-2 me-1 block text-xs font-black tracking-[0.25em] text-slate-400">مبلغ التبرع</label>
                        <input id="donation_amount" name="amount" min="1" type="number" placeholder="100" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-4 text-base font-bold text-slate-900 focus:border-blue-500 focus:ring-4 focus:ring-blue-100" required>
                    </div>

                    <div class="rounded-3xl border border-blue-100 bg-blue-50 p-5">
                        <p class="text-sm font-black text-blue-700">ملاحظة مهمة</p>
                        <p class="mt-2 text-sm font-bold leading-7 text-blue-600">
                            التبرع من هذه الصفحة ليس عامًا ولا يُنفذ من خارج الحساب. يتم ربط العملية بالمستخدم المسجل دخوله حاليًا، ثم تُحفظ في سجل تبرعاته مع خصم القيمة من رصيده.
                        </p>
                    </div>

                    <button type="submit" class="inline-flex w-full items-center justify-center gap-3 rounded-2xl bg-emerald-600 px-6 py-4 text-base font-black text-white shadow-[0_20px_45px_rgba(5,150,105,0.18)] transition hover:bg-emerald-700">
                        <span>تأكيد التبرع من رصيدي</span>
                        <span class="material-symbols-outlined">volunteer_activism</span>
                    </button>
                </form>
            </div>
        </section>
    </main>

    <x-land-footer />

    <script>
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        const pageMessage = document.getElementById('page-message');
        const walletBalance = document.getElementById('wallet-balance');
        const donationForm = document.getElementById('donation-form');
        const walletChargeForm = document.getElementById('wallet-charge-form');
        const caseSelect = document.getElementById('charity_case_id');

        document.querySelectorAll('.case-select-btn').forEach((button) => {
            button.addEventListener('click', () => {
                caseSelect.value = button.dataset.caseId;
                document.querySelectorAll('.case-select-btn').forEach((btn) => {
                    btn.classList.remove('border-blue-400', 'bg-blue-50');
                });
                button.classList.add('border-blue-400', 'bg-blue-50');
                donationForm.scrollIntoView({ behavior: 'smooth', block: 'start' });
            });
        });

        function showMessage(type, text) {
            pageMessage.classList.remove('hidden', 'border-red-200', 'bg-red-50', 'text-red-700', 'border-emerald-200', 'bg-emerald-50', 'text-emerald-700');
            pageMessage.classList.add(type === 'success' ? 'border-emerald-200' : 'border-red-200');
            pageMessage.classList.add(type === 'success' ? 'bg-emerald-50' : 'bg-red-50');
            pageMessage.classList.add(type === 'success' ? 'text-emerald-700' : 'text-red-700');
            pageMessage.textContent = text;
        }

        walletChargeForm.addEventListener('submit', async (event) => {
            event.preventDefault();

            const selectedPaymentMethod = document.querySelector('input[name="wallet_payment_method"]:checked');
            const formData = new FormData(walletChargeForm);
            formData.append('payment_method', selectedPaymentMethod ? selectedPaymentMethod.value : '');

            const response = await fetch('{{ route('wallet.charge') }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json',
                },
                body: formData,
            });

            const payload = await response.json();

            if (! response.ok) {
                showMessage('error', payload.message ?? payload.error ?? 'تعذر شحن الرصيد. يرجى مراجعة البيانات.');
                return;
            }

            walletBalance.textContent = Number(payload.balance).toLocaleString('en-US');
            walletChargeForm.reset();
            document.querySelector('input[name="wallet_payment_method"][value="cash"]').checked = true;
            showMessage('success', 'تم شحن الرصيد بنجاح ويمكنك الآن تنفيذ التبرع من نفس الحساب.');
        });

        donationForm.addEventListener('submit', async (event) => {
            event.preventDefault();

            const formData = new FormData(donationForm);

            const response = await fetch('{{ route('donate') }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json',
                },
                body: formData,
            });

            const payload = await response.json();

            if (! response.ok) {
                showMessage('error', payload.message ?? payload.error ?? 'تعذر تنفيذ التبرع. تحقق من الرصيد والبيانات.');
                return;
            }

            walletBalance.textContent = Number(payload.balance).toLocaleString('en-US');
            donationForm.reset();
            showMessage('success', payload.message ?? 'تم التبرع بنجاح من رصيد حسابك الحالي.');
        });
    </script>
</body>

</html>
