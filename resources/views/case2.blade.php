<!DOCTYPE html>
<html dir="rtl" lang="ar">

<head>
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>بداية جديدة - حالة العم إبراهيم</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;700;900&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" rel="stylesheet" />
    <style>
        body {
            font-family: 'Cairo', sans-serif;
        }

        .progress-gradient {
            background: linear-gradient(90deg, #3b82f6, #2563eb);
        }
    </style>
</head>

<body class="bg-slate-50 min-h-screen flex flex-col">

    <header class="sticky top-0 z-50 bg-[#020617]/95 backdrop-blur-md border-b border-white/5 shadow-xl">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">
                <div class="flex items-center gap-4 group cursor-pointer" onclick="window.location.href='{{ url('/') }}'">
                    <div class="relative">
                        <img src="assets/img/logo.jpeg" alt="Logo" width="50" height="50" class="rounded-xl shadow-lg group-hover:scale-105 transition-transform duration-300">
                        <div class="absolute inset-0 bg-blue-500/20 blur-xl rounded-full -z-10 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                    </div>
                    <span class="text-2xl font-bold tracking-tight text-white">بداية <span class="text-blue-500">جديدة</span></span>
                </div>

                <nav class="hidden md:flex items-center gap-10">
                    <a class="text-slate-300 hover:text-white font-medium transition-all relative after:content-[''] after:absolute after:w-0 after:h-0.5 after:bg-blue-500 after:bottom-[-4px] after:right-0 hover:after:w-full after:transition-all" href="{{ url('/') }}">الرئيسية</a>
                    <a class="text-slate-300 hover:text-white font-medium transition-all relative after:content-[''] after:absolute after:w-0 after:h-0.5 after:bg-blue-500 after:bottom-[-4px] after:right-0 hover:after:w-full after:transition-all" href="{{ url('caseslist') }}">الحالات</a>
                    <a class="text-slate-300 hover:text-white font-medium transition-all relative after:content-[''] after:absolute after:w-0 after:h-0.5 after:bg-blue-500 after:bottom-[-4px] after:right-0 hover:after:w-full after:transition-all" href="{{ url('donation') }}">خدمتنا</a>
                    <a class="text-slate-300 hover:text-white font-medium transition-all relative after:content-[''] after:absolute after:w-0 after:h-0.5 after:bg-blue-500 after:bottom-[-4px] after:right-0 hover:after:w-full after:transition-all" href="{{ url('aboutus') }}">من نحن</a>
                </nav>

                <div class="flex items-center gap-4">
                    <button class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2.5 rounded-xl font-bold transition-all shadow-lg shadow-blue-500/20 active:scale-95 hidden sm:flex items-center gap-2">
                        <span class="material-symbols-outlined text-[20px]">volunteer_activism</span>
                        <a href="{{ route('login') }}"> تسجيل دخول</a>
                    </button>

                    <button class="md:hidden text-white p-2">
                        <span class="material-symbols-outlined">menu</span>
                    </button>
                </div>
            </div>
        </div>
    </header>
    <main class="flex-grow max-w-6xl mx-auto w-full p-6 my-10">
        <div class="flex gap-2 text-sm font-bold text-slate-400 mb-8">
            <a href="{{ url('caseslist') }}" class="hover:text-blue-600">قائمة الحالات</a>
            <span>/</span>
            <span class="text-slate-800">توفير مسكن ورعاية</span>
        </div>

        <div class="flex flex-col lg:flex-row gap-10">
            <div class="lg:w-1/3">
                <div class="bg-white p-4 rounded-[2.5rem] shadow-xl shadow-slate-200/60 border border-white">
                    <img src="assets/img/man5 (2).jpg" alt="العم إبراهيم" class="w-full h-[400px] object-cover rounded-[2rem] shadow-inner">
                    <div class="mt-6 space-y-4 px-2">
                        <div class="flex justify-between items-center">
                            <span class="bg-blue-50 text-blue-600 px-4 py-1 rounded-full text-xs font-black">بلا مأوى</span>
                            <span class="text-slate-400 font-bold text-sm">رقم الحالة: #9905</span>
                        </div>
                        <h1 class="text-2xl font-black text-slate-800">العم إبراهيم (65 سنة)</h1>
                        <div class="flex items-center gap-2 text-slate-500 font-bold">
                            <span class="material-symbols-outlined text-blue-500">location_on</span>
                            <span>المنصورة، مصر</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="lg:w-2/3 space-y-8">
                <div class="bg-white p-10 rounded-[2.5rem] shadow-xl shadow-slate-200/60 border border-white relative overflow-hidden">
                    <div class="absolute top-0 right-0 p-8 opacity-5">
                        <span class="material-symbols-outlined text-[120px]">blind</span>
                    </div>

                    <h3 class="text-xl font-black text-slate-800 mb-6 flex items-center gap-3">
                        <span class="w-2 h-8 bg-blue-600 rounded-full"></span>
                        تفاصيل الحالة
                    </h3>
                    <p class="text-slate-600 leading-[2.2] font-medium text-lg text-justify">
                        العم إبراهيم رجل مسن، وجد نفسه وحيداً بلا مأوى بعد ظروف أسرية قاسية. يعيش حالياً في ظروف غير آدمية ويحتاج بشكل عاجل إلى توفير سكن كريم وآمن يضمن له حياة مستقرة، بالإضافة إلى توفير تكاليف علاجه الشهري للأمراض المزمنة التي يعاني منها.
                    </p>

                    <div class="mt-12 p-8 bg-slate-50 rounded-3xl border border-slate-100">
                        <div class="flex justify-between items-end mb-4">
                            <div>
                                <p class="text-slate-400 font-bold text-xs uppercase tracking-widest mb-1">المبلغ المطلوب</p>
                                <p class="text-3xl font-black text-slate-800">25,000 <span class="text-sm">ج.م</span></p>
                            </div>
                            <div class="text-left">
                                <p class="text-blue-600 font-black text-xl">45%</p>
                                <p class="text-slate-400 font-bold text-[10px]">تم جمع 11,250 ج.م</p>
                            </div>
                        </div>
                        <div class="w-full bg-slate-200 rounded-full h-4 overflow-hidden">
                            <div class="progress-gradient h-full rounded-full shadow-lg shadow-blue-500/40" style="width: 45%"></div>
                        </div>
                    </div>

                    <div class="mt-10 flex flex-col sm:flex-row gap-4">
                        <a href="{{ url('donation') }}" class="flex-1 bg-blue-700 hover:bg-blue-800 text-white py-5 rounded-2xl font-black text-lg shadow-2xl shadow-blue-700/30 transition-all active:scale-[0.98] flex items-center justify-center gap-3">
                            <span class="material-symbols-outlined">favorite</span>
                            ساعد العم إبراهيم
                        </a>
                        <button onclick="shareCase()" class="px-8 py-5 border-2 border-slate-100 rounded-2xl font-black text-slate-400 hover:bg-slate-50 transition-all flex items-center justify-center gap-3">
                            <span class="material-symbols-outlined">share</span>
                            نشر الحالة
                        </button>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="bg-white p-6 rounded-3xl border border-slate-100 flex items-center gap-5">
                        <div class="w-14 h-14 bg-blue-100 text-blue-600 rounded-2xl flex-shrink-0 flex items-center justify-center">
                            <span class="material-symbols-outlined">home</span>
                        </div>
                        <div class="min-w-0">
                            <p class="font-black text-slate-800">إيجار سكن</p>
                            <p class="text-xs text-slate-400 font-bold truncate">تأمين مأوى دائم</p>
                        </div>
                    </div>
                    <div class="bg-white p-6 rounded-3xl border border-slate-100 flex items-center gap-5">
                        <div class="w-14 h-14 bg-red-100 text-red-600 rounded-2xl flex-shrink-0 flex items-center justify-center">
                            <span class="material-symbols-outlined">medication</span>
                        </div>
                        <div class="min-w-0">
                            <p class="font-black text-slate-800">أدوية شهرية</p>
                            <p class="text-xs text-slate-400 font-bold truncate">علاج ضغط وسكري</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!--Footer-->
    <x-land-footer />

    <!-- Map Popup Modal -->
    <div id="mapPopup" class="fixed inset-0 bg-black/70 backdrop-blur-sm z-[100] hidden items-center justify-center p-4" onclick="closeMapPopup(event)">
        <div class="bg-white rounded-3xl shadow-2xl max-w-4xl w-full overflow-hidden animate-fade-in" onclick="event.stopPropagation()">
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
                        width="100%"
                        height="450"
                        style="border:0;"
                        allowfullscreen=""
                        loading="lazy"
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
        function shareCase() {
            if (navigator.share) {
                navigator.share({
                    title: document.title,
                    text: 'ساهم في توفير سكن كريم للعم إبراهيم. شارك الحالة ولك الأجر!',
                    url: window.location.href
                });
            } else {
                const el = document.createElement('textarea');
                el.value = window.location.href;
                document.body.appendChild(el);
                el.select();
                document.execCommand('copy');
                document.body.removeChild(el);
                alert('تم نسخ رابط حالة العم إبراهيم بنجاح! يمكنك الآن لصقه ومشاركته. 🔗');
            }
        }

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
