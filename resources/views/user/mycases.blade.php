<!DOCTYPE html>
<html dir="rtl" lang="ar">

<head>
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>حالات أتابعها - بداية جديدة</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700;900&family=Public+Sans:wght@400;500;600;700&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />
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
                        "display": ["Cairo", "Public Sans", "sans-serif"]
                    },
                    borderRadius: {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "full": "9999px"
                    },
                },
            },
        }
    </script>
    <style>
        body {
            font-family: 'Cairo', 'Public Sans', sans-serif;
        }

        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }

        .active-nav {
            background-color: rgba(0, 123, 255, 0.1);
            color: #007bff;
            border-right: 4px solid #007bff;
        }
    </style>
</head>

<body class="bg-background-light dark:bg-background-dark text-slate-900 dark:text-slate-100">
    <div class="flex min-h-screen">


        <x-user-slider />
        <main class="flex-1 mr-64">

            <x-user-navbar />

            <div class="p-8 max-w-7xl mx-auto space-y-8">

                <div class="bg-white dark:bg-slate-900 rounded-xl border border-slate-200 dark:border-slate-800 shadow-sm p-8">
                    <h2 class="text-3xl font-black mb-2 text-primary">الحالات التي أتابعها</h2>
                    <p class="text-slate-500 dark:text-slate-400 mb-8">الحالات التي قمت بدعمها واخترت متابعتها لمعرفة آخر التطورات - ٤ حالات نشطة</p>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                        <div class="bg-white dark:bg-slate-900 rounded-xl border border-slate-200 dark:border-slate-800 overflow-hidden group hover:shadow-md transition-shadow">
                            <div class="h-48 bg-slate-200 overflow-hidden relative">
                                <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" src="../assets/img/karema.jpg">
                                <span class="absolute top-3 right-3 bg-red-500 text-white text-xs px-3 py-1 rounded-full font-bold">مستمر</span>
                            </div>
                            <div class="p-5">
                                <h4 class="font-black text-base mb-2">توفير مسكن لعائلة مكونة من ٥ أفراد - غزة</h4>
                                <p class="text-slate-600 dark:text-slate-300 text-sm mb-4 line-clamp-2">متابعة حالة العائلة بعد الحريق الذي أفقدهم منزلهم، يتم تحديث الحالة أسبوعياً.</p>
                                <div class="space-y-3 mb-4">
                                    <div class="flex justify-between text-sm">
                                        <span class="text-slate-500">تم جمع</span>
                                        <span class="font-bold">4,200 جنيه مصري</span>
                                    </div>
                                    <div class="w-full bg-slate-100 dark:bg-slate-800 h-2.5 rounded-full overflow-hidden">
                                        <div class="bg-primary h-full rounded-full" style="width: 42%"></div>
                                    </div>
                                    <div class="flex justify-between text-xs text-slate-500">
                                        <span>الهدف: 10,000 جنيه</span>
                                        <span>٤٢%</span>
                                    </div>
                                </div>
                                <button onclick="viewCaseDetails('توفير مسكن لعائلة مكونة من ٥ أفراد - غزة', '4,200', '10,000', '42')" class="w-full bg-primary/10 text-primary py-2.5 rounded-lg text-sm font-bold hover:bg-primary/20 transition-colors">
                                    متابعة التطورات
                                </button>
                            </div>
                        </div>

                        <div class="bg-white dark:bg-slate-900 rounded-xl border border-slate-200 dark:border-slate-800 overflow-hidden group hover:shadow-md transition-shadow">
                            <div class="h-48 bg-slate-200 overflow-hidden relative">
                                <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" src="../assets/img/baby.jpg">
                                <span class="absolute top-3 right-3 bg-emerald-500 text-white text-xs px-3 py-1 rounded-full font-bold">اكتمل تقريباً</span>
                            </div>
                            <div class="p-5">
                                <h4 class="font-black text-base mb-2">عملية جراحية للطفل سليم - استعادة البصر</h4>
                                <p class="text-slate-600 dark:text-slate-300 text-sm mb-4 line-clamp-2">تم جمع معظم المبلغ المطلوب، سيتم إجراء العملية خلال الأسابيع القادمة.</p>
                                <div class="space-y-3 mb-4">
                                    <div class="flex justify-between text-sm">
                                        <span class="text-slate-500">تم جمع</span>
                                        <span class="font-bold">7,500 جنيه مصري</span>
                                    </div>
                                    <div class="w-full bg-slate-100 dark:bg-slate-800 h-2.5 rounded-full overflow-hidden">
                                        <div class="bg-emerald-500 h-full rounded-full" style="width: 88%"></div>
                                    </div>
                                    <div class="flex justify-between text-xs text-slate-500">
                                        <span>الهدف: 8,500 جنيه</span>
                                        <span>٨٨%</span>
                                    </div>
                                </div>
                                <button onclick="viewCaseDetails('عملية جراحية للطفل سليم - استعادة البصر', '7,500', '8,500', '88')" class="w-full bg-emerald-500/10 text-emerald-600 py-2.5 rounded-lg text-sm font-bold hover:bg-emerald-500/20 transition-colors">
                                    عرض آخر التحديثات
                                </button>
                            </div>
                        </div>

                        <div class="bg-white dark:bg-slate-900 rounded-xl border border-slate-200 dark:border-slate-800 overflow-hidden group hover:shadow-md transition-shadow">
                            <div class="h-48 bg-slate-200 overflow-hidden relative">
                                <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" src="../assets/img/man.jpg">
                                <span class="absolute top-3 right-3 bg-amber-500 text-white text-xs px-3 py-1 rounded-full font-bold">مستمر</span>
                            </div>
                            <div class="p-5">
                                <h4 class="font-black text-base mb-2">عائلة أم محمد - دعم غذائي شهري</h4>
                                <p class="text-slate-600 dark:text-slate-300 text-sm mb-4 line-clamp-2">برنامج دعم مستمر للعائلة، يتم تجديد التبرع الشهري تلقائياً.</p>
                                <div class="space-y-3 mb-4">
                                    <div class="flex justify-between text-sm">
                                        <span class="text-slate-500">آخر تبرع</span>
                                        <span class="font-bold">50 جنيه مصري</span>
                                    </div>
                                    <div class="flex justify-between text-sm">
                                        <span class="text-slate-500">تاريخ آخر تحديث</span>
                                        <span class="font-bold">قبل يومين</span>
                                    </div>
                                </div>
                                <button onclick="viewCaseDetails('عائلة أم محمد - دعم غذائي شهري', '50', 'مستمر', 'شهري')" class="w-full bg-amber-500/10 text-amber-600 py-2.5 rounded-lg text-sm font-bold hover:bg-amber-500/20 transition-colors">
                                    متابعة الحالة
                                </button>
                            </div>
                        </div>

                        <div class="bg-white dark:bg-slate-900 rounded-xl border border-slate-200 dark:border-slate-800 overflow-hidden group hover:shadow-md transition-shadow">
                            <div class="h-48 bg-slate-200 overflow-hidden relative">
                                <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" src="../assets/img/Poor-family.jpg">
                                <span class="absolute top-3 right-3 bg-blue-500 text-white text-xs px-3 py-1 rounded-full font-bold">طويل الأمد</span>
                            </div>
                            <div class="p-5">
                                <h4 class="font-black text-base mb-2">كبار السن - حي البساتين</h4>
                                <p class="text-slate-600 dark:text-slate-300 text-sm mb-4 line-clamp-2">مشروع دعم مستمر لعدد من كبار السن في الحي، يشمل أدوية ومساعدات غذائية.</p>
                                <div class="space-y-3 mb-4">
                                    <div class="flex justify-between text-sm">
                                        <span class="text-slate-500">عدد المستفيدين</span>
                                        <span class="font-bold">١٤ شخص</span>
                                    </div>
                                    <div class="flex justify-between text-sm">
                                        <span class="text-slate-500">آخر تحديث</span>
                                        <span class="font-bold">منذ ١٠ أيام</span>
                                    </div>
                                </div>
                                <button onclick="viewCaseDetails('كبار السن - حي البساتين', '14 شخص', 'طويل الأمد', 'منذ ١٠ أيام')" class="w-full bg-blue-500/10 text-blue-600 py-2.5 rounded-lg text-sm font-bold hover:bg-blue-500/20 transition-colors">
                                    عرض التفاصيل
                                </button>
                            </div>
                        </div>

                    </div>



                </div>

            </div>
        </main>

    </div>

    <!-- Notifications Popup -->
    <div id="notificationsPopup" class="hidden fixed inset-0 bg-black/50 z-50 flex items-start justify-center pt-20" onclick="closeNotifications(event)">
        <div class="bg-white dark:bg-slate-900 rounded-2xl shadow-2xl w-full max-w-md mx-4" onclick="event.stopPropagation()">
            <div class="p-6 border-b border-slate-200 dark:border-slate-800 flex items-center justify-between">
                <h3 class="text-lg font-bold text-slate-900 dark:text-white">الإشعارات</h3>
                <button onclick="closeNotifications()" class="text-slate-400 hover:text-slate-600 dark:hover:text-slate-400">
                    <span class="material-symbols-outlined">close</span>
                </button>
            </div>
            <div class="p-4 max-h-96 overflow-y-auto">
                <div class="space-y-3">
                    <div class="p-4 bg-blue-50 dark:bg-blue-900/20 rounded-xl hover:bg-blue-100 dark:hover:bg-blue-900/30 transition-colors cursor-pointer">
                        <div class="flex items-start gap-3">
                            <span class="material-symbols-outlined text-blue-600">volunteer_activism</span>
                            <div class="flex-1">
                                <p class="font-bold text-sm text-slate-900 dark:text-white">تبرع جديد مستلم</p>
                                <p class="text-xs text-slate-600 dark:text-slate-400 mt-1">شكراً لتبرعك بمبلغ 500 ج.م لحالة "عائلة أم محمد"</p>
                                <p class="text-xs text-slate-400 mt-2">منذ 5 دقائق</p>
                            </div>
                        </div>
                    </div>
                    <div class="p-4 bg-emerald-50 dark:bg-emerald-900/20 rounded-xl hover:bg-emerald-100 dark:hover:bg-emerald-900/30 transition-colors cursor-pointer">
                        <div class="flex items-start gap-3">
                            <span class="material-symbols-outlined text-emerald-600">check_circle</span>
                            <div class="flex-1">
                                <p class="font-bold text-sm text-slate-900 dark:text-white">حالة مكتملة</p>
                                <p class="text-xs text-slate-600 dark:text-slate-400 mt-1">تم إكمال حالة "عملية قلب للطفل يوسف" بنجاح</p>
                                <p class="text-xs text-slate-400 mt-2">منذ ساعة</p>
                            </div>
                        </div>
                    </div>
                    <div class="p-4 bg-amber-50 dark:bg-amber-900/20 rounded-xl hover:bg-amber-100 dark:hover:bg-amber-900/30 transition-colors cursor-pointer">
                        <div class="flex items-start gap-3">
                            <span class="material-symbols-outlined text-amber-600">update</span>
                            <div class="flex-1">
                                <p class="font-bold text-sm text-slate-900 dark:text-white">تحديث حالة</p>
                                <p class="text-xs text-slate-600 dark:text-slate-400 mt-1">تم تحديث حالة "عائلة أم محمد" - تقدم ملحوظ</p>
                                <p class="text-xs text-slate-400 mt-2">منذ 3 ساعات</p>
                            </div>
                        </div>
                    </div>
                    <div class="p-4 bg-purple-50 dark:bg-purple-900/20 rounded-xl hover:bg-purple-100 dark:hover:bg-purple-900/30 transition-colors cursor-pointer">
                        <div class="flex items-start gap-3">
                            <span class="material-symbols-outlined text-purple-600">celebration</span>
                            <div class="flex-1">
                                <p class="font-bold text-sm text-slate-900 dark:text-white">إنجاز جديد</p>
                                <p class="text-xs text-slate-600 dark:text-slate-400 mt-1">وصلت إلى مستوى "متبرع بلاتيني" - شكراً لعطائك!</p>
                                <p class="text-xs text-slate-400 mt-2">منذ يوم</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="p-4 border-t border-slate-200 dark:border-slate-800">
                <button class="w-full text-center text-sm font-bold text-primary hover:text-blue-700">
                    عرض جميع الإشعارات
                </button>
            </div>
        </div>
    </div>

    <!-- Case Details Popup -->
    <div id="caseDetailsPopup" class="hidden fixed inset-0 bg-black/50 z-50 flex items-center justify-center" onclick="closeCaseDetails(event)">
        <div class="bg-white dark:bg-slate-900 rounded-2xl shadow-2xl w-full max-w-lg mx-4" onclick="event.stopPropagation()">
            <div class="p-6 border-b border-slate-200 dark:border-slate-800 flex items-center justify-between">
                <h3 class="text-lg font-bold text-slate-900 dark:text-white">تفاصيل الحالة</h3>
                <button onclick="closeCaseDetails()" class="text-slate-400 hover:text-slate-600 dark:hover:text-slate-400">
                    <span class="material-symbols-outlined">close</span>
                </button>
            </div>
            <div class="p-6">
                <div class="mb-6">
                    <h4 id="caseTitle" class="text-xl font-bold text-slate-900 dark:text-white mb-3"></h4>
                    <div class="space-y-3">
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-slate-600 dark:text-slate-400">المبلغ المجموع</span>
                            <span id="caseCollected" class="text-lg font-bold text-emerald-600"></span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-slate-600 dark:text-slate-400">الهدف</span>
                            <span id="caseTarget" class="text-lg font-bold text-slate-900 dark:text-white"></span>
                        </div>
                        <div class="w-full bg-slate-100 dark:bg-slate-800 h-3 rounded-full overflow-hidden">
                            <div id="caseProgress" class="h-full bg-primary rounded-full transition-all duration-500"></div>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-slate-600 dark:text-slate-400">نسبة الإنجاز</span>
                            <span id="casePercentage" class="text-sm font-bold text-primary"></span>
                        </div>
                    </div>
                </div>
                <div class="bg-slate-50 dark:bg-slate-800 rounded-xl p-4 mb-6">
                    <h5 class="font-bold text-sm text-slate-900 dark:text-white mb-3">آخر التحديثات</h5>
                    <div class="space-y-2 text-sm text-slate-600 dark:text-slate-400">
                        <p>• تم استلام تبرع جديد بقيمة 500 ج.م</p>
                        <p>• جاري العمل على تنفيذ المشروع</p>
                        <p>• سيتم تحديث الحالة قريباً</p>
                    </div>
                </div>
                <div class="flex gap-3">
                    <button onclick="donateToCase()" class="flex-1 bg-primary text-white py-3 rounded-lg font-bold hover:bg-blue-600 transition-colors">
                        تبرع الآن
                    </button>
                    <button onclick="closeCaseDetails()" class="flex-1 bg-slate-100 dark:bg-slate-800 text-slate-700 dark:text-slate-300 py-3 rounded-lg font-medium hover:bg-slate-200 dark:hover:bg-slate-700 transition-colors">
                        إغلاق
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function toggleNotifications() {
            document.getElementById('notificationsPopup').classList.remove('hidden');
        }

        function closeNotifications(event) {
            if (event) event.stopPropagation();
            document.getElementById('notificationsPopup').classList.add('hidden');
        }

        // Search functionality
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('searchInput');
            if (searchInput) {
                searchInput.addEventListener('input', function(e) {
                    const searchTerm = e.target.value.toLowerCase();
                    const cases = document.querySelectorAll('.grid > div');
                    let visibleCount = 0;

                    cases.forEach(caseCard => {
                        const title = caseCard.querySelector('h4')?.textContent.toLowerCase() || '';
                        const description = caseCard.querySelector('p')?.textContent.toLowerCase() || '';

                        if (title.includes(searchTerm) || description.includes(searchTerm)) {
                            caseCard.style.display = '';
                            visibleCount++;
                        } else {
                            caseCard.style.display = 'none';
                        }
                    });

                    console.log(`تم العثور على ${visibleCount} حالة`);
                });
            }
        });

        // View case details
        function viewCaseDetails(title, collected, target, percentage) {
            document.getElementById('caseTitle').textContent = title;
            document.getElementById('caseCollected').textContent = collected.includes('جنيه') || collected.includes('شخص') ? collected : collected + ' ج.م';
            document.getElementById('caseTarget').textContent = target;
            const numericPercentage = Number.parseInt(percentage, 10);

            if (Number.isNaN(numericPercentage)) {
                document.getElementById('caseProgress').style.width = '100%';
                document.getElementById('casePercentage').textContent = percentage;
            } else {
                document.getElementById('caseProgress').style.width = numericPercentage + '%';
                document.getElementById('casePercentage').textContent = numericPercentage + '%';
            }

            document.getElementById('caseDetailsPopup').classList.remove('hidden');
        }

        function closeCaseDetails(event) {
            if (event) event.stopPropagation();
            document.getElementById('caseDetailsPopup').classList.add('hidden');
        }

        function donateToCase() {
            showToast('💙 جاري تحويلك لصفحة التبرع...', 'info');
            setTimeout(() => {
                window.location.href = '{{ route("donation") }}';
            }, 1500);
        }

        // Toast notification
        function showToast(message, type = 'info') {
            const toast = document.createElement('div');
            const colors = {
                success: 'bg-emerald-500',
                error: 'bg-red-500',
                info: 'bg-blue-500'
            };
            toast.className = `fixed top-20 right-4 ${colors[type]} text-white px-6 py-3 rounded-lg shadow-lg z-50`;
            toast.textContent = message;
            document.body.appendChild(toast);
            setTimeout(() => {
                toast.remove();
            }, 3000);
        }
    </script>
</body>

</html>
