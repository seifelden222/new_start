<!DOCTYPE html>
<html dir="rtl" lang="ar">

<head>
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>طلبات التبرع - بداية جديدة</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
    <link
        href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;500;600;700;800;900&family=Public+Sans:wght@400;500;600;700&display=swap"
        rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&display=swap"
        rel="stylesheet" />
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
                <div class="flex flex-col sm:flex-row gap-4 items-center justify-between flex-wrap">
                    <div class="flex gap-3">
                        <button onclick="approveSelected()"
                            class="px-5 py-2.5 bg-primary text-white rounded-xl font-medium hover:bg-blue-600 transition-colors shadow-sm flex items-center gap-2">
                            <span class="material-symbols-outlined">check_circle</span>
                            الموافقة على المحدد
                        </button>
                        <button onclick="rejectSelected()"
                            class="px-5 py-2.5 bg-red-600 text-white rounded-xl font-medium hover:bg-red-700 transition-colors shadow-sm flex items-center gap-2">
                            <span class="material-symbols-outlined">cancel</span>
                            رفض المحدد
                        </button>
                        <button onclick="exportOrders()"
                            class="px-5 py-2.5 bg-emerald-600 text-white rounded-xl font-medium hover:bg-emerald-700 transition-colors shadow-sm flex items-center gap-2">
                            <span class="material-symbols-outlined">download</span>
                            تصدير Excel
                        </button>
                    </div>
                    <div class="flex gap-3">
                        <select id="statusFilter" onchange="filterOrders()"
                            class="bg-white dark:bg-slate-800 border border-slate-300 dark:border-slate-600 rounded-xl px-4 py-2.5 text-sm font-medium">
                            <option>الكل</option>
                            <option>معلق</option>
                            <option>مقبول</option>
                            <option>مرفوض</option>
                            <option>مكتمل</option>
                        </select>
                        <select id="sortFilter" onchange="sortOrders()"
                            class="bg-white dark:bg-slate-800 border border-slate-300 dark:border-slate-600 rounded-xl px-4 py-2.5 text-sm font-medium">
                            <option>ترتيب حسب: الأحدث</option>
                            <option>الأقدم</option>
                            <option>المبلغ الأعلى</option>
                            <option>المبلغ الأقل</option>
                        </select>
                    </div>
                </div>

                <div
                    class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-100 dark:border-slate-800 shadow-sm overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full text-right min-w-[1000px]">
                            <thead
                                class="bg-slate-50 dark:bg-slate-800/60 border-b border-slate-200 dark:border-slate-700">
                                <tr>
                                    <th
                                        class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider text-center">
                                        <input type="checkbox" class="rounded border-slate-300">
                                    </th>
                                    <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">
                                        المتبرع</th>
                                    <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">
                                        المبلغ</th>
                                    <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">
                                        الحالة المطلوبة</th>
                                    <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">
                                        تاريخ الطلب</th>
                                    <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">
                                        الحالة</th>
                                    <th
                                        class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider text-center">
                                        إجراءات</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                                <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/40 transition-colors">
                                    <td class="px-6 py-5 text-center">
                                        <input type="checkbox" class="rounded border-slate-300">
                                    </td>
                                    <td class="px-6 py-5">
                                        <div class="flex items-center gap-3">
                                            <div class="size-10 rounded-full bg-slate-200 overflow-hidden">
                                                <img src="../assets/img/girl.jpg" class="w-full h-full object-cover">
                                            </div>
                                            <div>
                                                <p class="font-bold text-slate-900 dark:text-white">محمد علي</p>
                                                <p class="text-xs text-slate-500">mohamed@example.com</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-5 font-bold text-emerald-600">1,500 ج.م</td>
                                    <td class="px-6 py-5">
                                        <div class="max-w-xs">
                                            <p class="font-medium">ترميم منزل للأسرة محمد - CASE-4789</p>
                                            <p class="text-xs text-slate-500 truncate">دعم سكن لأسرة متعففة...</p>
                                        </div>
                                    </td>
                                    <td class="px-6 py-5 text-sm text-slate-500">منذ ٣ ساعات</td>
                                    <td class="px-6 py-5">
                                        <span
                                            class="inline-flex px-3 py-1 text-xs font-medium rounded-full bg-yellow-100 dark:bg-yellow-900/40 text-yellow-700 dark:text-yellow-300">معلق</span>
                                    </td>
                                    <td class="px-6 py-5 text-center">
                                        <div class="flex items-center justify-center gap-3">
                                            <button onclick="approveOrder(this)"
                                                class="text-emerald-600 hover:text-emerald-700"><span
                                                    class="material-symbols-outlined">check_circle</span></button>
                                            <button onclick="rejectOrder(this)"
                                                class="text-red-600 hover:text-red-700"><span
                                                    class="material-symbols-outlined">cancel</span></button>
                                            <button onclick="viewOrder(this)"
                                                class="text-primary hover:text-blue-700"><span
                                                    class="material-symbols-outlined">visibility</span></button>
                                        </div>
                                    </td>
                                </tr>

                                <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/40 transition-colors">
                                    <td class="px-6 py-5 text-center">
                                        <input type="checkbox" class="rounded border-slate-300">
                                    </td>
                                    <td class="px-6 py-5">
                                        <div class="flex items-center gap-3">
                                            <div class="size-10 rounded-full bg-slate-200 overflow-hidden">
                                                <img src="../assets/img/girl.jpg" class="w-full h-full object-cover">
                                            </div>
                                            <div>
                                                <p class="font-bold text-slate-900 dark:text-white">سارة أحمد</p>
                                                <p class="text-xs text-slate-500">sarah.ahmed@gmail.com</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-5 font-bold text-emerald-600">500 ج.م</td>
                                    <td class="px-6 py-5">
                                        <div class="max-w-xs">
                                            <p class="font-medium">عملية قلب عاجلة لـ أحمد - CASE-4782</p>
                                            <p class="text-xs text-slate-500 truncate">حالة طبية عاجلة...</p>
                                        </div>
                                    </td>
                                    <td class="px-6 py-5 text-sm text-slate-500">منذ يومين</td>
                                    <td class="px-6 py-5">
                                        <span
                                            class="inline-flex px-3 py-1 text-xs font-medium rounded-full bg-emerald-100 dark:bg-emerald-900/40 text-emerald-700 dark:text-emerald-300">مقبول</span>
                                    </td>
                                    <td class="px-6 py-5 text-center">
                                        <div class="flex items-center justify-center gap-3">
                                            <button
                                                class="text-emerald-600 hover:text-emerald-700 opacity-50 cursor-not-allowed"><span
                                                    class="material-symbols-outlined">check_circle</span></button>
                                            <button onclick="rejectOrder(this)"
                                                class="text-red-600 hover:text-red-700"><span
                                                    class="material-symbols-outlined">cancel</span></button>
                                            <button onclick="viewOrder(this)"
                                                class="text-primary hover:text-blue-700"><span
                                                    class="material-symbols-outlined">visibility</span></button>
                                        </div>
                                    </td>
                                </tr>

                                <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/40 transition-colors">
                                    <td class="px-6 py-5 text-center">
                                        <input type="checkbox" class="rounded border-slate-300">
                                    </td>
                                    <td class="px-6 py-5">
                                        <div class="flex items-center gap-3">
                                            <div class="size-10 rounded-full bg-slate-200 overflow-hidden">
                                                <img src="../assets/img/man5.jpg" class="w-full h-full object-cover">
                                            </div>
                                            <div>
                                                <p class="font-bold text-slate-900 dark:text-white">خالد محمود</p>
                                                <p class="text-xs text-slate-500">khaled55@hotmail.com</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-5 font-bold text-emerald-600">3,000 ج.م</td>
                                    <td class="px-6 py-5">
                                        <div class="max-w-xs">
                                            <p class="font-medium">توفير كرسي متحرك لأحمد - CASE-4803</p>
                                            <p class="text-xs text-slate-500 truncate">دعم طبي لذوي الاحتياجات...</p>
                                        </div>
                                    </td>
                                    <td class="px-6 py-5 text-sm text-slate-500">منذ ٥ أيام</td>
                                    <td class="px-6 py-5">
                                        <span
                                            class="inline-flex px-3 py-1 text-xs font-medium rounded-full bg-blue-100 dark:bg-blue-900/40 text-blue-700 dark:text-blue-300">مكتمل</span>
                                    </td>
                                    <td class="px-6 py-5 text-center">
                                        <div class="flex items-center justify-center gap-3">
                                            <button onclick="approveOrder(this)"
                                                class="text-emerald-600 hover:text-emerald-700"><span
                                                    class="material-symbols-outlined">check_circle</span></button>
                                            <button onclick="rejectOrder(this)"
                                                class="text-red-600 hover:text-red-700"><span
                                                    class="material-symbols-outlined">cancel</span></button>
                                            <button onclick="viewOrder(this)"
                                                class="text-primary hover:text-blue-700"><span
                                                    class="material-symbols-outlined">visibility</span></button>
                                        </div>
                                    </td>
                                </tr>

                                <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/40 transition-colors">
                                    <td class="px-6 py-5 text-center">
                                        <input type="checkbox" class="rounded border-slate-300">
                                    </td>
                                    <td class="px-6 py-5">
                                        <div class="flex items-center gap-3">
                                            <div class="size-10 rounded-full bg-slate-200 overflow-hidden">
                                                <img src="../assets/img/man6.jpg" class="w-full h-full object-cover">
                                            </div>
                                            <div>
                                                <p class="font-bold text-slate-900 dark:text-white">فاطمة حسن</p>
                                                <p class="text-xs text-slate-500">fatima_h@gmail.com</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-5 font-bold text-emerald-600">200 ج.م</td>
                                    <td class="px-6 py-5">
                                        <div class="max-w-xs">
                                            <p class="font-medium">دعم تعليم أطفال - CASE-4791</p>
                                            <p class="text-xs text-slate-500 truncate">دعم تعليم أطفال...</p>
                                        </div>
                                    </td>
                                    <td class="px-6 py-5 text-sm text-slate-500">منذ أسبوع</td>
                                    <td class="px-6 py-5">
                                        <span
                                            class="inline-flex px-3 py-1 text-xs font-medium rounded-full bg-red-100 dark:bg-red-900/40 text-red-700 dark:text-red-300">مرفوض</span>
                                    </td>
                                    <td class="px-6 py-5 text-center">
                                        <div class="flex items-center justify-center gap-3">
                                            <button
                                                class="text-emerald-600 hover:text-emerald-700 opacity-50 cursor-not-allowed"><span
                                                    class="material-symbols-outlined">check_circle</span></button>
                                            <button
                                                class="text-red-600 hover:text-red-700 opacity-50 cursor-not-allowed"><span
                                                    class="material-symbols-outlined">cancel</span></button>
                                            <button onclick="viewOrder(this)"
                                                class="text-primary hover:text-blue-700"><span
                                                    class="material-symbols-outlined">visibility</span></button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="flex items-center justify-between flex-wrap gap-4 pt-6">
                    <div class="text-sm text-slate-500 dark:text-slate-400">
                        عرض ١–٤ من ٤٠ طلب
                    </div>
                    <div class="flex gap-2">
                        <button
                            class="px-5 py-2 bg-slate-100 dark:bg-slate-800 rounded-xl text-sm font-medium disabled:opacity-50"
                            disabled>السابق</button>
                        <button
                            class="px-5 py-2 bg-primary text-white rounded-xl text-sm font-medium hover:bg-blue-600 transition-colors">التالي</button>
                    </div>
                </div>

            </div>
        </main>
    </div>

    <!-- Notifications Popup -->
    <div id="notificationsPopup" class="hidden fixed inset-0 bg-black/50 z-50 flex items-start justify-center pt-20"
        onclick="closeNotifications(event)">
        <div class="bg-white dark:bg-slate-900 rounded-2xl shadow-2xl w-full max-w-md mx-4"
            onclick="event.stopPropagation()">
            <div class="p-6 border-b border-slate-200 dark:border-slate-800 flex items-center justify-between">
                <h3 class="text-lg font-bold text-slate-900 dark:text-white">?????????</h3>
                <button onclick="closeNotifications()" class="text-slate-400 hover:text-slate-600">
                    <span class="material-symbols-outlined">close</span>
                </button>
            </div>
            <div class="p-4 max-h-96 overflow-y-auto">
                <div class="space-y-3">
                    <div
                        class="p-4 bg-blue-50 dark:bg-blue-900/20 rounded-xl hover:bg-blue-100 dark:hover:bg-blue-900/30 transition-colors cursor-pointer">
                        <div class="flex items-start gap-3">
                            <span class="material-symbols-outlined text-blue-600">volunteer_activism</span>
                            <div class="flex-1">
                                <p class="font-bold text-sm text-slate-900 dark:text-white">تبرع جديد</p>
                                <p class="text-xs text-slate-600 dark:text-slate-400 mt-1">تم استلام تبرع بقيمة 500 ج.م
                                    من محمد علي</p>
                                <p class="text-xs text-slate-400 mt-2">منذ 5 دقائق</p>
                            </div>
                        </div>
                    </div>
                    <div
                        class="p-4 bg-emerald-50 dark:bg-emerald-900/20 rounded-xl hover:bg-emerald-100 dark:hover:bg-emerald-900/30 transition-colors cursor-pointer">
                        <div class="flex items-start gap-3">
                            <span class="material-symbols-outlined text-emerald-600">check_circle</span>
                            <div class="flex-1">
                                <p class="font-bold text-sm text-slate-900 dark:text-white">حالة مكتملة</p>
                                <p class="text-xs text-slate-600 dark:text-slate-400 mt-1">تم إكمال حالة "عملية قلب
                                    للطفل يوسف"</p>
                                <p class="text-xs text-slate-400 mt-2">منذ ساعة</p>
                            </div>
                        </div>
                    </div>
                    <div
                        class="p-4 bg-amber-50 dark:bg-amber-900/20 rounded-xl hover:bg-amber-100 dark:hover:bg-amber-900/30 transition-colors cursor-pointer">
                        <div class="flex items-start gap-3">
                            <span class="material-symbols-outlined text-amber-600">warning</span>
                            <div class="flex-1">
                                <p class="font-bold text-sm text-slate-900 dark:text-white">حالة عاجلة</p>
                                <p class="text-xs text-slate-600 dark:text-slate-400 mt-1">حالة جديدة تحتاج إلى اهتمام
                                    فوري</p>
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
    <div id="settingsPopup" class="hidden fixed inset-0 bg-black/50 z-50 flex items-start justify-center pt-20"
        onclick="closeSettings(event)">
        <div class="bg-white dark:bg-slate-900 rounded-2xl shadow-2xl w-full max-w-md mx-4"
            onclick="event.stopPropagation()">
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
                            <div
                                class="w-11 h-6 bg-slate-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:right-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary">
                            </div>
                        </label>
                    </div>
                    <div class="flex items-center justify-between p-4 bg-slate-50 dark:bg-slate-800 rounded-xl">
                        <div class="flex items-center gap-3">
                            <span
                                class="material-symbols-outlined text-slate-600 dark:text-slate-400">notifications</span>
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
                    <button onclick="logout()"
                        class="w-full flex items-center justify-center gap-3 p-4 bg-red-50 dark:bg-red-900/20 text-red-600 rounded-xl hover:bg-red-100 dark:hover:bg-red-900/30 transition-colors">
                        <span class="material-symbols-outlined">logout</span>
                        <span class="font-bold text-sm">تسجيل الخروج</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

</body>

</html>

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
        if (confirm('هل أنت متأكد من تسجيل الخروج؟')) {
            window.location.href = '{{ route('login') }}';
        }
    }

    // Filter orders by status
    function filterOrders() {
        const statusFilter = document.getElementById('statusFilter').value;
        const table = document.querySelector('tbody');
        const rows = table.getElementsByTagName('tr');

        for (let i = 0; i < rows.length; i++) {
            const statusBadge = rows[i].querySelector('td:nth-child(6) span');
            if (statusBadge) {
                const status = statusBadge.textContent.trim();
                if (statusFilter === 'الكل' || status === statusFilter) {
                    rows[i].style.display = '';
                } else {
                    rows[i].style.display = 'none';
                }
            }
        }
    }

    // Sort orders
    function sortOrders() {
        const sortType = document.getElementById('sortFilter').value;
        const table = document.querySelector('tbody');
        const rows = Array.from(table.getElementsByTagName('tr'));

        rows.sort((a, b) => {
            if (sortType === 'amount_high') {
                const amountA = parseInt(a.querySelector('td:nth-child(3)').textContent.replace(/[^\d]/g, ''));
                const amountB = parseInt(b.querySelector('td:nth-child(3)').textContent.replace(/[^\d]/g, ''));
                return amountB - amountA;
            } else if (sortType === 'amount_low') {
                const amountA = parseInt(a.querySelector('td:nth-child(3)').textContent.replace(/[^\d]/g, ''));
                const amountB = parseInt(b.querySelector('td:nth-child(3)').textContent.replace(/[^\d]/g, ''));
                return amountA - amountB;
            }
            return 0;
        });

        rows.forEach(row => table.appendChild(row));
    }

    // Approve selected orders
    function approveSelected() {
        const checkboxes = document.querySelectorAll('tbody input[type="checkbox"]:checked');
        if (checkboxes.length === 0) {
            alert('الرجاء اختيار طلب واحد على الأقل');
            return;
        }
        if (confirm(`هل تريد الموافقة على ${checkboxes.length} طلب؟`)) {
            checkboxes.forEach(cb => {
                const row = cb.closest('tr');
                const statusBadge = row.querySelector('td:nth-child(6) span');
                statusBadge.className =
                    'inline-flex px-3 py-1 text-xs font-medium rounded-full bg-emerald-100 dark:bg-emerald-900/40 text-emerald-700 dark:text-emerald-300';
                statusBadge.textContent = 'مقبول';
                cb.checked = false;
            });
            alert('تمت الموافقة بنجاح!');
        }
    }

    // Reject selected orders
    function rejectSelected() {
        const checkboxes = document.querySelectorAll('tbody input[type="checkbox"]:checked');
        if (checkboxes.length === 0) {
            alert('الرجاء اختيار طلب واحد على الأقل');
            return;
        }
        if (confirm(`هل تريد رفض ${checkboxes.length} طلب؟`)) {
            checkboxes.forEach(cb => {
                const row = cb.closest('tr');
                const statusBadge = row.querySelector('td:nth-child(6) span');
                statusBadge.className =
                    'inline-flex px-3 py-1 text-xs font-medium rounded-full bg-red-100 dark:bg-red-900/40 text-red-700 dark:text-red-300';
                statusBadge.textContent = 'مرفوض';
                cb.checked = false;
            });
            alert('تم الرفض بنجاح!');
        }
    }

    // Enhanced search with real-time results
    document.querySelector('input[placeholder*="ابحث"]').addEventListener('input', function(e) {
        const searchTerm = e.target.value.toLowerCase();
        const table = document.querySelector('tbody');
        const rows = table.getElementsByTagName('tr');
        let visibleCount = 0;

        for (let i = 0; i < rows.length; i++) {
            const name = rows[i].querySelector('td:nth-child(2) p')?.textContent.toLowerCase() || '';
            const caseTitle = rows[i].querySelector('td:nth-child(4) p')?.textContent.toLowerCase() || '';
            const email = rows[i].querySelector('td:nth-child(2) .text-xs')?.textContent.toLowerCase() || '';

            if (name.includes(searchTerm) || caseTitle.includes(searchTerm) || email.includes(searchTerm)) {
                rows[i].style.display = '';
                rows[i].style.animation = 'fadeIn 0.3s ease-in';
                visibleCount++;
            } else {
                rows[i].style.display = 'none';
            }
        }

        updateOrderCount(visibleCount, rows.length);
    });

    // Update order count
    function updateOrderCount(visible, total) {
        const countDisplay = document.querySelector('.text-sm.text-slate-500');
        if (countDisplay) {
            countDisplay.textContent = `عرض ${visible} من ${total} طلب`;
        }
    }

    // Enhanced filter with status tracking
    function filterOrders() {
        const statusFilter = document.getElementById('statusFilter').value;
        const table = document.querySelector('tbody');
        const rows = table.getElementsByTagName('tr');
        let visibleCount = 0;

        for (let i = 0; i < rows.length; i++) {
            const statusBadge = rows[i].querySelector('td:nth-child(6) span');
            if (statusBadge) {
                const status = statusBadge.textContent.trim();
                if (statusFilter === 'الكل' || status === statusFilter) {
                    rows[i].style.display = '';
                    rows[i].style.animation = 'slideIn 0.3s ease-in';
                    visibleCount++;
                } else {
                    rows[i].style.display = 'none';
                }
            }
        }

        updateOrderCount(visibleCount, rows.length);
    }

    // Enhanced sort with multiple options
    function sortOrders() {
        const sortType = document.getElementById('sortFilter').value;
        const table = document.querySelector('tbody');
        const rows = Array.from(table.getElementsByTagName('tr'));

        rows.sort((a, b) => {
            if (sortType.includes('الأعلى')) {
                const amountA = parseInt(a.querySelector('td:nth-child(3)').textContent.replace(/[^\d]/g, ''));
                const amountB = parseInt(b.querySelector('td:nth-child(3)').textContent.replace(/[^\d]/g, ''));
                return amountB - amountA;
            } else if (sortType.includes('الأقل')) {
                const amountA = parseInt(a.querySelector('td:nth-child(3)').textContent.replace(/[^\d]/g, ''));
                const amountB = parseInt(b.querySelector('td:nth-child(3)').textContent.replace(/[^\d]/g, ''));
                return amountA - amountB;
            }
            return 0;
        });

        rows.forEach((row, index) => {
            row.style.animation = 'slideIn 0.3s ease-in';
            setTimeout(() => table.appendChild(row), index * 50);
        });
    }

    // Approve selected with bulk processing
    function approveSelected() {
        const checkboxes = document.querySelectorAll('tbody input[type="checkbox"]:checked');
        if (checkboxes.length === 0) {
            alert('⚠️ الرجاء اختيار طلب واحد على الأقل');
            return;
        }

        if (confirm(`✅ تأكيد الموافقة\n\nهل تريد الموافقة على ${checkboxes.length} طلب؟`)) {
            let totalAmount = 0;

            checkboxes.forEach(cb => {
                const row = cb.closest('tr');
                const statusBadge = row.querySelector('td:nth-child(6) span');
                const amount = parseInt(row.querySelector('td:nth-child(3)').textContent.replace(/[^\d]/g, ''));

                statusBadge.className =
                    'inline-flex px-3 py-1 text-xs font-medium rounded-full bg-emerald-100 dark:bg-emerald-900/40 text-emerald-700 dark:text-emerald-300';
                statusBadge.textContent = 'مقبول';
                cb.checked = false;

                totalAmount += amount;
            });

            alert(
                `✅ تمت الموافقة بنجاح!\n\nعدد الطلبات: ${checkboxes.length}\nإجمالي المبلغ: ${totalAmount.toLocaleString()} ج.م`);
        }
    }

    // Reject selected with reason
    function rejectSelected() {
        const checkboxes = document.querySelectorAll('tbody input[type="checkbox"]:checked');
        if (checkboxes.length === 0) {
            alert('⚠️ الرجاء اختيار طلب واحد على الأقل');
            return;
        }

        const reason = prompt(`❌ سبب الرفض\n\nأدخل سبب رفض ${checkboxes.length} طلب:`);

        if (reason && confirm(`هل تريد رفض ${checkboxes.length} طلب؟\n\nالسبب: ${reason}`)) {
            checkboxes.forEach(cb => {
                const row = cb.closest('tr');
                const statusBadge = row.querySelector('td:nth-child(6) span');
                statusBadge.className =
                    'inline-flex px-3 py-1 text-xs font-medium rounded-full bg-red-100 dark:bg-red-900/40 text-red-700 dark:text-red-300';
                statusBadge.textContent = 'مرفوض';
                cb.checked = false;
            });
            alert(`❌ تم رفض ${checkboxes.length} طلب\n\nالسبب: ${reason}`);
        }
    }

    // Approve single order with details
    function approveOrder(btn) {
        const row = btn.closest('tr');
        const name = row.querySelector('td:nth-child(2) p').textContent;
        const amount = row.querySelector('td:nth-child(3)').textContent;
        const caseTitle = row.querySelector('td:nth-child(4) p').textContent;

        if (confirm(
                `✅ تأكيد الموافقة\n\nالمتبرع: ${name}\nالمبلغ: ${amount}\nالحالة: ${caseTitle}\n\nهل تريد الموافقة؟`)) {
            const statusBadge = row.querySelector('td:nth-child(6) span');
            statusBadge.className =
                'inline-flex px-3 py-1 text-xs font-medium rounded-full bg-emerald-100 dark:bg-emerald-900/40 text-emerald-700 dark:text-emerald-300';
            statusBadge.textContent = 'مقبول';

            // Disable approve button
            btn.classList.add('opacity-50', 'cursor-not-allowed');
            btn.onclick = null;

            alert('✅ تمت الموافقة بنجاح!');
        }
    }

    // Reject single order with reason
    function rejectOrder(btn) {
        const row = btn.closest('tr');
        const name = row.querySelector('td:nth-child(2) p').textContent;
        const reason = prompt(`❌ سبب رفض طلب ${name}:`);

        if (reason && confirm(`هل تريد رفض طلب ${name}؟\n\nالسبب: ${reason}`)) {
            const statusBadge = row.querySelector('td:nth-child(6) span');
            statusBadge.className =
                'inline-flex px-3 py-1 text-xs font-medium rounded-full bg-red-100 dark:bg-red-900/40 text-red-700 dark:text-red-300';
            statusBadge.textContent = 'مرفوض';

            // Disable reject button
            btn.classList.add('opacity-50', 'cursor-not-allowed');
            btn.onclick = null;

            alert(`❌ تم رفض الطلب\n\nالسبب: ${reason}`);
        }
    }

    // View order with full details
    function viewOrder(btn) {
        const row = btn.closest('tr');
        const name = row.querySelector('td:nth-child(2) p').textContent;
        const email = row.querySelector('td:nth-child(2) .text-xs').textContent;
        const amount = row.querySelector('td:nth-child(3)').textContent;
        const caseTitle = row.querySelector('td:nth-child(4) p').textContent;
        const caseDesc = row.querySelector('td:nth-child(4) .text-xs').textContent;
        const date = row.querySelector('td:nth-child(5)').textContent;
        const status = row.querySelector('td:nth-child(6) span').textContent;

        alert(`📋 تفاصيل الطلب\n\n` +
            `👤 المتبرع: ${name}\n` +
            `📧 البريد: ${email}\n` +
            `💰 المبلغ: ${amount}\n` +
            `📁 الحالة: ${caseTitle}\n` +
            `📝 الوصف: ${caseDesc}\n` +
            `📅 التاريخ: ${date}\n` +
            `🏷️ الحالة: ${status}`);
    }

    // Add CSS animations
    const style = document.createElement('style');
    style.textContent = `
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(-10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    @keyframes slideIn {
        from { opacity: 0; transform: translateX(20px); }
        to { opacity: 1; transform: translateX(0); }
    }
`;
    document.head.appendChild(style);

    // Export orders to Excel
    function exportOrders() {
        alert('جاري تصدير طلبات التبرع...');

        try {
            const table = document.querySelector('table');
            const rows = Array.from(table.querySelectorAll('tbody tr')).filter(row => row.style.display !== 'none');

            // Prepare data with headers
            const data = [
                ['المتبرع', 'البريد الإلكتروني', 'المبلغ', 'الحالة المطلوبة', 'تاريخ الطلب', 'الحالة']
            ];

            rows.forEach(row => {
                const name = row.querySelector('td:nth-child(2) p.font-bold')?.textContent.trim() || '';
                const email = row.querySelector('td:nth-child(2) .text-xs')?.textContent.trim() || '';
                const amount = row.querySelector('td:nth-child(3)')?.textContent.trim() || '';
                const caseTitle = row.querySelector('td:nth-child(4) p.font-medium')?.textContent.trim() || '';
                const date = row.querySelector('td:nth-child(5)')?.textContent.trim() || '';
                const status = row.querySelector('td:nth-child(6) span')?.textContent.trim() || '';

                data.push([name, email, amount, caseTitle, date, status]);
            });

            // Create workbook
            const wb = XLSX.utils.book_new();
            const ws = XLSX.utils.aoa_to_sheet(data);

            // Set column widths
            ws['!cols'] = [{
                    wch: 20
                }, // Name
                {
                    wch: 30
                }, // Email
                {
                    wch: 15
                }, // Amount
                {
                    wch: 35
                }, // Case
                {
                    wch: 15
                }, // Date
                {
                    wch: 12
                } // Status
            ];

            XLSX.utils.book_append_sheet(wb, ws, 'طلبات التبرع');

            // Add summary
            const summaryData = [
                ['طلبات التبرع - بداية جديدة'],
                [''],
                ['إجمالي الطلبات', rows.length],
                ['تاريخ التصدير', new Date().toLocaleDateString('ar-EG')],
                ['الوقت', new Date().toLocaleTimeString('ar-EG')]
            ];

            const wsSummary = XLSX.utils.aoa_to_sheet(summaryData);
            XLSX.utils.book_append_sheet(wb, wsSummary, 'ملخص');

            XLSX.writeFile(wb, `طلبات-التبرع-${new Date().getTime()}.xlsx`);
            alert('✅ تم تصدير الطلبات بنجاح!');
        } catch (error) {
            console.error('Error exporting:', error);
            alert('❌ حدث خطأ أثناء التصدير');
        }
    }
</script>
