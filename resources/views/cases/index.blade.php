<!DOCTYPE html>
<html dir="rtl" lang="ar">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>بداية جديدة - الحالات</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700;900&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&display=swap" rel="stylesheet" />
    <style>
        body {
            font-family: 'Cairo', sans-serif;
        }
    </style>
</head>

<body class="bg-slate-50 text-slate-900">
    <x-land-navbar />

    <main class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8 lg:py-10">
        <section class="rounded-[2rem] bg-white p-6 shadow-sm ring-1 ring-slate-200 lg:p-8">
            <div class="grid gap-8 lg:grid-cols-[1.1fr,0.9fr]">
                <div>
                    <p class="text-sm font-black tracking-[0.35em] text-blue-600">CASES</p>
                    <h1 class="mt-4 text-4xl font-black leading-tight text-slate-950">صفحة الحالات متاحة فقط للمستخدمين المسجلين</h1>
                    <p class="mt-5 max-w-3xl text-base font-bold leading-8 text-slate-500">
                        تعرض هذه الصفحة الحالات النشطة والعاجلة داخل النظام بعد تسجيل الدخول فقط، لضمان خصوصية البيانات وربط التبرعات بسجلات المستخدمين الحقيقيين.
                    </p>
                </div>

                <div class="grid gap-4 sm:grid-cols-2">
                    <div class="rounded-3xl bg-slate-950 p-5 text-white">
                        <p class="text-sm font-black text-blue-300">إجمالي الحالات المعروضة</p>
                        <p class="mt-3 text-4xl font-black">{{ $cases->count() }}</p>
                    </div>
                    <div class="rounded-3xl bg-red-50 p-5 text-red-600 ring-1 ring-red-100">
                        <p class="text-sm font-black">الحالات العاجلة</p>
                        <p class="mt-3 text-4xl font-black">{{ $urgentCasesCount }}</p>
                        <a href="{{ route('cases.urgent') }}" class="mt-4 inline-flex items-center gap-2 text-sm font-black hover:text-red-700">
                            عرض القسم المستقل
                            <span class="material-symbols-outlined text-lg">arrow_left_alt</span>
                        </a>
                    </div>
                </div>
            </div>
        </section>

        @if ($cases->isEmpty())
            <section class="mt-8 rounded-[2rem] border border-dashed border-slate-300 bg-white p-10 text-center">
                <p class="text-2xl font-black text-slate-900">لا توجد حالات منشورة حاليًا.</p>
                <p class="mt-3 text-sm font-bold text-slate-500">بمجرد إضافة حالات جديدة داخل النظام ستظهر هنا للمستخدمين المسجلين.</p>
            </section>
        @else
            <section class="mt-8 grid gap-6 md:grid-cols-2 xl:grid-cols-3">
                @foreach ($cases as $charityCase)
                    <article class="overflow-hidden rounded-[2rem] border border-slate-200 bg-white shadow-sm transition hover:-translate-y-1 hover:shadow-lg">
                        <img src="{{ $charityCase->imageUrl() }}" alt="{{ $charityCase->title }}" class="h-56 w-full object-cover">
                        <div class="p-6">
                            <div class="flex flex-wrap items-center gap-2">
                                <span class="rounded-full px-3 py-1 text-xs font-black {{ $charityCase->status === 'عاجلة' ? 'bg-red-50 text-red-500' : 'bg-blue-50 text-blue-600' }}">
                                    {{ $charityCase->status }}
                                </span>
                                <span class="rounded-full bg-slate-100 px-3 py-1 text-xs font-black text-slate-500">{{ $charityCase->category }}</span>
                            </div>
                            <h2 class="mt-4 text-2xl font-black text-slate-900">{{ $charityCase->title }}</h2>
                            <p class="mt-3 text-sm font-bold leading-7 text-slate-500">{{ $charityCase->description ?: 'لا يوجد وصف إضافي لهذه الحالة حاليًا.' }}</p>

                            <div class="mt-5">
                                <div class="mb-2 flex items-center justify-between text-xs font-black text-slate-500">
                                    <span>نسبة الإنجاز</span>
                                    <span>{{ $charityCase->progressPercent() }}%</span>
                                </div>
                                <div class="h-3 overflow-hidden rounded-full bg-slate-100">
                                    <div class="h-full rounded-full {{ $charityCase->status === 'عاجلة' ? 'bg-red-500' : 'bg-blue-600' }}" style="width: {{ $charityCase->progressPercent() }}%"></div>
                                </div>
                            </div>

                            <div class="mt-5 flex items-center justify-between gap-4 text-sm font-black">
                                <div>
                                    <p class="text-slate-400">المتبقي</p>
                                    <p class="mt-1 text-slate-900">{{ number_format($charityCase->remainingAmount()) }} ج.م</p>
                                </div>
                                <a href="{{ route('cases.show', $charityCase) }}" class="inline-flex items-center gap-2 rounded-full bg-slate-950 px-5 py-3 text-white transition hover:bg-blue-700">
                                    التفاصيل
                                    <span class="material-symbols-outlined text-lg">arrow_left_alt</span>
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
