<!DOCTYPE html>
<html dir="rtl" lang="ar">

<head>
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>بداية جديدة</title>

    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;500;600;700;800;900&family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&display=swap" rel="stylesheet" />

    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>

    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#007bff",
                        "background-light": "#f5f7f8",
                        "background-dark": "#0f1923",
                    },
                    fontFamily: {
                        sans: ["Cairo", "Public Sans", "system-ui", "sans-serif"],
                        display: ["Cairo", "sans-serif"],
                    },
                    borderRadius: {
                        DEFAULT: "0.25rem",
                        lg: "0.5rem",
                        xl: "0.75rem",
                        "2xl": "1rem",
                        full: "9999px"
                    },
                },
            },
        }
    </script>

    <style>
        body {
            font-family: "Cairo", "Public Sans", system-ui, sans-serif;
            font-weight: 400;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-weight: 700;
        }

        .material-symbols-outlined {
            font-variation-settings: 'FILL' 1, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
    </style>
</head>

<body class="bg-background-light dark:bg-background-dark text-slate-900 dark:text-slate-100 antialiased overflow-x-hidden">

    <x-land-navbar />
    <section class="relative h-[650px] flex items-center overflow-hidden bg-[#0f172a]">
        <div class="absolute inset-0 z-0">
            <img alt="عامل إنساني يساعد طفلاً" class="w-full h-full object-cover opacity-70" src="https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80" />
            <div class="absolute inset-0 bg-gradient-to-l from-[#0f172a] via-[#0f172a]/60 to-[#1e293b]/30"></div>
            <div class="absolute inset-0 backdrop-blur-[1px]"></div>
        </div>

        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full text-right">
            <div class="max-w-2xl space-y-7">
                <div class="space-y-3">
                    <h1 class="text-white text-4xl md:text-5xl font-black leading-tight tracking-tight drop-shadow-xl">
                        "لأن كل إنسان يستحق وطناً"
                    </h1>
                    <p class="text-blue-300 italic text-xl md:text-2xl font-bold opacity-90 transition-all">
                        نرافقهم في رحلة العودة للحياة والكرامة
                    </p>
                </div>

                <p class="text-slate-300 text-lg md:text-xl font-medium leading-relaxed max-w-xl italic opacity-85">
                    في 'بداية جديدة'، مش بس بنوفر سقف وجدران، إحنا بنبني أمل لكل إنسان تاه منه الطريق. هدفنا نكون السند اللي بيساعدهم يرجعوا لحياتهم بكرامة، لأن كل فرصة بنقدمها هي حياة بتتغير.
                </p>

                <div class="flex flex-wrap gap-4 pt-4 justify-start">
                    <a href="{{url('donation')}}" class="bg-blue-600/80 hover:bg-blue-600 text-white text-base px-10 py-3.5 rounded-2xl font-black transition-all shadow-lg shadow-blue-900/20 flex items-center gap-2 active:scale-95 group">
                        <span class="material-symbols-outlined text-xl group-hover:rotate-12 transition-transform">volunteer_activism</span>
                        ابدأ الآن
                    </a>

                    <a href="{{url('aboutus')}}" class="bg-white/5 hover:bg-white/10 backdrop-blur-md border border-white/10 text-slate-200 text-base px-10 py-3.5 rounded-2xl font-black transition-all flex items-center gap-2 group">
                        <span class="material-symbols-outlined text-xl text-blue-300 group-hover:scale-110 transition-transform">visibility</span>
                        تعرف علينا
                    </a>
                </div>

            </div>
        </div>

        </div>
        </div>
        </div>

        <div class="absolute top-0 -right-1/4 size-[700px] bg-blue-500/20 blur-[120px] rounded-full z-0"></div>
    </section>

    <section class="relative z-20 -mt-16 max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="group bg-white p-7 rounded-2xl shadow-[0_15px_40px_rgba(0,0,0,0.08)] flex flex-col items-center text-center transition-all duration-500 hover:-translate-y-2 border border-slate-50">
                <div class="size-14 bg-blue-50 rounded-xl flex items-center justify-center mb-4 group-hover:bg-blue-600 transition-colors duration-500">
                    <span class="material-symbols-outlined text-blue-600 text-3xl group-hover:text-white transition-colors">work</span>
                </div>
                <p class="text-3xl font-black text-slate-900 mb-1 tracking-tight">+150</p>
                <p class="text-slate-500 font-bold text-base tracking-wide">فرصة عمل</p>
            </div>

            <div class="group bg-white p-7 rounded-2xl shadow-[0_15px_40px_rgba(0,0,0,0.08)] flex flex-col items-center text-center transition-all duration-500 hover:-translate-y-2 border border-slate-50">
                <div class="size-14 bg-blue-50 rounded-xl flex items-center justify-center mb-4 group-hover:bg-blue-600 transition-colors duration-500">
                    <span class="material-symbols-outlined text-blue-600 text-3xl group-hover:text-white transition-colors">volunteer_activism</span>
                </div>
                <p class="text-3xl font-black text-slate-900 mb-1 tracking-tight">3,420</p>
                <p class="text-slate-500 font-bold text-base tracking-wide">متبرع</p>
            </div>

            <div class="group bg-white p-7 rounded-2xl shadow-[0_15px_40px_rgba(0,0,0,0.08)] flex flex-col items-center text-center transition-all duration-500 hover:-translate-y-2 border border-slate-50">
                <div class="size-14 bg-blue-50 rounded-xl flex items-center justify-center mb-4 group-hover:bg-blue-600 transition-colors duration-500">
                    <span class="material-symbols-outlined text-blue-600 text-3xl group-hover:text-white transition-colors">handshake</span>
                </div>
                <p class="text-3xl font-black text-slate-900 mb-1 tracking-tight">1,250</p>
                <p class="text-slate-500 font-bold text-base tracking-wide">حالة مدعومة</p>
            </div>
        </div>
    </section>

    <section class="py-24 bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-extrabold text-[#0f172a] mb-6">خدماتنا الإنسانية</h2>
                <div class="h-1.5 w-60 bg-blue-600 mx-auto rounded-full"></div>
                <p class="mt-8 text-slate-600 text-xl max-w-2xl mx-auto leading-relaxed font-medium">
                    نقدم مجموعة شاملة من الخدمات المصممة لإعادة دمج الأفراد في المجتمع بكرامة واستقلال.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                <div class="group bg-white rounded-[2rem] overflow-hidden shadow-[0_10px_40px_rgba(0,0,0,0.04)] hover:shadow-[0_25px_50px_rgba(0,0,0,0.1)] transition-all duration-500 border border-slate-100 flex flex-col h-full">
                    <div class="h-56 overflow-hidden relative">
                        <img alt="التدريب المهني" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" src="https://images.unsplash.com/photo-1524178232363-1fb2b075b655?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" />
                        <div class="absolute inset-0 bg-blue-900/10 group-hover:bg-transparent transition-colors"></div>
                        <div class="absolute bottom-4 right-4 bg-white/90 backdrop-blur px-3 py-1 rounded-lg text-blue-600 text-sm font-bold">تطوير</div>
                    </div>
                    <div class="p-8 flex flex-col flex-grow">
                        <div class="flex items-center gap-3 mb-4">
                            <span class="material-symbols-outlined text-blue-600 bg-blue-50 p-2 rounded-xl">school</span>
                            <h3 class="text-2xl font-bold text-[#0f172a]">التدريب المهني</h3>
                        </div>
                        <p class="text-slate-600 leading-relaxed mb-8 flex-grow text-lg">
                            برامج تدريبية مكثفة تهدف لتمكين الأفراد من اكتساب مهارات عملية تساعدهم في الحصول على وظائف مستدامة.
                        </p>
                        <a class="group/link inline-flex items-center gap-2 text-blue-600 font-bold hover:gap-4 transition-all" href="{{url("vocationaltraining")}}">
                            اقرأ المزيد
                            <span class="material-symbols-outlined text-xl rotate-180 transition-transform group-hover/link:translate-x-[-5px]">arrow_right_alt</span>
                        </a>
                    </div>
                </div>

                <div class="group bg-white rounded-[2rem] overflow-hidden shadow-[0_10px_40px_rgba(0,0,0,0.04)] hover:shadow-[0_25px_50px_rgba(0,0,0,0.1)] transition-all duration-500 border border-slate-100 flex flex-col h-full">
                    <div class="h-56 overflow-hidden relative">
                        <img alt="التبرع السريع" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAAvAvWl1286vQSDkxFpGakjpLe0PQL2ThniUxrIspJ-5BWVL7mJfoGH_SlKoVwEYIrG1-pjpaoSzSIVCXl8HGzRvkLyyBELPXFbcYodjltIsZnbpVe0Hh8jcxs40EfxsSXCABTwTp49QX0A3zqlA404bEmfAaf9kj0fciBbltAvoI2Z1LvPWFp-PApRKeOoxGLOFgHiSVmpZUlI1rVMi9S2fBtzPYjDHr-RKShiSNPIbWQ2JT5LpIzxph2p1qfEf653KXa1MJ0vg">
                        <div class="absolute inset-0 bg-blue-900/10 group-hover:bg-transparent transition-colors"></div>
                        <div class="absolute bottom-4 right-4 bg-white/90 backdrop-blur px-3 py-1 rounded-lg text-blue-600 text-sm font-bold">مساهمة</div>
                    </div>
                    <div class="p-8 flex flex-col flex-grow">
                        <div class="flex items-center gap-3 mb-4">
                            <span class="material-symbols-outlined text-blue-600 bg-blue-50 p-2 rounded-xl">payments</span>
                            <h3 class="text-2xl font-bold text-[#0f172a]">التبرع السريع</h3>
                        </div>
                        <p class="text-slate-600 leading-relaxed mb-8 flex-grow text-lg">
                            ساهم في تغيير حياة شخص بضغط زر واحدة. نظام تبرع آمن وسريع يضمن وصول مساعدتك مباشرة لمستحقيها.
                        </p>
                        <a class="group/link inline-flex items-center gap-2 text-blue-600 font-bold hover:gap-4 transition-all" href="{{url('donation')}}">
                            تبرع الآن
                            <span class="material-symbols-outlined text-xl rotate-180 transition-transform group-hover/link:translate-x-[-5px]">arrow_right_alt</span>
                        </a>
                    </div>
                </div>

                <div class="group bg-white rounded-[2rem] overflow-hidden shadow-[0_10px_40px_rgba(0,0,0,0.04)] hover:shadow-[0_25px_50px_rgba(0,0,0,0.1)] transition-all duration-500 border border-slate-100 flex flex-col h-full">
                    <div class="h-56 overflow-hidden relative">
                        <img alt="عرض الحالات" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" src="https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" />
                        <div class="absolute inset-0 bg-blue-900/10 group-hover:bg-transparent transition-colors"></div>
                        <div class="absolute bottom-4 right-4 bg-white/90 backdrop-blur px-3 py-1 rounded-lg text-blue-600 text-sm font-bold">شفافية</div>
                    </div>
                    <div class="p-8 flex flex-col flex-grow">
                        <div class="flex items-center gap-3 mb-4">
                            <span class="material-symbols-outlined text-blue-600 bg-blue-50 p-2 rounded-xl">visibility</span>
                            <a href="{{url('donation')}}">
                                <h3 class="text-2xl font-bold text-[#0f172a]">عرض الحالات</h3>
                            </a>
                        </div>
                        <p class="text-slate-600 leading-relaxed mb-8 flex-grow text-lg">
                            اطلع على القصص والحالات الإنسانية التي تحتاج إلى دعم عاجل. كن جزءاً فعالاً من قصة نجاحهم القادمة.
                        </p>
                        <a class="group/link inline-flex items-center gap-2 text-blue-600 font-bold hover:gap-4 transition-all" href="{{url('caseslist')}}">
                            تصفح الحالات
                            <span class="material-symbols-outlined text-xl rotate-180 transition-transform group-hover/link:translate-x-[-5px]">arrow_right_alt</span>
                        </a>
                    </div>
                </div>
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
