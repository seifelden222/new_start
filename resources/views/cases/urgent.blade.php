<!DOCTYPE html>
<html dir="rtl" lang="ar">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>بداية جديدة - الحالات العاجلة</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700;900&display=swap" rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&display=swap"
        rel="stylesheet" />
    <style>
        body {
            font-family: 'Cairo', sans-serif;
        }
    </style>
</head>

<body class="bg-slate-950 text-white">
    <x-land-navbar />

    <main class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8 lg:py-10">
        <section class="overflow-hidden rounded-[2rem] border border-white/10 bg-white/5 p-6 backdrop-blur-md lg:p-8">
            <div class="grid gap-8 lg:grid-cols-[1fr,0.8fr]">
                <div>
                    <p class="text-sm font-black tracking-[0.35em] text-red-300">URGENT CASES</p>
                    <h1 class="mt-4 text-4xl font-black leading-tight">قسم مستقل للحالات العاجلة داخل النظام</h1>
                    <p class="mt-5 max-w-3xl text-base font-bold leading-8 text-slate-300">
                        هذه الصفحة ليست تحويلًا إلى قائمة الحالات العامة، بل قسم مخصص وواضح للحالات الأكثر احتياجًا، حتى
                        يتمكن المستخدم المسجل من الوصول إليها بسرعة واتخاذ قرار الدعم بشكل مباشر.
                    </p>
                </div>
                <div class="rounded-[2rem] bg-red-500/10 p-6 ring-1 ring-red-300/20">
                    <p class="text-sm font-black text-red-200">عدد الحالات العاجلة الحالية</p>
                    <p class="mt-3 text-5xl font-black">{{ $urgentCases->count() }}</p>
                    <a href="{{ route('caseslist') }}"
                        class="mt-5 inline-flex items-center gap-2 text-sm font-black text-white hover:text-red-200">
                        العودة إلى جميع الحالات
                        <span class="material-symbols-outlined text-lg">arrow_left_alt</span>
                    </a>
                </div>
            </div>
        </section>

        @if ($urgentCases->isEmpty())
            <section class="mt-8 rounded-[2rem] border border-white/10 bg-white/5 p-10 text-center">
                <p class="text-2xl font-black">لا توجد حالات عاجلة منشورة حاليًا.</p>
                <p class="mt-3 text-sm font-bold text-slate-300">سيظهر هذا القسم فور وجود حالات مصنفة كعاجلة داخل
                    النظام.</p>
            </section>
        @else
            <section class="mt-8 grid gap-6 lg:grid-cols-2">
                @foreach ($urgentCases as $charityCase)
                    <article
                        class="overflow-hidden rounded-[2rem] border border-white/10 bg-white/5 shadow-lg backdrop-blur-md transition hover:-translate-y-1">
                        <img src="{{ $charityCase->imageUrl() }}" alt="{{ $charityCase->title }}"
                            class="h-64 w-full object-cover">
                        <div class="p-6">
                            <div class="flex flex-wrap items-center gap-3">
                                <span
                                    class="rounded-full bg-red-500/15 px-3 py-1 text-xs font-black text-red-200">عاجلة</span>
                                <span
                                    class="rounded-full bg-white/10 px-3 py-1 text-xs font-black text-slate-200">{{ $charityCase->category }}</span>
                            </div>
                            <h2 class="mt-4 text-3xl font-black">{{ $charityCase->title }}</h2>
                            <p class="mt-4 text-sm font-bold leading-8 text-slate-200">
                                {{ $charityCase->description ?: 'لا يوجد وصف إضافي لهذه الحالة حاليًا.' }}</p>

                            <div class="mt-6 grid gap-4 sm:grid-cols-3">
                                <div class="rounded-2xl bg-white/5 p-4">
                                    <p class="text-xs font-black text-slate-300">المطلوب</p>
                                    <p class="mt-2 text-lg font-black">{{ number_format($charityCase->target_amount) }}
                                        ج.م</p>
                                </div>
                                <div class="rounded-2xl bg-white/5 p-4">
                                    <p class="text-xs font-black text-slate-300">تم جمعه</p>
                                    <p class="mt-2 text-lg font-black">
                                        {{ number_format($charityCase->collected_amount) }} ج.م</p>
                                </div>
                                <div class="rounded-2xl bg-white/5 p-4">
                                    <p class="text-xs font-black text-slate-300">المتبقي</p>
                                    <p class="mt-2 text-lg font-black text-red-200">
                                        {{ number_format($charityCase->remainingAmount()) }} ج.م</p>
                                </div>
                            </div>

                            <div class="mt-6 flex flex-wrap gap-3">
                                <a href="{{ route('cases.show', $charityCase) }}"
                                    class="inline-flex items-center gap-2 rounded-full bg-white px-5 py-3 text-sm font-black text-slate-950 transition hover:bg-red-100">
                                    عرض التفاصيل
                                    <span class="material-symbols-outlined text-lg">arrow_left_alt</span>
                                </a>
                                <a href="{{ route('donation', ['case' => $charityCase->id]) }}"
                                    class="inline-flex items-center gap-2 rounded-full border border-white/20 px-5 py-3 text-sm font-black text-white transition hover:bg-white/10">
                                    دعم الحالة الآن
                                    <span class="material-symbols-outlined text-lg">volunteer_activism</span>
                                </a>
                            </div>
                        </div>
                    </article>
                @endforeach
            </section>
        @endif
    </main>

    <x-land-footer />
</body>

</html>
