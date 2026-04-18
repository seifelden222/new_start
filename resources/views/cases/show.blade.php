<!DOCTYPE html>
<html dir="rtl" lang="ar">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ $charityCase->title }} - بداية جديدة</title>
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
        <div class="mb-6 flex flex-wrap items-center gap-3 text-sm font-black text-slate-500">
            <a href="{{ route('caseslist') }}" class="hover:text-blue-600">الحالات</a>
            <span>/</span>
            <span>{{ $charityCase->title }}</span>
        </div>

        <section class="overflow-hidden rounded-[2rem] border border-slate-200 bg-white shadow-sm">
            <div class="grid gap-8 lg:grid-cols-[1.05fr,0.95fr]">
                <img src="{{ $charityCase->imageUrl() }}" alt="{{ $charityCase->title }}" class="h-full min-h-[380px] w-full object-cover">
                <div class="p-6 lg:p-8">
                    <div class="flex flex-wrap items-center gap-3">
                        <span class="rounded-full px-3 py-1 text-xs font-black {{ $charityCase->status === 'عاجلة' ? 'bg-red-50 text-red-500' : 'bg-blue-50 text-blue-600' }}">
                            {{ $charityCase->status }}
                        </span>
                        <span class="rounded-full bg-slate-100 px-3 py-1 text-xs font-black text-slate-500">{{ $charityCase->category }}</span>
                    </div>

                    <h1 class="mt-5 text-4xl font-black leading-tight text-slate-950">{{ $charityCase->title }}</h1>
                    <p class="mt-5 text-base font-bold leading-8 text-slate-500">{{ $charityCase->description ?: 'لا يوجد وصف إضافي لهذه الحالة حاليًا.' }}</p>

                    <div class="mt-8 grid gap-4 sm:grid-cols-3">
                        <div class="rounded-3xl bg-slate-50 p-5">
                            <p class="text-xs font-black tracking-[0.25em] text-slate-400">المبلغ المطلوب</p>
                            <p class="mt-3 text-2xl font-black text-slate-900">{{ number_format($charityCase->target_amount) }} ج.م</p>
                        </div>
                        <div class="rounded-3xl bg-slate-50 p-5">
                            <p class="text-xs font-black tracking-[0.25em] text-slate-400">تم جمعه</p>
                            <p class="mt-3 text-2xl font-black text-emerald-600">{{ number_format($charityCase->collected_amount) }} ج.م</p>
                        </div>
                        <div class="rounded-3xl bg-slate-50 p-5">
                            <p class="text-xs font-black tracking-[0.25em] text-slate-400">المتبقي</p>
                            <p class="mt-3 text-2xl font-black text-red-500">{{ number_format($charityCase->remainingAmount()) }} ج.م</p>
                        </div>
                    </div>

                    <div class="mt-8">
                        <div class="mb-2 flex items-center justify-between text-xs font-black text-slate-500">
                            <span>نسبة التغطية</span>
                            <span>{{ $charityCase->progressPercent() }}%</span>
                        </div>
                        <div class="h-3 overflow-hidden rounded-full bg-slate-100">
                            <div class="h-full rounded-full {{ $charityCase->status === 'عاجلة' ? 'bg-red-500' : 'bg-blue-600' }}" style="width: {{ $charityCase->progressPercent() }}%"></div>
                        </div>
                    </div>

                    <div class="mt-8 flex flex-wrap gap-3">
                        <a href="{{ route('donation', ['case' => $charityCase->id]) }}" class="inline-flex items-center gap-2 rounded-full bg-blue-700 px-6 py-4 text-sm font-black text-white transition hover:bg-blue-800">
                            التبرع لهذه الحالة
                            <span class="material-symbols-outlined text-lg">volunteer_activism</span>
                        </a>
                        <a href="{{ $charityCase->status === 'عاجلة' ? route('cases.urgent') : route('caseslist') }}" class="inline-flex items-center gap-2 rounded-full border border-slate-200 px-6 py-4 text-sm font-black text-slate-700 transition hover:bg-slate-50">
                            العودة
                            <span class="material-symbols-outlined text-lg">arrow_left_alt</span>
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <x-land-footer />
</body>

</html>
