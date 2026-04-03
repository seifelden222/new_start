<!DOCTYPE html>
<html dir="rtl" lang="ar">

<head>
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>بداية جديدة - التدريب المهني</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;700;900&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" rel="stylesheet" />
    <style>
        body {
            font-family: 'Cairo', sans-serif;
            background-color: #f8fafc;
        }

        .course-card {
            transition: all 0.4s ease;
            border-radius: 2.5rem;
            overflow: hidden;
        }

        .course-card:hover {
            transform: translateY(-15px);
            shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.1);
            border-color: #3b82f6;
        }

        .image-overlay {
            background: linear-gradient(to top, rgba(2, 6, 23, 0.9), transparent);
        }

        #toast {
            visibility: hidden;
            min-width: 300px;
            background-color: #10b981;
            color: white;
            text-align: center;
            border-radius: 50px;
            padding: 20px;
            position: fixed;
            z-index: 1000;
            left: 50%;
            bottom: 40px;
            transform: translateX(-50%);
            font-weight: 900;
            box-shadow: 0 10px 20px rgba(16, 185, 129, 0.3);
        }

        #toast.show {
            visibility: visible;
            animation: fadein 0.5s, fadeout 0.5s 2.5s;
        }

        @keyframes fadein {
            from {
                bottom: 0;
                opacity: 0;
            }

            to {
                bottom: 40px;
                opacity: 1;
            }
        }

        @keyframes fadeout {
            from {
                bottom: 40px;
                opacity: 1;
            }

            to {
                bottom: 0;
                opacity: 0;
            }
        }
    </style>
</head>

<body class="text-slate-800">

    <div id="toast">تم تسجيل طلبك في الدورة بنجاح يا مي.. بالتوفيق! 🎓</div>

    <header class="sticky top-0 z-50 bg-[#020617]/95 backdrop-blur-md border-b border-white/5 shadow-xl">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">
                <div class="flex items-center gap-4 group cursor-pointer" onclick="window.location.href='{{url('/')}}'">
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
                        <a href="{{ url('login') }}"> تسجيل دخول</a>
                    </button>

                    <button class="md:hidden text-white p-2">
                        <span class="material-symbols-outlined">menu</span>
                    </button>
                </div>
            </div>
        </div>
    </header>

    <section class="py-20 bg-gradient-to-b from-[#020617] to-slate-900 text-white text-center relative overflow-hidden">
        <div class="relative z-10 max-w-4xl mx-auto px-6">
            <span class="bg-blue-600/20 text-blue-400 px-6 py-2 rounded-full text-[10px] font-black tracking-widest uppercase mb-6 inline-block">بناء المستقبل بالمهارات</span>
            <h2 class="text-4xl md:text-6xl font-black mb-6 italic tracking-tight">مركز <span class="text-blue-500">التدريب المهني</span></h2>
            <p class="text-slate-400 text-lg font-medium leading-relaxed">نساعد الأيتام والمشردين على تعلم حرف حقيقية تضمن لهم حياة كريمة ومستقرة.</p>
        </div>
    </section>

    <main class="max-w-7xl mx-auto px-6 py-20">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-10">

            <div class="course-card bg-white border border-slate-100 shadow-sm flex flex-col h-full italic">
                <div class="relative h-56">
                    <img src="https://images.unsplash.com/photo-1517694712202-14dd9538aa97?q=80&w=2070" class="size-full object-cover" alt="Coding">
                    <div class="absolute inset-0 image-overlay p-6 flex items-end">
                        <span class="bg-blue-600 text-white px-4 py-1 rounded-lg text-[10px] font-black uppercase">التكنولوجيا</span>
                    </div>
                </div>
                <div class="p-8 flex-grow">
                    <h3 class="text-xl font-black text-slate-800 mb-4">أساسيات تطوير الويب</h3>
                    <p class="text-slate-500 text-sm leading-loose mb-6 font-bold">تعلم بناء المواقع الإلكترونية من الصفر، لفتح آفاق العمل الحر في عالم الديجيتال.</p>
                    <div class="flex justify-between items-center text-[11px] font-black text-slate-400 border-t pt-6">
                        <span class="flex items-center gap-2"><span class="material-symbols-outlined text-sm">schedule</span> 3 شهور</span>
                        <span class="flex items-center gap-2 text-emerald-500"><span class="material-symbols-outlined text-sm">check_circle</span> متاح الآن</span>
                    </div>
                </div>
                <button onclick="enroll()" class="m-6 bg-slate-50 hover:bg-blue-600 hover:text-white text-slate-800 py-4 rounded-2xl font-black transition-all">سجل في الدورة</button>
            </div>

            <div class="course-card bg-white border border-slate-100 shadow-sm flex flex-col h-full italic">
                <div class="relative h-56">
                    <img src="https://images.unsplash.com/photo-1581092918056-0c4c3acd3789?q=80&w=2070" class="size-full object-cover" alt="Workshop">
                    <div class="absolute inset-0 image-overlay p-6 flex items-end">
                        <span class="bg-orange-500 text-white px-4 py-1 rounded-lg text-[10px] font-black uppercase">مهن فنية</span>
                    </div>
                </div>
                <div class="p-8 flex-grow">
                    <h3 class="text-xl font-black text-slate-800 mb-4">صيانة الإلكترونيات</h3>
                    <p class="text-slate-500 text-sm leading-loose mb-6 font-bold">دورة مكثفة في إصلاح الهواتف والأجهزة المنزلية لتأسيس مشروعك الخاص.</p>
                    <div class="flex justify-between items-center text-[11px] font-black text-slate-400 border-t pt-6">
                        <span class="flex items-center gap-2"><span class="material-symbols-outlined text-sm">schedule</span> 2 شهر</span>
                        <span class="flex items-center gap-2 text-emerald-500"><span class="material-symbols-outlined text-sm">check_circle</span> متاح الآن</span>
                    </div>
                </div>
                <button onclick="enroll()" class="m-6 bg-slate-50 hover:bg-blue-600 hover:text-white text-slate-800 py-4 rounded-2xl font-black transition-all">سجل في الدورة</button>
            </div>

            <div class="course-card bg-white border border-slate-100 shadow-sm flex flex-col h-full italic">
                <div class="relative h-56">
                    <img src="https://images.unsplash.com/photo-1524234107056-1c1f48f64ab8?q=80&w=2070" class="size-full object-cover" alt="Fashion">
                    <div class="absolute inset-0 image-overlay p-6 flex items-end">
                        <span class="bg-rose-500 text-white px-4 py-1 rounded-lg text-[10px] font-black uppercase">تصميم أزياء</span>
                    </div>
                </div>
                <div class="p-8 flex-grow">
                    <h3 class="text-xl font-black text-slate-800 mb-4">فنون الخياطة والتطريز</h3>
                    <p class="text-slate-500 text-sm leading-loose mb-6 font-bold">تمكين السيدات والفتيات من مهارات التفصيل الاحترافي لإدارة مشاغلهم المنزلية.</p>
                    <div class="flex justify-between items-center text-[11px] font-black text-slate-400 border-t pt-6">
                        <span class="flex items-center gap-2"><span class="material-symbols-outlined text-sm">schedule</span> 4 شهور</span>
                        <span class="flex items-center gap-2 text-emerald-500"><span class="material-symbols-outlined text-sm">check_circle</span> متاح الآن</span>
                    </div>
                </div>
                <button onclick="enroll()" class="m-6 bg-slate-50 hover:bg-blue-600 hover:text-white text-slate-800 py-4 rounded-2xl font-black transition-all">سجل في الدورة</button>
            </div>

        </div>
    </main>

    <section class="bg-white py-20 border-t border-slate-100 italic">
        <div class="max-w-7xl mx-auto px-6 grid md:grid-cols-4 gap-12 text-center">
            <div>
                <span class="material-symbols-outlined text-4xl text-blue-600 mb-4">workspace_premium</span>
                <h5 class="font-black text-lg mb-2">شهادات معتمدة</h5>
                <p class="text-slate-400 text-xs font-bold">تساعدك في دخول سوق العمل فوراً.</p>
            </div>
            <div>
                <span class="material-symbols-outlined text-4xl text-blue-600 mb-4">engineering</span>
                <h5 class="font-black text-lg mb-2">تدريب عملي</h5>
                <p class="text-slate-400 text-xs font-bold">80% من الكورس تطبيق ميداني.</p>
            </div>
            <div>
                <span class="material-symbols-outlined text-4xl text-blue-600 mb-4">handshake</span>
                <h5 class="font-black text-lg mb-2">فرص توظيف</h5>
                <p class="text-slate-400 text-xs font-bold">توفير عمل للمتفوقين بعد التخرج.</p>
            </div>
            <div>
                <span class="material-symbols-outlined text-4xl text-blue-600 mb-4">home_repair_service</span>
                <h5 class="font-black text-lg mb-2">معدات مجانية</h5>
                <p class="text-slate-400 text-xs font-bold">دعم بالأدوات اللازمة لبدء العمل.</p>
            </div>
        </div>
    </section>

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
        function enroll() {
            const toast = document.getElementById("toast");
            toast.className = "show";
            setTimeout(() => {
                toast.className = toast.className.replace("show", "");
            }, 3000);
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
