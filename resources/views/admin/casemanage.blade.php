<!DOCTYPE html>
<html dir="rtl" lang="ar">

<head>
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>إدارة الحالات - بداية جديدة</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
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
            <div class="p-4 space-y-4">
                <div class="flex flex-col sm:flex-row gap-3 items-center justify-between flex-wrap">
                    <div class="flex gap-3">
                        <a href="{{ route('addcase') }}" class="px-5 py-2.5 bg-primary text-white rounded-xl font-medium hover:bg-blue-600 transition-colors shadow-sm flex items-center gap-2">
                            <span class="material-symbols-outlined">add_circle</span>
                            إضافة حالة جديدة
                        </a>
                        <button onclick="exportCases()" class="px-5 py-2.5 bg-emerald-600 text-white rounded-xl font-medium hover:bg-emerald-700 transition-colors shadow-sm flex items-center gap-2">
                            <span class="material-symbols-outlined">download</span>
                            تصدير Excel
                        </button>
                    </div>
                    <div class="flex gap-3">
                        <select id="statusFilter" onchange="filterTable()" class="bg-white dark:bg-slate-800 border border-slate-300 dark:border-slate-600 rounded-xl px-4 py-2.5 text-sm font-medium">
                            <option value="الكل">كل الحالات</option>
                            <option value="عاجلة">عاجلة</option>
                            <option value="نشطة">نشطة</option>
                            <option value="مكتملة">مكتملة</option>
                            <option value="معلقة">معلقة</option>
                        </select>
                    </div>
                </div>

                <div class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-100 dark:border-slate-800 shadow-sm overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full text-right" id="casesTable">
                            <thead class="bg-slate-50 dark:bg-slate-800/60 border-b border-slate-200 dark:border-slate-700">
                                <tr>
                                    <th class="px-4 py-3 text-xs font-bold text-slate-500 uppercase tracking-wider">الحالة</th>
                                    <th class="px-3 py-3 text-xs font-bold text-slate-500 uppercase tracking-wider">الفئة</th>
                                    <th class="px-3 py-3 text-xs font-bold text-slate-500 uppercase tracking-wider text-center">الحالة</th>
                                    <th class="px-3 py-3 text-xs font-bold text-slate-500 uppercase tracking-wider">التقدم</th>
                                    <th class="px-3 py-3 text-xs font-bold text-slate-500 uppercase tracking-wider">المبلغ</th>
                                    <th class="px-3 py-3 text-xs font-bold text-slate-500 uppercase tracking-wider text-center">إجراءات</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                                <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/40 transition-colors">
                                    <td class="px-4 py-3">
                                        <div class="flex items-center gap-2">
                                            <div class="size-8 rounded-full bg-slate-200 overflow-hidden flex-shrink-0">
                                                <img src="../assets/img/girl.jpg" class="w-full h-full object-cover">
                                            </div>
                                            <div class="min-w-0">
                                                <p class="font-bold text-sm text-slate-900 dark:text-white case-name truncate">عملية قلب عاجلة لـ أحمد</p>
                                                <p class="text-xs text-slate-500 case-id">#CASE-4782</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-3 py-3 text-sm font-medium">طبية</td>
                                    <td class="px-3 py-3 text-center">
                                        <span class="status-badge inline-flex px-2 py-1 text-xs font-medium rounded-full bg-red-100 dark:bg-red-900/40 text-red-700 dark:text-red-300">عاجلة</span>
                                    </td>
                                    <td class="px-3 py-3">
                                        <div class="w-20 bg-slate-100 dark:bg-slate-700 rounded-full h-2">
                                            <div class="bg-primary h-2 rounded-full" style="width: 42%"></div>
                                        </div>
                                        <p class="text-xs text-slate-500 mt-1">42%</p>
                                    </td>
                                    <td class="px-3 py-3 font-bold text-sm text-emerald-600">4,820</td>
                                    <td class="px-3 py-3 text-center">
                                        <div class="flex items-center justify-center gap-2">
                                            <button onclick="editCase('4782')" class="text-primary hover:text-blue-700"><span class="material-symbols-outlined text-lg">edit</span></button>
                                            <button onclick="deleteRow(this)" class="text-red-600 hover:text-red-700"><span class="material-symbols-outlined text-lg">delete</span></button>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/40 transition-colors">
                                    <td class="px-4 py-3">
                                        <div class="flex items-center gap-2">
                                            <div class="size-8 rounded-full bg-slate-200 overflow-hidden flex-shrink-0">
                                                <img src="../assets/img/girl.jpg" class="w-full h-full object-cover">
                                            </div>
                                            <div class="min-w-0">
                                                <p class="font-bold text-sm text-slate-900 dark:text-white case-name truncate">ترميم منزل للأسرة محمد</p>
                                                <p class="text-xs text-slate-500 case-id">#CASE-4789</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-3 py-3 text-sm font-medium">سكن</td>
                                    <td class="px-3 py-3 text-center">
                                        <span class="status-badge inline-flex px-2 py-1 text-xs font-medium rounded-full bg-emerald-100 dark:bg-emerald-900/40 text-emerald-700 dark:text-emerald-300">مكتملة</span>
                                    </td>
                                    <td class="px-3 py-3">
                                        <div class="w-20 bg-slate-100 dark:bg-slate-700 rounded-full h-2">
                                            <div class="bg-emerald-500 h-2 rounded-full" style="width: 100%"></div>
                                        </div>
                                        <p class="text-xs text-slate-500 mt-1">100%</p>
                                    </td>
                                    <td class="px-3 py-3 font-bold text-sm text-emerald-600">38,500</td>
                                    <td class="px-3 py-3 text-center">
                                        <div class="flex items-center justify-center gap-2">
                                            <button onclick="editCase('4789')" class="text-primary hover:text-blue-700"><span class="material-symbols-outlined text-lg">edit</span></button>
                                            <button onclick="deleteRow(this)" class="text-red-600 hover:text-red-700"><span class="material-symbols-outlined text-lg">delete</span></button>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/40 transition-colors">
                                    <td class="px-4 py-3">
                                        <div class="flex items-center gap-2">
                                            <div class="size-8 rounded-full bg-slate-200 overflow-hidden flex-shrink-0">
                                                <img src="../assets/img/girl.jpg" class="w-full h-full object-cover">
                                            </div>
                                            <div class="min-w-0">
                                                <p class="font-bold text-sm text-slate-900 dark:text-white case-name truncate">دعم تعليم أطفال - آل حسين</p>
                                                <p class="text-xs text-slate-500 case-id">#CASE-4791</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-3 py-3 text-sm font-medium">تعليم</td>
                                    <td class="px-3 py-3 text-center">
                                        <span class="status-badge inline-flex px-2 py-1 text-xs font-medium rounded-full bg-amber-100 dark:bg-amber-900/40 text-amber-700 dark:text-amber-300">نشطة</span>
                                    </td>
                                    <td class="px-3 py-3">
                                        <div class="w-20 bg-slate-100 dark:bg-slate-700 rounded-full h-2">
                                            <div class="bg-amber-500 h-2 rounded-full" style="width: 78%"></div>
                                        </div>
                                        <p class="text-xs text-slate-500 mt-1">78%</p>
                                    </td>
                                    <td class="px-3 py-3 font-bold text-sm text-emerald-600">7,800</td>
                                    <td class="px-3 py-3 text-center">
                                        <div class="flex items-center justify-center gap-2">
                                            <button onclick="editCase('4791')" class="text-primary hover:text-blue-700"><span class="material-symbols-outlined text-lg">edit</span></button>
                                            <button onclick="deleteRow(this)" class="text-red-600 hover:text-red-700"><span class="material-symbols-outlined text-lg">delete</span></button>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/40 transition-colors">
                                    <td class="px-4 py-3">
                                        <div class="flex items-center gap-2">
                                            <div class="size-8 rounded-full bg-slate-200 overflow-hidden flex-shrink-0">
                                                <img src="../assets/img/girl.jpg" class="w-full h-full object-cover">
                                            </div>
                                            <div class="min-w-0">
                                                <p class="font-bold text-sm text-slate-900 dark:text-white case-name truncate">توفير كرسي متحرك - آل الشافعي</p>
                                                <p class="text-xs text-slate-500 case-id">#CASE-4803</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-3 py-3 text-sm font-medium">طبي</td>
                                    <td class="px-3 py-3 text-center">
                                        <span class="status-badge inline-flex px-2 py-1 text-xs font-medium rounded-full bg-blue-100 dark:bg-blue-900/40 text-blue-700 dark:text-blue-300">معلقة</span>
                                    </td>
                                    <td class="px-3 py-3">
                                        <div class="w-20 bg-slate-100 dark:bg-slate-700 rounded-full h-2">
                                            <div class="bg-blue-500 h-2 rounded-full" style="width: 65%"></div>
                                        </div>
                                        <p class="text-xs text-slate-500 mt-1">65%</p>
                                    </td>
                                    <td class="px-3 py-3 font-bold text-sm text-emerald-600">19,500</td>
                                    <td class="px-3 py-3 text-center">
                                        <div class="flex items-center justify-center gap-2">
                                            <button onclick="editCase('4803')" class="text-primary hover:text-blue-700"><span class="material-symbols-outlined text-lg">edit</span></button>
                                            <button onclick="deleteRow(this)" class="text-red-600 hover:text-red-700"><span class="material-symbols-outlined text-lg">delete</span></button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="flex items-center justify-between flex-wrap gap-4 pt-6">
                    <div class="text-sm text-slate-500 dark:text-slate-400">
                        عرض ١–٤ من ٤ حالات
                    </div>
                    <div class="flex gap-2">
                        <button class="px-5 py-2 bg-slate-100 dark:bg-slate-800 rounded-xl text-sm font-medium disabled:opacity-50" disabled>السابق</button>
                        <button class="px-5 py-2 bg-primary text-white rounded-xl text-sm font-medium hover:bg-blue-600 transition-colors">التالي</button>
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
            if (confirm('هل أنت متأكد من تسجيل الخروج؟')) {
                window.location.href = '{{ route("login") }}';
            }
        }


        // Enhanced filter with multiple criteria
        function filterTable() {
            let input = document.getElementById("searchInput").value.toUpperCase();
            let status = document.getElementById("statusFilter").value;
            let table = document.getElementById("casesTable");
            let tr = table.getElementsByTagName("tr");
            let visibleCount = 0;

            for (let i = 1; i < tr.length; i++) {
                let name = tr[i].querySelector(".case-name")?.innerText.toUpperCase() || '';
                let id = tr[i].querySelector(".case-id")?.innerText.toUpperCase() || '';
                let badge = tr[i].querySelector(".status-badge")?.innerText || '';

                let matchesSearch = name.includes(input) || id.includes(input);
                let matchesStatus = (status === "الكل" || badge.includes(status));

                if (matchesSearch && matchesStatus) {
                    tr[i].style.display = "";
                    tr[i].style.animation = 'fadeIn 0.3s ease-in';
                    visibleCount++;
                } else {
                    tr[i].style.display = "none";
                }
            }

            // Update count display
            updateCaseCount(visibleCount, tr.length - 1);
        }

        // Update case count display
        function updateCaseCount(visible, total) {
            const countDisplay = document.querySelector('.text-sm.text-slate-500');
            if (countDisplay) {
                countDisplay.textContent = `عرض ${visible} من ${total} حالات`;
            }
        }

        // Enhanced delete with confirmation and animation
        function deleteRow(btn) {
            const row = btn.closest('tr');
            const caseName = row.querySelector('.case-name').textContent;
            const caseId = row.querySelector('.case-id').textContent;

            if (confirm(`⚠️ تأكيد الحذف\n\nهل تريد حذف الحالة:\n${caseName}\n${caseId}\n\nهذا الإجراء لا يمكن التراجع عنه!`)) {
                row.style.opacity = '0';
                row.style.transform = 'translateX(-50px)';
                row.style.transition = 'all 0.5s ease';

                setTimeout(() => {
                    row.remove();
                    alert('✅ تم حذف الحالة بنجاح');

                    // Update count
                    const table = document.getElementById("casesTable");
                    const remainingRows = table.getElementsByTagName("tr").length - 1;
                    updateCaseCount(remainingRows, remainingRows);
                }, 500);
            }
        }

        // Edit case with navigation
        function editCase(id) {
            if (confirm(`هل تريد تعديل الحالة ${id}؟`)) {
                window.location.href = '{{ route("addcase") }}?id=' + id + '&mode=edit';
            }
        }

        // Quick actions menu
        function showQuickActions(caseId) {
            const actions = [
                '1. عرض التفاصيل',
                '2. تعديل الحالة',
                '3. عرض التبرعات',
                '4. تغيير الحالة',
                '5. حذف الحالة'
            ];

            const choice = prompt(`إجراءات سريعة للحالة ${caseId}:\n\n${actions.join('\n')}\n\nاختر رقم الإجراء:`);

            switch (choice) {
                case '1':
                    alert('عرض تفاصيل الحالة...');
                    break;
                case '2':
                    editCase(caseId);
                    break;
                case '3':
                    alert('عرض التبرعات المرتبطة بالحالة...');
                    break;
                case '4':
                    changeStatus(caseId);
                    break;
                case '5':
                    const btn = document.querySelector(`button[onclick*="${caseId}"]`);
                    if (btn) deleteRow(btn);
                    break;
            }
        }

        // Change case status
        function changeStatus(caseId) {
            const newStatus = prompt('اختر الحالة الجديدة:\n\n1. عاجلة\n2. نشطة\n3. مكتملة\n4. معلقة\n\nأدخل الرقم:');

            const statuses = {
                '1': {
                    text: 'عاجلة',
                    class: 'bg-red-100 dark:bg-red-900/40 text-red-700 dark:text-red-300'
                },
                '2': {
                    text: 'نشطة',
                    class: 'bg-amber-100 dark:bg-amber-900/40 text-amber-700 dark:text-amber-300'
                },
                '3': {
                    text: 'مكتملة',
                    class: 'bg-emerald-100 dark:bg-emerald-900/40 text-emerald-700 dark:text-emerald-300'
                },
                '4': {
                    text: 'معلقة',
                    class: 'bg-blue-100 dark:bg-blue-900/40 text-blue-700 dark:text-blue-300'
                }
            };

            if (statuses[newStatus]) {
                alert(`تم تغيير حالة ${caseId} إلى: ${statuses[newStatus].text}`);
            }
        }

        // Bulk actions
        function selectAllCases() {
            const checkboxes = document.querySelectorAll('tbody input[type="checkbox"]');
            const selectAll = document.getElementById('selectAllCheckbox');

            checkboxes.forEach(cb => {
                cb.checked = selectAll.checked;
            });
        }

        function bulkDelete() {
            const selected = document.querySelectorAll('tbody input[type="checkbox"]:checked');
            if (selected.length === 0) {
                alert('⚠️ الرجاء اختيار حالة واحدة على الأقل');
                return;
            }

            if (confirm(`هل تريد حذف ${selected.length} حالة؟`)) {
                selected.forEach(cb => {
                    const row = cb.closest('tr');
                    row.remove();
                });
                alert(`✅ تم حذف ${selected.length} حالة بنجاح`);
            }
        }

        // Add CSS animation
        const style = document.createElement('style');
        style.textContent = `
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(-10px); }
        to { opacity: 1; transform: translateY(0); }
    }
`;
        document.head.appendChild(style);

        // Export cases to Excel
        function exportCases() {
            alert('جاري تصدير الحالات...');

            try {
                const table = document.getElementById('casesTable');
                const rows = Array.from(table.querySelectorAll('tbody tr')).filter(row => row.style.display !== 'none');

                // Prepare data with headers
                const data = [
                    ['الحالة', 'رقم الحالة', 'الفئة', 'الحالة', 'التقدم %', 'المبلغ المجموع']
                ];

                rows.forEach(row => {
                    const name = row.querySelector('.case-name')?.textContent.trim() || '';
                    const id = row.querySelector('.case-id')?.textContent.trim() || '';
                    const category = row.querySelector('td:nth-child(2)')?.textContent.trim() || '';
                    const status = row.querySelector('.status-badge')?.textContent.trim() || '';
                    const progress = row.querySelector('td:nth-child(4) p.text-xs')?.textContent.trim() || '';
                    const amount = row.querySelector('td:nth-child(5)')?.textContent.trim() || '';

                    data.push([name, id, category, status, progress, amount]);
                });

                // Create workbook
                const wb = XLSX.utils.book_new();
                const ws = XLSX.utils.aoa_to_sheet(data);

                // Set column widths
                ws['!cols'] = [{
                        wch: 35
                    }, // Name
                    {
                        wch: 15
                    }, // ID
                    {
                        wch: 12
                    }, // Category
                    {
                        wch: 12
                    }, // Status
                    {
                        wch: 10
                    }, // Progress
                    {
                        wch: 15
                    } // Amount
                ];

                XLSX.utils.book_append_sheet(wb, ws, 'الحالات');

                // Add summary
                const summaryData = [
                    ['إدارة الحالات - بداية جديدة'],
                    [''],
                    ['إجمالي الحالات', rows.length],
                    ['تاريخ التصدير', new Date().toLocaleDateString('ar-EG')],
                    ['الوقت', new Date().toLocaleTimeString('ar-EG')]
                ];

                const wsSummary = XLSX.utils.aoa_to_sheet(summaryData);
                XLSX.utils.book_append_sheet(wb, wsSummary, 'ملخص');

                XLSX.writeFile(wb, `الحالات-${new Date().getTime()}.xlsx`);
                alert('✅ تم تصدير الحالات بنجاح!');
            } catch (error) {
                console.error('Error exporting:', error);
                alert('❌ حدث خطأ أثناء التصدير');
            }
        }
    </script>
</body>

</html>
