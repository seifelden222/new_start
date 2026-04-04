<!DOCTYPE html>
<html dir="rtl" lang="ar">

<head>
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>بداية جديدة - سياسة الخصوصية</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700;900&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0"
        rel="stylesheet" />
    <style>
        body {
            font-family: 'Cairo', sans-serif;
        }

        /* منع ظهور النقط في جميع القوائم التنفيذية */
        ul {
            list-style: none !important;
            padding: 0 !important;
            margin: 0 !important;
        }

        .hero-gradient {
            background: linear-gradient(135deg, #020617 0%, #0f172a 100%);
        }

        /* تنسيق مخصص لقوائم المحتوى داخل السياسة فقط */
        .policy-list li {
            position: relative;
            padding-right: 1.8rem;
            margin-bottom: 1rem;
            color: #475569;
            font-weight: 500;
            display: block;
            line-height: 1.6;
        }

        .policy-list li::before {
            content: "check_circle";
            /* أيقونة التحقق */
            font-family: 'Material Symbols Outlined';
            position: absolute;
            right: 0;
            top: 2px;
            font-size: 1.2rem;
            color: #3b82f6;
        }
    </style>
</head>

<body class="bg-slate-50 min-h-screen flex flex-col antialiased">

    <header class="sticky top-0 z-50 bg-[#020617]/95 backdrop-blur-md border-b border-white/5 shadow-xl">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">
                <div class="flex items-center gap-4 group cursor-pointer"
                    onclick="window.location.href='{{ url('/') }}'">
                    <div class="relative">
                        <img src="assets/img/logo.jpeg" alt="Logo" width="50" height="50"
                            class="rounded-xl shadow-lg group-hover:scale-105 transition-transform duration-300">
                        <div
                            class="absolute inset-0 bg-blue-500/20 blur-xl rounded-full -z-10 opacity-0 group-hover:opacity-100 transition-opacity">
                        </div>
                    </div>
                    <span class="text-2xl font-bold tracking-tight text-white">بداية <span
                            class="text-blue-500">جديدة</span></span>
                </div>

                <nav class="hidden md:flex items-center gap-10">
                    <a class="text-slate-300 hover:text-white font-medium transition-all relative after:content-[''] after:absolute after:w-0 after:h-0.5 after:bg-blue-500 after:bottom-[-4px] after:right-0 hover:after:w-full after:transition-all"
                        href="{{ url('/') }}">الرئيسية</a>
                    <a class="text-slate-300 hover:text-white font-medium transition-all relative after:content-[''] after:absolute after:w-0 after:h-0.5 after:bg-blue-500 after:bottom-[-4px] after:right-0 hover:after:w-full after:transition-all"
                        href="{{ url('caseslist') }}">الحالات</a>
                    <a class="text-slate-300 hover:text-white font-medium transition-all relative after:content-[''] after:absolute after:w-0 after:h-0.5 after:bg-blue-500 after:bottom-[-4px] after:right-0 hover:after:w-full after:transition-all"
                        href="{{ url('donation') }}">خدمتنا</a>
                    <a class="text-slate-300 hover:text-white font-medium transition-all relative after:content-[''] after:absolute after:w-0 after:h-0.5 after:bg-blue-500 after:bottom-[-4px] after:right-0 hover:after:w-full after:transition-all"
                        href="{{ url('aboutus') }}">من نحن</a>
                </nav>

                <div class="flex items-center gap-4">
                    <a href="{{ route('login') }}"
                        class="hidden items-center gap-2 rounded-xl bg-blue-600 px-6 py-2.5 font-bold text-white shadow-lg shadow-blue-500/20 transition-all hover:bg-blue-700 active:scale-95 sm:inline-flex">
                        <span class="material-symbols-outlined text-[20px]">volunteer_activism</span>
                        <span>تسجيل دخول</span>
                    </a>

                    <button class="md:hidden text-white p-2">
                        <span class="material-symbols-outlined">menu</span>
                    </button>
                </div>
            </div>
        </div>
    </header>


    <main class="flex-grow py-12 px-4">
        <div class="max-w-4xl mx-auto">
            <div
                class="hero-gradient rounded-[2.5rem] p-10 md:p-16 mb-12 text-center relative overflow-hidden shadow-2xl">
                <div class="absolute top-0 right-0 w-64 h-64 bg-blue-600/10 blur-[100px] rounded-full"></div>
                <div class="relative z-10">
                    <h1 class="text-4xl md:text-5xl font-black text-white mb-6 tracking-tight">سياسة الخصوصية</h1>
                    <div class="h-1.5 w-20 bg-blue-600 mx-auto rounded-full mb-6"></div>
                    <p class="text-slate-400 font-bold max-w-2xl mx-auto text-lg leading-relaxed">
                        نلتزم في منصة "بداية جديدة" بحماية خصوصيتك وضمان أمان بياناتك الشخصية وفقاً للمعايير العالمية.
                    </p>
                </div>
            </div>

            <div class="bg-white rounded-[2.5rem] p-8 md:p-14 shadow-xl border border-slate-100">

                <section class="mb-12">
                    <h2 class="text-2xl font-black text-slate-800 flex items-center gap-3 mb-6">
                        <span class="material-symbols-outlined text-blue-600 bg-blue-50 p-2 rounded-xl">database</span>
                        1. جمع المعلومات
                    </h2>
                    <p class="text-slate-600 font-medium leading-relaxed mb-6">نقوم بجمع البيانات التي تقدمها لنا مباشرة
                        لضمان سير العملية الخيرية:</p>
                    <ul class="policy-list">
                        <li><strong>البيانات الأساسية:</strong> الاسم الكامل، البريد الإلكتروني، ورقم التواصل.</li>
                        <li><strong>بيانات التبرع:</strong> سجلات المساهمات المالية (تتم عبر قنوات مشفرة تماماً).</li>
                        <li><strong>بيانات الحالات:</strong> الوثائق والمستندات المقدمة لطلب المساعدة.</li>
                    </ul>
                </section>

                <section class="mb-12">
                    <h2 class="text-2xl font-black text-slate-800 flex items-center gap-3 mb-6">
                        <span class="material-symbols-outlined text-blue-600 bg-blue-50 p-2 rounded-xl">security</span>
                        2. حماية البيانات
                    </h2>
                    <p class="text-slate-600 font-medium leading-relaxed mb-6">
                        نستخدم تقنيات التشفير المتقدمة (SSL) ونقوم بتخزين البيانات في خوادم سحابية مؤمنة. الوصول إلى
                        البيانات الشخصية يقتصر فقط على الموظفين المخولين لدراسة الحالات.
                    </p>
                </section>

                <div
                    class="mt-16 p-8 bg-slate-900 rounded-[2rem] text-center text-white relative overflow-hidden group">
                    <div class="absolute inset-0 bg-blue-600 opacity-0 group-hover:opacity-10 transition-opacity"></div>
                    <h3 class="text-xl font-black mb-4 text-blue-400">فريق دعم الخصوصية</h3>
                    <p class="text-slate-400 mb-6 font-bold">لأي استفسار يتعلق ببياناتك، يمكنك التواصل معنا مباشرة:</p>
                    <a href="mailto:privacy@newbeginning.org"
                        class="text-white font-black text-2xl hover:text-blue-400 transition underline underline-offset-8 decoration-blue-600">privacy@newbeginning.org</a>
                    <div class="mt-6">
                        <a href="{{ route('contactus') }}"
                            class="inline-flex items-center gap-2 rounded-xl border border-blue-500/30 bg-blue-500/10 px-5 py-3 text-sm font-bold text-blue-300 transition hover:bg-blue-500 hover:text-white">
                            <span class="material-symbols-outlined text-base">support_agent</span>
                            ارسل رسالة لفريق الدعم
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <x-land-footer />

    <!-- Map Popup Modal -->
    <div id="mapPopup"
        class="fixed inset-0 bg-black/70 backdrop-blur-sm z-[100] hidden items-center justify-center p-4"
        onclick="closeMapPopup(event)">
        <div class="bg-white rounded-3xl shadow-2xl max-w-4xl w-full overflow-hidden animate-fade-in"
            onclick="event.stopPropagation()">
            <div class="bg-gradient-to-r from-blue-600 to-blue-700 p-6 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <span class="material-symbols-outlined text-white text-3xl">location_on</span>
                    <h3 class="text-2xl font-bold text-white">موقعنا - جمهورية مصر العربية</h3>
                </div>
                <button onclick="closeMapPopup()" class="text-white hover:bg-white/20 p-2 rounded-xl transition-all">
                    <span class="material-symbols-outlined text-3xl">close</span>
                </button>
            </div>
            <div class="p-6">
                <div class="rounded-2xl overflow-hidden shadow-lg border-4 border-slate-100">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7290552.932147338!2d26.820553!3d26.820553!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x14368976c35c36e9%3A0x2c45a00925c4c444!2sEgypt!5e0!3m2!1sen!2seg!4v1234567890123!5m2!1sen!2seg"
                        width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
                <div class="mt-6 bg-blue-50 p-4 rounded-xl">
                    <p class="text-slate-700 text-center font-bold">
                        <span class="material-symbols-outlined text-blue-600 align-middle ml-2">info</span>
                        نخدم جميع محافظات جمهورية مصر العربية
                    </p>
                </div>
            </div>
        </div>
    </div>

    <script>
        function openMapPopup() {
            const popup = document.getElementById('mapPopup');
            popup.classList.remove('hidden');
            popup.classList.add('flex');
            document.body.style.overflow = 'hidden';
        }

        function closeMapPopup(event) {
            if (event && event.target !== event.currentTarget) return;
            const popup = document.getElementById('mapPopup');
            popup.classList.add('hidden');
            popup.classList.remove('flex');
            document.body.style.overflow = 'auto';
        }

        // Close popup with Escape key
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closeMapPopup();
            }
        });
    </script>

    <style>
        @keyframes fade-in {
            from {
                opacity: 0;
                transform: scale(0.95);
            }

            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        .animate-fade-in {
            animation: fade-in 0.3s ease-out;
        }
    </style>
</body>

</html>
