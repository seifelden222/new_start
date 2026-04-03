<!DOCTYPE html>
<html dir="rtl" lang="ar">

<head>
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>التقارير - بداية جديدة</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
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
            <div class="p-8 space-y-8">
                <div class="flex flex-col sm:flex-row gap-4 items-center justify-between flex-wrap">
                    <div class="flex gap-3">
                        <button onclick="exportPDF()" class="px-5 py-2.5 bg-primary text-white rounded-xl font-medium hover:bg-blue-600 transition-colors shadow-sm flex items-center gap-2">
                            <span class="material-symbols-outlined">picture_as_pdf</span>
                            تصدير PDF
                        </button>
                        <button onclick="exportExcel()" class="px-5 py-2.5 bg-emerald-600 text-white rounded-xl font-medium hover:bg-emerald-700 transition-colors shadow-sm flex items-center gap-2">
                            <span class="material-symbols-outlined">table_chart</span>
                            تصدير Excel
                        </button>
                    </div>
                    <div class="flex gap-3">
                        <select id="periodFilter" onchange="filterByPeriod()" class="bg-white dark:bg-slate-800 border border-slate-300 dark:border-slate-600 rounded-xl px-4 py-2.5 text-sm font-medium">
                            <option>الفترة: الشهر الحالي</option>
                            <option>آخر ٣٠ يوم</option>
                            <option>السنة الحالية</option>
                            <option>كل الوقت</option>
                            <option>فترة مخصصة</option>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <div class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-100 dark:border-slate-800 shadow-sm p-6">
                        <div class="flex justify-between items-center mb-6">
                            <h3 class="font-bold text-lg">التبرعات حسب الفئة</h3>
                            <select class="bg-slate-100 dark:bg-slate-800 border-none text-xs rounded-lg px-3 py-1 font-bold outline-none">
                                <option>الشهر الحالي</option>
                                <option>السنة الحالية</option>
                            </select>
                        </div>
                        <div class="h-64 flex items-center justify-center">
                            <div class="relative size-48 rounded-full border-[24px] border-slate-100 dark:border-slate-800 flex items-center justify-center">
                                <div class="absolute inset-0 rounded-full border-[24px] border-transparent" style="border-image: conic-gradient(#007bff 0% 35%, #10b981 35% 62%, #f59e0b 62% 78%, #8b5cf6 78% 100%) 1"></div>
                                <div class="text-center">
                                    <p class="text-3xl font-black">245,800 ج.م</p>
                                    <p class="text-xs text-slate-500 font-medium mt-1">إجمالي التبرعات</p>
                                </div>
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-4 mt-6 text-sm">
                            <div class="flex items-center gap-2">
                                <span class="size-3 rounded-full bg-primary"></span>
                                <div>
                                    <p class="font-medium">طبي</p>
                                    <p class="text-slate-500">35%</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="size-3 rounded-full bg-emerald-500"></span>
                                <div>
                                    <p class="font-medium">تعليم</p>
                                    <p class="text-slate-500">27%</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="size-3 rounded-full bg-amber-500"></span>
                                <div>
                                    <p class="font-medium">إيواء</p>
                                    <p class="text-slate-500">16%</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="size-3 rounded-full bg-purple-500"></span>
                                <div>
                                    <p class="font-medium">متنوعة</p>
                                    <p class="text-slate-500">22%</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-100 dark:border-slate-800 shadow-sm p-6">
                        <div class="flex justify-between items-center mb-6">
                            <h3 class="font-bold text-lg">عدد التبرعات الشهرية</h3>
                            <select class="bg-slate-100 dark:bg-slate-800 border-none text-xs rounded-lg px-3 py-1 font-bold outline-none">
                                <option>آخر ٦ شهور</option>
                                <option>آخر ١٢ شهر</option>
                            </select>
                        </div>
                        <div class="h-64 relative">
                            <div class="absolute inset-0 flex items-end justify-between px-4 opacity-10 pointer-events-none">
                                <div class="w-full border-b border-slate-400 h-[25%]"></div>
                                <div class="w-full border-b border-slate-400 h-[50%]"></div>
                                <div class="w-full border-b border-slate-400 h-[75%]"></div>
                            </div>
                            <div class="h-full flex items-end gap-3 px-2 pb-8">
                                <div class="flex-1 group relative">
                                    <div class="w-full bg-primary/30 rounded-t group-hover:bg-primary/50 transition-all" style="height: 35%"></div>
                                    <span class="absolute -bottom-6 left-1/2 -translate-x-1/2 text-[10px] text-slate-500">يناير</span>
                                </div>
                                <div class="flex-1 group relative">
                                    <div class="w-full bg-primary/30 rounded-t group-hover:bg-primary/50 transition-all" style="height: 48%"></div>
                                    <span class="absolute -bottom-6 left-1/2 -translate-x-1/2 text-[10px] text-slate-500">فبراير</span>
                                </div>
                                <div class="flex-1 group relative">
                                    <div class="w-full bg-primary rounded-t shadow-lg shadow-primary/30" style="height: 92%"></div>
                                    <span class="absolute -bottom-6 left-1/2 -translate-x-1/2 text-[10px] text-slate-500">مارس</span>
                                </div>
                                <div class="flex-1 group relative">
                                    <div class="w-full bg-primary/30 rounded-t group-hover:bg-primary/50 transition-all" style="height: 65%"></div>
                                    <span class="absolute -bottom-6 left-1/2 -translate-x-1/2 text-[10px] text-slate-500">أبريل</span>
                                </div>
                                <div class="flex-1 group relative">
                                    <div class="w-full bg-primary/30 rounded-t group-hover:bg-primary/50 transition-all" style="height: 78%"></div>
                                    <span class="absolute -bottom-6 left-1/2 -translate-x-1/2 text-[10px] text-slate-500">مايو</span>
                                </div>
                                <div class="flex-1 group relative">
                                    <div class="w-full bg-primary/30 rounded-t group-hover:bg-primary/50 transition-all" style="height: 55%"></div>
                                    <span class="absolute -bottom-6 left-1/2 -translate-x-1/2 text-[10px] text-slate-500">يونيو</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-100 dark:border-slate-800 shadow-sm p-6 lg:col-span-2">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="font-bold text-lg">أفضل ١٠ متبرعين</h3>
                        <button class="text-primary text-sm font-medium hover:underline">عرض الكل</button>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-right">
                            <thead class="bg-slate-50 dark:bg-slate-800/50 border-b border-slate-200 dark:border-slate-700">
                                <tr>
                                    <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">الترتيب</th>
                                    <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">المتبرع</th>
                                    <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">المستوى</th>
                                    <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">إجمالي التبرعات</th>
                                    <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">عدد التبرعات</th>
                                    <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">آخر تبرع</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                                <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/30 transition-colors">
                                    <td class="px-6 py-4 text-center font-bold text-slate-600 dark:text-slate-300">1</td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-3">
                                            <div class="size-8 rounded-full bg-slate-200 overflow-hidden">
                                                <img src="../assets/img/girl.jpg" class="w-full h-full object-cover">
                                            </div>
                                            <div>
                                                <p class="font-medium">فاطمة حسن</p>
                                                <p class="text-xs text-slate-500">fatima_h@gmail.com</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="inline-flex px-2.5 py-0.5 text-xs rounded-full bg-indigo-100 dark:bg-indigo-900/40 text-indigo-700 dark:text-indigo-300">ماسي</span>
                                    </td>
                                    <td class="px-6 py-4 font-bold text-emerald-600">87,900 ج.م</td>
                                    <td class="px-6 py-4 text-center">134</td>
                                    <td class="px-6 py-4 text-sm text-slate-500">منذ ٦ ساعات</td>
                                </tr>
                                <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/30 transition-colors">
                                    <td class="px-6 py-4 text-center font-bold text-slate-600 dark:text-slate-300">2</td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-3">
                                            <div class="size-8 rounded-full bg-slate-200 overflow-hidden">
                                                <img src="../assets/img/girl.jpg" class="w-full h-full object-cover">
                                            </div>
                                            <div>
                                                <p class="font-medium">سارة أحمد</p>
                                                <p class="text-xs text-slate-500">sarah.ahmed@gmail.com</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="inline-flex px-2.5 py-0.5 text-xs rounded-full bg-yellow-100 dark:bg-yellow-900/40 text-yellow-700 dark:text-yellow-300">ذهبي</span>
                                    </td>
                                    <td class="px-6 py-4 font-bold text-emerald-600">42,300 ج.م</td>
                                    <td class="px-6 py-4 text-center">89</td>
                                    <td class="px-6 py-4 text-sm text-slate-500">منذ يومين</td>
                                </tr>
                                <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/30 transition-colors">
                                    <td class="px-6 py-4 text-center font-bold text-slate-600 dark:text-slate-300">3</td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-3">
                                            <div class="size-8 rounded-full bg-slate-200 overflow-hidden">
                                                <img src="../assets/img/girl.jpg" class="w-full h-full object-cover">
                                            </div>
                                            <div>
                                                <p class="font-medium">محمد علي</p>
                                                <p class="text-xs text-slate-500">mohamed@example.com</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="inline-flex px-2.5 py-0.5 text-xs rounded-full bg-amber-100 dark:bg-amber-900/40 text-amber-700 dark:text-amber-300">فضي</span>
                                    </td>
                                    <td class="px-6 py-4 font-bold text-emerald-600">18,750 ج.م</td>
                                    <td class="px-6 py-4 text-center">47</td>
                                    <td class="px-6 py-4 text-sm text-slate-500">منذ ٤ أيام</td>
                                </tr>
                            </tbody>
                        </table>
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
            window.location.href = '{{route('login')}}';
        }
    }

    // Export to PDF with charts and images
    function exportPDF() {
        alert('جاري إنشاء ملف PDF...');

        const {
            jsPDF
        } = window.jspdf;
        const doc = new jsPDF('p', 'mm', 'a4');

        // Add Arabic font support
        doc.setLanguage("ar");

        // Capture the reports section
        const element = document.querySelector('main');

        html2canvas(element, {
            scale: 2,
            useCORS: true,
            allowTaint: true,
            backgroundColor: '#ffffff'
        }).then(canvas => {
            const imgData = canvas.toDataURL('image/png');
            const imgWidth = 190;
            const pageHeight = 277;
            const imgHeight = (canvas.height * imgWidth) / canvas.width;
            let heightLeft = imgHeight;
            let position = 10;

            // Add title
            doc.setFontSize(20);
            doc.text('تقرير بداية جديدة', 105, 15, {
                align: 'center'
            });
            doc.setFontSize(12);
            doc.text(`تاريخ التقرير: ${new Date().toLocaleDateString('ar-EG')}`, 105, 22, {
                align: 'center'
            });

            position = 30;

            // Add first page
            doc.addImage(imgData, 'PNG', 10, position, imgWidth, imgHeight);
            heightLeft -= pageHeight;

            // Add more pages if needed
            while (heightLeft >= 0) {
                position = heightLeft - imgHeight + 10;
                doc.addPage();
                doc.addImage(imgData, 'PNG', 10, position, imgWidth, imgHeight);
                heightLeft -= pageHeight;
            }

            // Save the PDF
            doc.save(`تقرير-بداية-جديدة-${new Date().getTime()}.pdf`);
            alert('✅ تم تصدير التقرير بصيغة PDF بنجاح!');
        }).catch(error => {
            console.error('Error generating PDF:', error);
            alert('❌ حدث خطأ أثناء إنشاء ملف PDF');
        });
    }

    // Export to Excel with actual data
    function exportExcel() {
        alert('جاري إنشاء ملف Excel...');

        try {
            // Get table data
            const table = document.querySelector('table');
            const rows = Array.from(table.querySelectorAll('tr'));

            // Prepare data
            const data = rows.map(row => {
                const cells = Array.from(row.querySelectorAll('th, td'));
                return cells.map(cell => cell.textContent.trim());
            });

            // Create workbook
            const wb = XLSX.utils.book_new();
            const ws = XLSX.utils.aoa_to_sheet(data);

            // Add worksheet to workbook
            XLSX.utils.book_append_sheet(wb, ws, 'أفضل المتبرعين');

            // Add summary sheet
            const summaryData = [
                ['تقرير بداية جديدة'],
                [''],
                ['إجمالي التبرعات', '245,800 ج.م'],
                ['عدد المتبرعين', '4'],
                ['التاريخ', new Date().toLocaleDateString('ar-EG')],
                [''],
                ['التوزيع حسب الفئة:'],
                ['طبي', '35%'],
                ['تعليم', '27%'],
                ['إيواء', '16%'],
                ['متنوعة', '22%']
            ];

            const wsSummary = XLSX.utils.aoa_to_sheet(summaryData);
            XLSX.utils.book_append_sheet(wb, wsSummary, 'ملخص');

            // Save file
            XLSX.writeFile(wb, `تقرير-بداية-جديدة-${new Date().getTime()}.xlsx`);
            alert('✅ تم تصدير التقرير بصيغة Excel بنجاح!');
        } catch (error) {
            console.error('Error generating Excel:', error);
            alert('❌ حدث خطأ أثناء إنشاء ملف Excel');
        }
    }

    // Filter by period
    function filterByPeriod() {
        const period = document.getElementById('periodFilter').value;
        alert(`تم تطبيق الفترة: ${period}`);
        // Here you would implement actual filtering logic
    }

    // Search functionality with live filtering
    document.querySelector('input[placeholder*="ابحث"]').addEventListener('input', function(e) {
        const searchTerm = e.target.value.toLowerCase();
        const table = document.querySelector('tbody');
        if (table) {
            const rows = table.getElementsByTagName('tr');
            let visibleCount = 0;

            for (let i = 0; i < rows.length; i++) {
                const name = rows[i].querySelector('td:nth-child(2) p')?.textContent.toLowerCase() || '';
                const email = rows[i].querySelector('td:nth-child(2) .text-xs')?.textContent.toLowerCase() || '';

                if (name.includes(searchTerm) || email.includes(searchTerm)) {
                    rows[i].style.display = '';
                    visibleCount++;
                } else {
                    rows[i].style.display = 'none';
                }
            }

            // Show message if no results
            if (visibleCount === 0 && searchTerm.length > 0) {
                console.log('لا توجد نتائج للبحث');
            }
        }
    });

    // Enhanced filter by period with date range
    function filterByPeriod() {
        const period = document.getElementById('periodFilter').value;

        if (period === 'فترة مخصصة') {
            const startDate = prompt('أدخل تاريخ البداية (YYYY-MM-DD):');
            const endDate = prompt('أدخل تاريخ النهاية (YYYY-MM-DD):');

            if (startDate && endDate) {
                alert(`تطبيق الفلتر من ${startDate} إلى ${endDate}`);
                // Here you would implement actual date filtering
            }
        } else {
            alert(`تم تطبيق الفترة: ${period}`);
        }

        // Simulate data refresh
        setTimeout(() => {
            console.log('تم تحديث البيانات حسب الفترة المحددة');
        }, 500);
    }

    // Click handlers for chart categories
    document.addEventListener('DOMContentLoaded', function() {
        // Add click handlers to category items
        const categoryItems = document.querySelectorAll('.grid.grid-cols-2.gap-4 > div');
        categoryItems.forEach((item, index) => {
            item.style.cursor = 'pointer';
            item.addEventListener('click', function() {
                const categories = ['طبي', 'تعليم', 'إيواء', 'متنوعة'];
                alert(`عرض تفاصيل فئة: ${categories[index]}`);
            });
        });

        // Add click handlers to top donors table rows
        const tableRows = document.querySelectorAll('tbody tr');
        tableRows.forEach(row => {
            row.style.cursor = 'pointer';
            row.addEventListener('click', function() {
                const name = this.querySelector('td:nth-child(2) p').textContent;
                const amount = this.querySelector('td:nth-child(4)').textContent;
                alert(`المتبرع: ${name}\nإجمالي التبرعات: ${amount}`);
            });
        });
    });
</script>
