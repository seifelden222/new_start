<!DOCTYPE html>
<html dir="rtl" lang="ar">

<head>
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>قائمة المتبرعين - بداية جديدة</title>
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

                        <button onclick="exportList()" class="px-5 py-2.5 bg-white dark:bg-slate-800 border border-slate-300 dark:border-slate-600 rounded-xl font-medium hover:bg-slate-50 dark:hover:bg-slate-700 transition-colors flex items-center gap-2">
                            <span class="material-symbols-outlined">download</span>
                            تصدير القائمة
                        </button>
                    </div>
                    <div class="flex gap-3">
                        <select id="levelFilter" onchange="filterDonors()" class="bg-white dark:bg-slate-800 border border-slate-300 dark:border-slate-600 rounded-xl px-4 py-2.5 text-sm font-medium">
                            <option>الكل</option>
                            <option>فضي</option>
                            <option>ذهبي</option>
                            <option>ماسي</option>
                            <option>غير مصنف</option>
                        </select>
                        <select id="sortFilter" onchange="sortDonors()" class="bg-white dark:bg-slate-800 border border-slate-300 dark:border-slate-600 rounded-xl px-4 py-2.5 text-sm font-medium">
                            <option>ترتيب حسب: إجمالي التبرعات</option>
                            <option>الأحدث</option>
                            <option>عدد التبرعات</option>
                            <option>الأكثر نشاطاً</option>
                        </select>
                    </div>
                </div>

                <div class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-100 dark:border-slate-800 shadow-sm overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full text-right">
                            <thead class="bg-slate-50 dark:bg-slate-800/60 border-b border-slate-200 dark:border-slate-700">
                                <tr>
                                    <th class="px-3 py-3 text-xs font-bold text-slate-500 uppercase tracking-wider text-center">
                                        <input type="checkbox" class="rounded border-slate-300">
                                    </th>
                                    <th class="px-4 py-3 text-xs font-bold text-slate-500 uppercase tracking-wider">المتبرع</th>
                                    <th class="px-3 py-3 text-xs font-bold text-slate-500 uppercase tracking-wider">المستوى</th>
                                    <th class="px-3 py-3 text-xs font-bold text-slate-500 uppercase tracking-wider">إجمالي</th>
                                    <th class="px-3 py-3 text-xs font-bold text-slate-500 uppercase tracking-wider text-center">العدد</th>
                                    <th class="px-3 py-3 text-xs font-bold text-slate-500 uppercase tracking-wider">آخر تبرع</th>
                                    <th class="px-3 py-3 text-xs font-bold text-slate-500 uppercase tracking-wider text-center">إجراءات</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                                @forelse($donors as $donor)
                                @php
                                    $total = $donor->total_donated ?? 0;
                                    if ($total >= 50000) { $level = 'ماسي'; $levelClass = 'bg-indigo-100 text-indigo-700'; }
                                    elseif ($total >= 20000) { $level = 'ذهبي'; $levelClass = 'bg-yellow-100 text-yellow-700'; }
                                    elseif ($total >= 5000) { $level = 'فضي'; $levelClass = 'bg-amber-100 text-amber-700'; }
                                    else { $level = 'عادي'; $levelClass = 'bg-slate-100 text-slate-600'; }
                                @endphp
                                <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/40 transition-colors">
                                    <td class="px-3 py-3 text-center">
                                        <input type="checkbox" class="rounded border-slate-300">
                                    </td>
                                    <td class="px-4 py-3">
                                        <div class="flex items-center gap-2">
                                            <div class="size-8 rounded-full bg-primary/20 flex items-center justify-center flex-shrink-0">
                                                <span class="material-symbols-outlined text-primary text-sm">person</span>
                                            </div>
                                            <div class="min-w-0">
                                                <p class="font-bold text-sm text-slate-900 dark:text-white truncate">{{ $donor->name }}</p>
                                                <p class="text-xs text-slate-500 truncate">{{ $donor->email }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-3 py-3">
                                        <span class="inline-flex px-2 py-1 text-xs font-medium rounded-full {{ $levelClass }}">{{ $level }}</span>
                                    </td>
                                    <td class="px-3 py-3 font-bold text-sm text-emerald-600">{{ number_format($total) }}</td>
                                    <td class="px-3 py-3 text-center font-medium text-sm">{{ $donor->donations_count ?? 0 }}</td>
                                    <td class="px-3 py-3 text-xs text-slate-500">{{ $donor->updated_at->diffForHumans() }}</td>
                                    <td class="px-3 py-3 text-center">
                                        <div class="flex items-center justify-center gap-2">
                                            <span class="text-xs text-slate-400">#{{ $donor->id }}</span>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="px-6 py-10 text-center text-slate-400 font-bold">لا يوجد متبرعون بعد</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="flex items-center justify-between flex-wrap gap-4 pt-6">
                    <div class="text-sm text-slate-500 dark:text-slate-400">
                        عرض ١–٤ من ٤ متبرعين
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

</body>

</html>

<script>
    // ==================== Popup Functions ====================
    function toggleNotifications() {
        console.log('فتح الإشعارات');
        document.getElementById('notificationsPopup').classList.remove('hidden');
    }

    function closeNotifications(event) {
        if (event) event.stopPropagation();
        document.getElementById('notificationsPopup').classList.add('hidden');
    }

    function toggleSettings() {
        console.log('فتح الإعدادات');
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
            document.getElementById('logout-form').submit();
        }
    }

    // ==================== Helper Functions ====================
    function updateResultsCount(visible, total) {
        const countDisplay = document.querySelector('.text-sm.text-slate-500');
        if (countDisplay) {
            countDisplay.textContent = `عرض ${visible} من ${total} متبرعين`;
        }
    }

    // ==================== Search Function ====================
    function initSearch() {
        const searchInput = document.getElementById('searchInput');
        if (searchInput) {
            console.log('✅ تم تفعيل البحث');
            searchInput.addEventListener('input', function(e) {
                console.log('البحث عن:', e.target.value);
                const searchTerm = e.target.value.toLowerCase();
                const table = document.querySelector('tbody');
                const rows = table.getElementsByTagName('tr');
                let visibleCount = 0;

                for (let i = 0; i < rows.length; i++) {
                    const name = rows[i].querySelector('td:nth-child(2) p.font-bold')?.textContent.toLowerCase() || '';
                    const email = rows[i].querySelector('td:nth-child(2) .text-xs')?.textContent.toLowerCase() || '';
                    const level = rows[i].querySelector('td:nth-child(3) span')?.textContent.toLowerCase() || '';

                    if (name.includes(searchTerm) || email.includes(searchTerm) || level.includes(searchTerm)) {
                        rows[i].style.display = '';
                        rows[i].style.animation = 'fadeIn 0.3s ease-in';
                        visibleCount++;
                    } else {
                        rows[i].style.display = 'none';
                    }
                }

                updateResultsCount(visibleCount, rows.length);
            });
        } else {
            console.error('❌ لم يتم العثور على حقل البحث');
        }
    }

    // ==================== Filter Function ====================
    function filterDonors() {
        console.log('تفعيل الفلتر');
        const levelFilter = document.getElementById('levelFilter').value;
        const table = document.querySelector('tbody');
        const rows = table.getElementsByTagName('tr');
        let visibleCount = 0;

        for (let i = 0; i < rows.length; i++) {
            const levelBadge = rows[i].querySelector('td:nth-child(3) span');
            if (levelBadge) {
                const level = levelBadge.textContent.trim();
                if (levelFilter === 'الكل' || level === levelFilter) {
                    rows[i].style.display = '';
                    rows[i].style.animation = 'fadeIn 0.3s ease-in';
                    visibleCount++;
                } else {
                    rows[i].style.display = 'none';
                }
            }
        }

        updateResultsCount(visibleCount, rows.length);
    }

    // ==================== Sort Function ====================
    function sortDonors() {
        console.log('تفعيل الترتيب');
        const sortType = document.getElementById('sortFilter').value;
        const table = document.querySelector('tbody');
        const rows = Array.from(table.getElementsByTagName('tr'));

        rows.sort((a, b) => {
            if (sortType.includes('إجمالي')) {
                const amountA = parseInt(a.querySelector('td:nth-child(4)').textContent.replace(/[^\d]/g, ''));
                const amountB = parseInt(b.querySelector('td:nth-child(4)').textContent.replace(/[^\d]/g, ''));
                return amountB - amountA;
            } else if (sortType.includes('عدد')) {
                const countA = parseInt(a.querySelector('td:nth-child(5)').textContent);
                const countB = parseInt(b.querySelector('td:nth-child(5)').textContent);
                return countB - countA;
            } else if (sortType === 'الأحدث') {
                return 0;
            } else if (sortType === 'الأكثر نشاطاً') {
                const countA = parseInt(a.querySelector('td:nth-child(5)').textContent);
                const countB = parseInt(b.querySelector('td:nth-child(5)').textContent);
                return countB - countA;
            }
            return 0;
        });

        rows.forEach((row, index) => {
            row.style.animation = 'slideIn 0.3s ease-in';
            setTimeout(() => {
                table.appendChild(row);
            }, index * 50);
        });
    }

    // ==================== Export Function ====================
    function exportList() {
        console.log('تفعيل التصدير');
        const format = confirm('اختر نعم لـ Excel أو إلغاء لـ CSV');

        try {
            const table = document.querySelector('table');
            const rows = Array.from(table.querySelectorAll('tbody tr')).filter(row => row.style.display !== 'none');

            const data = [
                ['المتبرع', 'البريد الإلكتروني', 'المستوى', 'إجمالي التبرعات', 'عدد التبرعات', 'آخر تبرع']
            ];

            rows.forEach(row => {
                const name = row.querySelector('td:nth-child(2) p.font-bold')?.textContent.trim() || '';
                const email = row.querySelector('td:nth-child(2) .text-xs')?.textContent.trim() || '';
                const level = row.querySelector('td:nth-child(3) span')?.textContent.trim() || '';
                const amount = row.querySelector('td:nth-child(4)')?.textContent.trim() || '';
                const count = row.querySelector('td:nth-child(5)')?.textContent.trim() || '';
                const lastDonation = row.querySelector('td:nth-child(6)')?.textContent.trim() || '';

                data.push([name, email, level, amount, count, lastDonation]);
            });

            if (format) {
                const wb = XLSX.utils.book_new();
                const ws = XLSX.utils.aoa_to_sheet(data);

                ws['!cols'] = [{
                        wch: 20
                    },
                    {
                        wch: 30
                    },
                    {
                        wch: 10
                    },
                    {
                        wch: 15
                    },
                    {
                        wch: 12
                    },
                    {
                        wch: 15
                    }
                ];

                XLSX.utils.book_append_sheet(wb, ws, 'المتبرعين');

                const summaryData = [
                    ['قائمة المتبرعين - بداية جديدة'],
                    [''],
                    ['إجمالي المتبرعين', rows.length],
                    ['تاريخ التصدير', new Date().toLocaleDateString('ar-EG')],
                    ['الوقت', new Date().toLocaleTimeString('ar-EG')]
                ];

                const wsSummary = XLSX.utils.aoa_to_sheet(summaryData);
                XLSX.utils.book_append_sheet(wb, wsSummary, 'ملخص');

                XLSX.writeFile(wb, `قائمة-المتبرعين-${new Date().getTime()}.xlsx`);
                alert('✅ تم تصدير القائمة بصيغة Excel بنجاح!');
            } else {
                const csv = data.map(row => row.join(',')).join('\n');
                const blob = new Blob(['\ufeff' + csv], {
                    type: 'text/csv;charset=utf-8;'
                });
                const link = document.createElement('a');
                link.href = URL.createObjectURL(blob);
                link.download = `قائمة-المتبرعين-${new Date().getTime()}.csv`;
                link.click();
                alert('✅ تم تصدير القائمة بصيغة CSV بنجاح!');
            }
        } catch (error) {
            console.error('Error exporting:', error);
            alert('❌ حدث خطأ أثناء التصدير');
        }
    }

    // ==================== View Functions ====================
    function viewDonor(btn) {
        console.log('عرض تفاصيل المتبرع');
        const row = btn.closest('tr');
        const name = row.querySelector('p.font-bold').textContent;
        const email = row.querySelector('.text-xs').textContent;
        const level = row.querySelector('td:nth-child(3) span').textContent;
        const amount = row.querySelector('td:nth-child(4)').textContent;
        const count = row.querySelector('td:nth-child(5)').textContent;
        const lastDonation = row.querySelector('td:nth-child(6)').textContent;

        alert(`📊 تفاصيل المتبرع\n\n` +
            `الاسم: ${name}\n` +
            `البريد: ${email}\n` +
            `المستوى: ${level}\n` +
            `إجمالي التبرعات: ${amount}\n` +
            `عدد التبرعات: ${count}\n` +
            `آخر تبرع: ${lastDonation}`);
    }

    function viewHistory(btn) {
        console.log('عرض سجل التبرعات');
        const row = btn.closest('tr');
        const name = row.querySelector('p.font-bold').textContent;
        alert(`📜 سجل تبرعات: ${name}\n\n` +
            `• 15/03/2026 - 1,500 ج.م - حالة طبية\n` +
            `• 10/03/2026 - 2,000 ج.م - تعليم\n` +
            `• 05/03/2026 - 500 ج.م - إيواء\n` +
            `• 01/03/2026 - 1,000 ج.م - متنوعة\n\n` +
            `المجموع: 5,000 ج.م`);
    }

    // ==================== CSS Animations ====================
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

    // ==================== Initialize on Page Load ====================
    document.addEventListener('DOMContentLoaded', function() {
        console.log('🚀 تحميل صفحة المتبرعين...');
        initSearch();
        console.log('✅ جميع دوال المتبرعين تم تحميلها بنجاح');
    });
</script>
<form id="logout-form" method="POST" action="{{ route('logout') }}" class="hidden">
    @csrf
</form>
