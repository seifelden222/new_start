<!DOCTYPE html>
<html dir="rtl" lang="ar">

<head>
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>بداية جديدة - من نحن</title>

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


    <section class="relative py-20 md:py-28 bg-gradient-to-b from-[#0f172a] to-[#1e293b] text-white">
        <div class="absolute inset-0 opacity-10 pointer-events-none">
            <div class="absolute top-0 right-0 w-1/2 h-1/2 bg-blue-500/20 rounded-full blur-3xl"></div>
            <div class="absolute bottom-0 left-0 w-1/2 h-1/2 bg-blue-500/10 rounded-full blur-3xl"></div>
        </div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl md:text-6xl font-extrabold tracking-tight mb-6">
                من <span class="text-blue-400">نحن</span>
            </h1>
            <p class="text-xl md:text-2xl text-slate-300 max-w-4xl mx-auto leading-relaxed">
                منصة إنسانية تهدف إلى إعادة الأمل وإعادة بناء الحياة الكريمة للأيتام والمشردين والفئات الأكثر احتياجًا في مجتمعنا
            </p>
        </div>
    </section>

    <section class="py-20 bg-white dark:bg-slate-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-2 gap-16 items-center">
                <div>
                    <h2 class="text-4xl font-bold text-slate-900 dark:text-white mb-8">
                        قصتنا ورؤيتنا
                    </h2>
                    <div class="space-y-6 text-lg text-slate-600 dark:text-slate-300 leading-relaxed">
                        <p>
                            تأسست "بداية جديدة" في عام 2026 بدافع إيمان عميق بأن كل إنسان يستحق فرصة ثانية، وأن المجتمع القوي هو الذي يمد يد العون لأضعف أفراده.
                        </p>
                        <p>
                            نحن نعمل على تقديم دعم شامل ومستدام يتجاوز المساعدات المؤقتة، لنصل إلى تمكين حقيقي يعيد للأفراد كرامتهم واستقلاليتهم من خلال التعليم، التدريب المهني، الإيواء الكريم، والدعم النفسي والاجتماعي.
                        </p>
                        <p>
                            رؤيتنا هي مجتمع لا يترك أحدًا خلفه، حيث يجد كل شخص مكانًا يسميه وطنًا، وفرصة لبناء مستقبل أفضل.
                        </p>
                    </div>
                </div>

                <div class="relative rounded-2xl overflow-hidden shadow-2xl">
                    <img
                        src="assets/img/Poor-family.jpg"
                        alt="فريق العمل مع المستفيدين"
                        class="w-full h-full object-cover" />
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                    <div class="absolute bottom-6 right-6 text-white">
                        <p class="text-lg font-bold">أكثر من 1,250 حالة مدعومة حتى الآن</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-20 bg-slate-50 dark:bg-slate-950">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-4xl md:text-5xl font-bold text-center text-slate-900 dark:text-white mb-16">
                قيمنا الأساسية
            </h2>

            <div class="grid md:grid-cols-3 gap-10">
                <div class="bg-white dark:bg-slate-800 p-8 rounded-2xl shadow-lg border border-slate-100 dark:border-slate-700 hover:shadow-xl transition-all">
                    <div class="size-16 bg-blue-100 dark:bg-blue-900/30 rounded-2xl flex items-center justify-center mb-6">
                        <span class="material-symbols-outlined text-blue-600 text-4xl">lightbulb</span>
                    </div>
                    <h3 class="text-2xl font-bold mb-4">الشفافية</h3>
                    <p class="text-slate-600 dark:text-slate-300">
                        نلتزم بعرض كل التفاصيل المالية والإدارية بشكل واضح ومفتوح لكل المتبرعين والشركاء.
                    </p>
                </div>

                <div class="bg-white dark:bg-slate-800 p-8 rounded-2xl shadow-lg border border-slate-100 dark:border-slate-700 hover:shadow-xl transition-all">
                    <div class="size-16 bg-blue-100 dark:bg-blue-900/30 rounded-2xl flex items-center justify-center mb-6">
                        <span class="material-symbols-outlined text-blue-600 text-4xl">handshake</span>
                    </div>
                    <h3 class="text-2xl font-bold mb-4">الكرامة</h3>
                    <p class="text-slate-600 dark:text-slate-300">
                        نعامل كل مستفيد كإنسان له كرامة وطموح، وليس مجرد حالة تحتاج مساعدة.
                    </p>
                </div>

                <div class="bg-white dark:bg-slate-800 p-8 rounded-2xl shadow-lg border border-slate-100 dark:border-slate-700 hover:shadow-xl transition-all">
                    <div class="size-16 bg-blue-100 dark:bg-blue-900/30 rounded-2xl flex items-center justify-center mb-6">
                        <span class="material-symbols-outlined text-blue-600 text-4xl">trending_up</span>
                    </div>
                    <h3 class="text-2xl font-bold mb-4">الاستدامة</h3>
                    <p class="text-slate-600 dark:text-slate-300">
                        نركز على حلول طويلة الأمد تمكن الأفراد من الاعتماد على أنفسهم مستقبلاً.
                    </p>
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