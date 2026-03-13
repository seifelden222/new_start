<!DOCTYPE html>
<html dir="rtl" lang="ar">

<head>
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>إضافة حالة جديدة - بداية جديدة</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&display=swap" rel="stylesheet" />

    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#007bff",
                        "navy-dark": "#020617",
                        "background-light": "#f5f7f8",
                    },
                    fontFamily: {
                        sans: ["Cairo", "system-ui", "sans-serif"]
                    },
                },
            },
        }
    </script>

    <style>
        body {
            font-family: "Cairo", sans-serif;
            transition: all 0.5s ease;
        }

        .sidebar-link {
            transition: all 0.3s ease;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in {
            animation: fadeIn 0.4s ease forwards;
        }


        .file-drop-area.active {
            border-color: #007bff;
            background-color: #f0f7ff;
        }
    </style>
</head>

<body class="bg-background-light text-slate-900 font-display">
    <div class="flex min-h-screen">

        <x-admin-slider />
        <main class="flex-1 mr-72 transition-all duration-300">
            <x-admin-navbar />

            <div class="p-10 animate-fade-in">
                <div class="max-w-4xl mx-auto bg-white rounded-[2.5rem] shadow-sm p-10">
                    <form id="addCaseForm" onsubmit="handleSubmit(event)" class="space-y-10">

                        <section>
                            <h3 class="text-lg font-black text-slate-800 mb-6 flex items-center gap-2 italic">
                                <span class="material-symbols-outlined text-primary">info</span>
                                معلومات الحالة الأساسية
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="space-y-2">
                                    <label class="text-sm font-bold text-slate-600 mr-2">عنوان الحالة *</label>
                                    <input required type="text" name="title" class="w-full px-6 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-primary/20 transition-all italic font-bold placeholder:text-slate-300" placeholder="مثال: ترميم منزل أسرة متعففة">
                                </div>
                                <div class="space-y-2">
                                    <label class="text-sm font-bold text-slate-600 mr-2">رقم الحالة</label>
                                    <input type="text" name="caseId" class="w-full px-6 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-primary/20 italic font-bold" value="#CASE-8842" readonly>
                                </div>
                                <div class="md:col-span-2 space-y-2">
                                    <label class="text-sm font-bold text-slate-600 mr-2">الوصف التفصيلي *</label>
                                    <textarea required rows="4" class="w-full px-6 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-primary/20 italic font-bold placeholder:text-slate-300" placeholder="اشرح تفاصيل الحالة واحتياجاتها..."></textarea>
                                </div>
                            </div>
                        </section>

                        <section class="grid grid-cols-1 md:grid-cols-2 gap-10">
                            <div>
                                <h3 class="text-lg font-black text-slate-800 mb-6 flex items-center gap-2 italic">
                                    <span class="material-symbols-outlined text-primary">category</span>
                                    التصنيف والأولوية
                                </h3>
                                <div class="space-y-4">
                                    <select required class="w-full px-6 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-primary/20 font-bold italic">
                                        <option value="">اختر الفئة</option>
                                        <option>طبي</option>
                                        <option>إيواء</option>
                                        <option>غذائي</option>
                                    </select>
                                    <select required class="w-full px-6 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-primary/20 font-bold italic text-rose-600">
                                        <option value="">مستوى الأولوية</option>
                                        <option>عاجلة جداً</option>
                                        <option>متوسطة</option>
                                        <option>عادية</option>
                                    </select>
                                </div>
                            </div>
                            <div>
                                <h3 class="text-lg font-black text-slate-800 mb-6 flex items-center gap-2 italic">
                                    <span class="material-symbols-outlined text-primary">payments</span>
                                    الهدف المالي
                                </h3>
                                <div class="space-y-4">
                                    <div class="relative">
                                        <input required type="number" class="w-full px-6 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-primary/20 font-bold italic" placeholder="المبلغ المطلوب">
                                        <span class="absolute left-6 top-1/2 -translate-y-1/2 text-xs font-black text-slate-400 italic font-bold">ج.م</span>
                                    </div>
                                    <input type="date" class="w-full px-6 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-primary/20 font-bold italic text-slate-400">
                                </div>
                            </div>
                        </section>

                        <section>
                            <h3 class="text-lg font-black text-slate-800 mb-6 flex items-center gap-2 italic">
                                <span class="material-symbols-outlined text-primary">upload_file</span>
                                الصور والمرفقات
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div onclick="document.getElementById('mainImage').click()" class="file-drop-area border-2 border-dashed border-slate-200 rounded-[2rem] p-8 text-center cursor-pointer hover:border-primary transition-all group">
                                    <input type="file" id="mainImage" class="hidden" accept="image/*" onchange="previewImage(this, 'preview1')">
                                    <div id="preview1" class="space-y-2">
                                        <span class="material-symbols-outlined text-4xl text-slate-300 group-hover:text-primary transition-colors">add_photo_alternate</span>
                                        <p class="text-sm font-bold text-slate-400 italic">ارفع الصورة الرئيسية للحالة</p>
                                    </div>
                                </div>
                                <div onclick="document.getElementById('docs').click()" class="file-drop-area border-2 border-dashed border-slate-200 rounded-[2rem] p-8 text-center cursor-pointer hover:border-primary transition-all group">
                                    <input type="file" id="docs" class="hidden" multiple>
                                    <div class="space-y-2">
                                        <span class="material-symbols-outlined text-4xl text-slate-300 group-hover:text-primary transition-colors">description</span>
                                        <p class="text-sm font-bold text-slate-400 italic">ارفق التقارير الطبية أو المستندات</p>
                                    </div>
                                </div>
                            </div>
                        </section>

                        <div class="flex items-center justify-end gap-4 pt-6">
                            <button type="button" onclick="history.back()" class="px-10 py-4 text-slate-400 font-black hover:text-slate-600 transition-all italic">إلغاء</button>
                            <button type="submit" class="px-12 py-4 bg-primary text-white rounded-2xl font-black shadow-lg shadow-primary/30 hover:scale-105 transition-all flex items-center gap-3 italic">
                                <span class="material-symbols-outlined">verified</span>
                                حفظ ونشر الحالة
                            </button>
                        </div>
                    </form>
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
        function previewImage(input, previewId) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById(previewId).innerHTML = `
                    <img src="${e.target.result}" class="h-20 w-auto mx-auto rounded-xl shadow-md mb-2">
                    <p class="text-xs text-emerald-500 font-black italic">تم اختيار الصورة بنجاح</p>
                `;
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        function handleSubmit(e) {
            e.preventDefault();

            Swal.fire({
                title: 'جاري الحفظ...',
                html: 'يتم الآن معالجة بيانات الحالة الجديدة',
                timer: 1500,
                timerProgressBar: true,
                didOpen: () => {
                    Swal.showLoading()
                }
            }).then(() => {
                Swal.fire({
                    icon: 'success',
                    title: 'تمت الإضافة بنجاح!',
                    text: 'تم نشر الحالة الجديدة في نظام بداية جديدة',
                    confirmButtonText: 'ممتاز',
                    confirmButtonColor: '#007bff',
                    customClass: {
                        popup: 'rounded-[2rem] italic font-bold'
                    }
                }).then(() => {
                    window.location.href = 'casemanage.html';
                });
            });
        }

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
                window.location.href = '../login.html';
            }
        }
    </script>
</body>

</html>