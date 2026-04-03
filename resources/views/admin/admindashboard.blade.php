<!DOCTYPE html>
<html dir="rtl" lang="ar">

<head>
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>نظرة عامة - بداية جديدة</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;500;600;700;800;900&family=Public+Sans:wght@400;500;600;700&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&display=swap" rel="stylesheet" />
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
                        sans: ["Cairo", "system-ui", "sans-serif"],
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
            font-family: "Cairo", system-ui, sans-serif;
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

<body class="bg-background-light dark:bg-background-dark text-slate-900 dark:text-slate-100 font-display">
    <div class="flex min-h-screen">

        <x-admin-slider />
        <main class="flex-1 mr-72 transition-all duration-300">
            <x-admin-navbar />
            <div class="p-8 space-y-8">

                <!-- <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <div class="bg-white dark:bg-slate-900 p-6 rounded-2xl border border-slate-100 dark:border-slate-800 shadow-sm">
                        <p class="text-slate-400 text-xs font-bold uppercase mb-2">إجمالي المستخدمين</p>
                        <h4 class="text-3xl font-black text-slate-800 dark:text-white">1,250</h4>
                    </div>
                    <div class="bg-white dark:bg-slate-900 p-6 rounded-2xl border border-slate-100 dark:border-slate-800 shadow-sm">
                        <p class="text-slate-400 text-xs font-bold uppercase mb-2">الحالات النشطة</p>
                        <h4 class="text-3xl font-black text-primary">85</h4>
                    </div>
                    <div class="bg-white dark:bg-slate-900 p-6 rounded-2xl border border-slate-100 dark:border-slate-800 shadow-sm">
                        <p class="text-slate-400 text-xs font-bold uppercase mb-2">إجمالي التبرعات</p>
                        <h4 class="text-3xl font-black text-emerald-600">45,000 ج.م</h4>
                    </div>
                    <div class="bg-white dark:bg-slate-900 p-6 rounded-2xl border border-slate-100 dark:border-slate-800 shadow-sm">
                        <p class="text-slate-400 text-xs font-bold uppercase mb-2">مهام معلقة</p>
                        <h4 class="text-3xl font-black text-amber-600">12</h4>
                    </div>
                </div> -->

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <div class="bg-white dark:bg-slate-900 p-8 rounded-2xl border border-slate-100 dark:border-slate-800 shadow-sm">
                        <h3 class="font-bold text-lg text-slate-800 dark:text-white mb-6">احصائيات التبرعات الشهرية</h3>
                        <div style="position: relative; height: 300px; width: 100%;">
                            <canvas id="donationChart"></canvas>
                        </div>
                    </div>
                    <div class="bg-white dark:bg-slate-900 p-8 rounded-2xl border border-slate-100 dark:border-slate-800 shadow-sm">
                        <h3 class="font-bold text-lg text-slate-800 dark:text-white mb-6">توزيع الحالات</h3>
                        <div style="position: relative; height: 300px; width: 100%;">
                            <canvas id="caseChart"></canvas>
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
                <button onclick="closeNotifications()" class="text-slate-400 hover:text-slate-600">
                    <span class="material-symbols-outlined">close</span>
                </button>
            </div>
            <div class="p-4 max-h-96 overflow-y-auto">
                <div class="space-y-3">
                    <div class="p-4 bg-blue-50 dark:bg-blue-900/20 rounded-xl hover:bg-blue-100 dark:hover:bg-blue-900/30 transition-colors cursor-pointer">
                        <div class="flex items-start gap-3">
                            <span class="material-symbols-outlined text-blue-600">volunteer_activism</span>
                            <div class="flex-1">
                                <p class="font-bold text-sm text-slate-900 dark:text-white">تبرع جديد</p>
                                <p class="text-xs text-slate-600 dark:text-slate-400 mt-1">تم استلام تبرع بقيمة 500 ج.م من محمد علي</p>
                                <p class="text-xs text-slate-400 mt-2">منذ 5 دقائق</p>
                            </div>
                        </div>
                    </div>
                    <div class="p-4 bg-emerald-50 dark:bg-emerald-900/20 rounded-xl hover:bg-emerald-100 dark:hover:bg-emerald-900/30 transition-colors cursor-pointer">
                        <div class="flex items-start gap-3">
                            <span class="material-symbols-outlined text-emerald-600">check_circle</span>
                            <div class="flex-1">
                                <p class="font-bold text-sm text-slate-900 dark:text-white">حالة مكتملة</p>
                                <p class="text-xs text-slate-600 dark:text-slate-400 mt-1">تم إكمال حالة "عملية قلب للطفل يوسف"</p>
                                <p class="text-xs text-slate-400 mt-2">منذ ساعة</p>
                            </div>
                        </div>
                    </div>
                    <div class="p-4 bg-amber-50 dark:bg-amber-900/20 rounded-xl hover:bg-amber-100 dark:hover:bg-amber-900/30 transition-colors cursor-pointer">
                        <div class="flex items-start gap-3">
                            <span class="material-symbols-outlined text-amber-600">warning</span>
                            <div class="flex-1">
                                <p class="font-bold text-sm text-slate-900 dark:text-white">حالة عاجلة</p>
                                <p class="text-xs text-slate-600 dark:text-slate-400 mt-1">حالة جديدة تحتاج إلى اهتمام فوري</p>
                                <p class="text-xs text-slate-400 mt-2">منذ 3 ساعات</p>
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

    <!-- Settings Popup -->
    <div id="settingsPopup" class="hidden fixed inset-0 bg-black/50 z-50 flex items-start justify-center pt-20" onclick="closeSettings(event)">
        <div class="bg-white dark:bg-slate-900 rounded-2xl shadow-2xl w-full max-w-md mx-4" onclick="event.stopPropagation()">
            <div class="p-6 border-b border-slate-200 dark:border-slate-800 flex items-center justify-between">
                <h3 class="text-lg font-bold text-slate-900 dark:text-white">الإعدادات</h3>
                <button onclick="closeSettings()" class="text-slate-400 hover:text-slate-600">
                    <span class="material-symbols-outlined">close</span>
                </button>
            </div>
            <div class="p-4">
                <div class="space-y-4">
                    <div class="flex items-center justify-between p-4 bg-slate-50 dark:bg-slate-800 rounded-xl">
                        <div class="flex items-center gap-3">
                            <span class="material-symbols-outlined text-slate-600 dark:text-slate-400">person</span>
                            <div>
                                <p class="font-bold text-sm text-slate-900 dark:text-white">الملف الشخصي</p>
                                <p class="text-xs text-slate-500">تعديل معلوماتك الشخصية</p>
                            </div>
                        </div>
                        <span class="material-symbols-outlined text-slate-400">arrow_back_ios</span>
                    </div>
                    <div class="flex items-center justify-between p-4 bg-slate-50 dark:bg-slate-800 rounded-xl">
                        <div class="flex items-center gap-3">
                            <span class="material-symbols-outlined text-slate-600 dark:text-slate-400">dark_mode</span>
                            <div>
                                <p class="font-bold text-sm text-slate-900 dark:text-white">الوضع الداكن</p>
                                <p class="text-xs text-slate-500">تفعيل/إلغاء الوضع الداكن</p>
                            </div>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" class="sr-only peer" onchange="toggleDarkMode()">
                            <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:right-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary"></div>
                        </label>
                    </div>
                    <div class="flex items-center justify-between p-4 bg-slate-50 dark:bg-slate-800 rounded-xl">
                        <div class="flex items-center gap-3">
                            <span class="material-symbols-outlined text-slate-600 dark:text-slate-400">notifications</span>
                            <div>
                                <p class="font-bold text-sm text-slate-900 dark:text-white">الإشعارات</p>
                                <p class="text-xs text-slate-500">إدارة تفضيلات الإشعارات</p>
                            </div>
                        </div>
                        <span class="material-symbols-outlined text-slate-400">arrow_back_ios</span>
                    </div>
                    <div class="flex items-center justify-between p-4 bg-slate-50 dark:bg-slate-800 rounded-xl">
                        <div class="flex items-center gap-3">
                            <span class="material-symbols-outlined text-slate-600 dark:text-slate-400">lock</span>
                            <div>
                                <p class="font-bold text-sm text-slate-900 dark:text-white">الأمان</p>
                                <p class="text-xs text-slate-500">تغيير كلمة المرور</p>
                            </div>
                        </div>
                        <span class="material-symbols-outlined text-slate-400">arrow_back_ios</span>
                    </div>
                    <button onclick="logout()" class="w-full flex items-center justify-center gap-3 p-4 bg-red-50 dark:bg-red-900/20 text-red-600 rounded-xl hover:bg-red-100 dark:hover:bg-red-900/30 transition-colors">
                        <span class="material-symbols-outlined">logout</span>
                        <span class="font-bold text-sm">تسجيل الخروج</span>
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

        function toggleSettings() {
            document.getElementById('settingsPopup').classList.remove('hidden');
        }

        function closeSettings(event) {
            if (event) event.stopPropagation();
            document.getElementById('settingsPopup').classList.add('hidden');
        }

        function toggleDarkMode() {
            document.documentElement.classList.toggle('dark');
        }

        function logout() {
            if (confirm('يا مي محمد، هل تودين تسجيل الخروج؟')) {
                document.getElementById('logout-form').submit();
            }
        }


        // Global search functionality
        function performGlobalSearch() {
            const searchTerm = document.getElementById('globalSearch').value.toLowerCase();
            if (searchTerm.length > 0) {
                alert(`البحث عن: "${searchTerm}"\nهذه الميزة ستبحث في جميع البيانات`);
            }
        }

        // Refresh dashboard data
        function refreshDashboard() {
            alert('جاري تحديث البيانات...');
            setTimeout(() => {
                alert('تم تحديث البيانات بنجاح!');
                location.reload();
            }, 1000);
        }

        // Export dashboard report
        function exportDashboard() {
            alert('جاري تصدير تقرير لوحة التحكم...');
            setTimeout(() => {
                alert('تم تصدير التقرير بنجاح!');
            }, 1000);
        }

        // Quick actions
        function quickAddCase() {
            window.location.href = '{{ route("addcase") }}';
        }

        function quickViewReports() {
            window.location.href = '{{ route("reports") }}';
        }

        function quickManageDonors() {
            window.location.href = '{{ route("donors") }}';
        }

        window.onload = function() {
            Chart.defaults.font.family = 'Cairo';

            new Chart(document.getElementById('donationChart'), {
                type: 'line',
                data: {
                    labels: ['يناير', 'فبراير', 'مارس', 'أبريل', 'مايو', 'يونيو'],
                    datasets: [{
                        label: 'التبرعات',
                        data: [15000, 45000, 20000, 60000, 90000, 75000],
                        borderColor: '#007bff',
                        backgroundColor: 'rgba(0, 123, 255, 0.05)',
                        borderWidth: 3,
                        tension: 0.4,
                        fill: true
                    }]
                },
                options: {
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            grid: {
                                display: true,
                                color: 'rgba(0,0,0,0.05)'
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            }
                        }
                    },
                    onClick: (e, activeEls) => {
                        if (activeEls.length > 0) {
                            const index = activeEls[0].index;
                            const month = ['يناير', 'فبراير', 'مارس', 'أبريل', 'مايو', 'يونيو'][index];
                            alert(`عرض تفاصيل شهر ${month}`);
                        }
                    }
                }
            });

            new Chart(document.getElementById('caseChart'), {
                type: 'doughnut',
                data: {
                    labels: ['أيتام', 'مشردين', 'دعم طبي', 'تعليم'],
                    datasets: [{
                        data: [45, 25, 20, 10],
                        backgroundColor: ['#007bff', '#10b981', '#f59e0b', '#6366f1'],
                        borderWidth: 0
                    }]
                },
                options: {
                    maintainAspectRatio: false,
                    cutout: '70%',
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                padding: 15,
                                font: {
                                    size: 12
                                }
                            }
                        }
                    },
                    onClick: (e, activeEls) => {
                        if (activeEls.length > 0) {
                            const index = activeEls[0].index;
                            const category = ['أيتام', 'مشردين', 'دعم طبي', 'تعليم'][index];
                            alert(`عرض حالات فئة: ${category}`);
                        }
                    }
                }
            });

            // Add click handlers to stat cards
            document.querySelectorAll('.bg-white.p-6.rounded-2xl').forEach((card, index) => {
                card.style.cursor = 'pointer';
                card.addEventListener('click', function() {
                    const titles = ['المستخدمين', 'الحالات النشطة', 'التبرعات', 'المهام المعلقة'];
                    alert(`عرض تفاصيل: ${titles[index]}`);
                });
            });
        }
    </script>
    <form id="logout-form" method="POST" action="{{ route('logout') }}" class="hidden">
        @csrf
    </form>
</body>

</html>
