<!DOCTYPE html>
<html dir="rtl" lang="ar">

<head>
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>إعدادات الملف الشخصي - بداية جديدة</title>
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

@php
    $user = auth()->user();
    $userName = old('name', $user?->name ?? '');
    $userEmail = old('email', $user?->email ?? '');
    $userAddress = old('address', $user?->address ?? '');
    $userLevel = $user?->isAdmin() ? 'مدير النظام' : 'مستخدم مسجل';
    $avatarUrl = $user?->avatarUrl() ?? 'https://ui-avatars.com/api/?name=' . urlencode($userName ?: 'User') . '&background=007bff&color=fff';
@endphp

<body class="bg-background-light dark:bg-background-dark text-slate-900 dark:text-slate-100">
    <div class="flex min-h-screen">


        <x-user-slider />


        <main class="flex-1 mr-64">

            <x-user-navbar />

            <div class="p-8 max-w-7xl mx-auto space-y-10">

                <div class="bg-white dark:bg-slate-900 rounded-xl border border-slate-200 dark:border-slate-800 shadow-sm p-8">
                    <h2 class="text-3xl font-black mb-2 text-primary">إعدادات الملف الشخصي</h2>
                    <p class="text-slate-500 dark:text-slate-400 mb-10">إدارة معلومات حسابك الشخصية، تفضيلات الإشعارات وإعدادات الخصوصية</p>

                    @if (session('status') === 'profile-updated')
                        <div class="mb-8 rounded-2xl border border-emerald-200 bg-emerald-50 px-5 py-4 text-sm font-bold text-emerald-700">
                            تم حفظ التغييرات بنجاح.
                        </div>
                    @endif

                    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="grid grid-cols-1 lg:grid-cols-3 gap-10">
                        @csrf
                        @method('PATCH')

                        <div class="lg:col-span-2 space-y-10">

                            <div class="space-y-6">
                                <h3 class="text-xl font-bold border-b border-slate-200 dark:border-slate-700 pb-3">المعلومات الشخصية</h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">الاسم الكامل</label>
                                        <input type="text" name="name" value="{{ $userName }}" class="w-full px-4 py-3 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-lg focus:ring-2 focus:ring-primary/50 focus:border-primary outline-none">
                                        @error('name')
                                            <p class="mt-2 text-sm font-bold text-red-500">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">البريد الإلكتروني</label>
                                        <input type="email" name="email" value="{{ $userEmail }}" class="w-full px-4 py-3 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-lg focus:ring-2 focus:ring-primary/50 focus:border-primary outline-none">
                                        @error('email')
                                            <p class="mt-2 text-sm font-bold text-red-500">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">العنوان</label>
                                        <input type="text" name="address" value="{{ $userAddress }}" class="w-full px-4 py-3 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-lg focus:ring-2 focus:ring-primary/50 focus:border-primary outline-none">
                                        @error('address')
                                            <p class="mt-2 text-sm font-bold text-red-500">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">مستوى المتبرع</label>
                                        <div class="px-4 py-3 bg-blue-50 dark:bg-blue-950/30 border border-blue-200 dark:border-blue-800 rounded-lg text-blue-700 dark:text-blue-300 font-medium">
                                            {{ $userLevel }}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="space-y-6">
                                <h3 class="text-xl font-bold border-b border-slate-200 dark:border-slate-700 pb-3">صورة الملف الشخصي</h3>
                                <div class="flex items-center gap-6">
                                    <div class="relative h-28 w-28 rounded-full overflow-hidden border-4 border-primary/30">
                                        <img id="profileAvatarPreview" src="{{ $avatarUrl }}" alt="{{ $userName }}" class="w-full h-full object-cover">
                                    </div>
                                    <div>
                                        <button type="button" onclick="changeProfilePicture()" class="px-6 py-2.5 bg-primary text-white rounded-lg font-medium hover:bg-blue-600 transition-colors mb-3 block">
                                            تغيير الصورة
                                        </button>
                                        <input type="file" id="profileImageInput" name="profile_photo" accept="image/png,image/jpeg,image/jpg" class="hidden" onchange="handleImageUpload(event)">
                                        <p class="text-sm text-slate-500">الصيغ المسموح بها: JPG, PNG - الحد الأقصى 2 ميجابايت. يتم حفظ الصورة بعد اختيارها مباشرة.</p>
                                        @error('profile_photo')
                                            <p class="mt-2 text-sm font-bold text-red-500">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="space-y-6">
                                <h3 class="text-xl font-bold border-b border-slate-200 dark:border-slate-700 pb-3">تفضيلات الإشعارات</h3>
                                <div class="space-y-4">
                                    <div class="flex items-center justify-between">
                                        <span class="text-slate-700 dark:text-slate-300">إشعارات الحالات التي أتابعها</span>
                                        <label class="relative inline-flex items-center cursor-pointer">
                                            <input type="checkbox" checked class="sr-only peer">
                                            <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-primary/30 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:right-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary"></div>
                                        </label>
                                    </div>
                                    <div class="flex items-center justify-between">
                                        <span class="text-slate-700 dark:text-slate-300">إشعارات التحديثات الأسبوعية</span>
                                        <label class="relative inline-flex items-center cursor-pointer">
                                            <input type="checkbox" checked class="sr-only peer">
                                            <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-primary/30 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:right-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary"></div>
                                        </label>
                                    </div>
                                    <div class="flex items-center justify-between">
                                        <span class="text-slate-700 dark:text-slate-300">إشعارات عند اكتمال حالة مدعومة</span>
                                        <label class="relative inline-flex items-center cursor-pointer">
                                            <input type="checkbox" checked class="sr-only peer">
                                            <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-primary/30 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:right-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary"></div>
                                        </label>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="space-y-6 lg:sticky lg:top-24 h-fit">
                            <h3 class="text-xl font-bold border-b border-slate-200 dark:border-slate-700 pb-3">إجراءات الحساب</h3>
                            <div class="space-y-4">
                                <button type="submit" class="w-full bg-primary text-white py-3 rounded-lg font-bold hover:bg-blue-600 transition-colors">
                                    حفظ التغييرات
                                </button>
                           
                                <div class="pt-4 border-t border-slate-200 dark:border-slate-700">
                                    <button type="button" onclick="openDeleteAccountModal()" class="w-full text-red-600 dark:text-red-400 hover:text-red-700 dark:hover:text-red-300 font-medium flex items-center justify-center gap-2 py-2 transition-colors">
                                        <span class="material-symbols-outlined">delete</span>
                                        حذف الحساب نهائياً
                                    </button>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>

            </div>
        </main>

    </div>

    <div id="deleteAccountModal" class="fixed inset-0 z-[70] hidden items-center justify-center bg-slate-950/70 px-4 backdrop-blur-sm" onclick="closeDeleteAccountModal(event)">
        <div class="w-full max-w-md rounded-3xl border border-slate-200 bg-white p-8 shadow-2xl dark:border-slate-800 dark:bg-slate-900" onclick="event.stopPropagation()">
            <div class="mb-6 flex items-start gap-4">
                <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-red-100 text-red-600 dark:bg-red-950/40 dark:text-red-400">
                    <span class="material-symbols-outlined">warning</span>
                </div>
                <div>
                    <h3 class="text-xl font-black text-slate-900 dark:text-white">تأكيد حذف الحساب</h3>
                    <p class="mt-2 text-sm font-medium leading-6 text-slate-500 dark:text-slate-400">
                        هذا الإجراء نهائي. أدخل كلمة المرور الحالية لتأكيد حذف الحساب وكل بياناته.
                    </p>
                </div>
            </div>

            <form method="POST" action="{{ route('profile.destroy') }}" class="space-y-5">
                @csrf
                @method('DELETE')

                <div>
                    <label for="delete_password" class="mb-2 block text-sm font-bold text-slate-700 dark:text-slate-300">كلمة المرور الحالية</label>
                    <input
                        id="delete_password"
                        name="password"
                        type="password"
                        placeholder="اكتب كلمة المرور لتأكيد الحذف"
                        class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm font-bold text-slate-800 outline-none transition focus:border-red-400 focus:bg-white focus:ring-4 focus:ring-red-100 dark:border-slate-700 dark:bg-slate-800 dark:text-white"
                    >
                    @if ($errors->userDeletion->has('password'))
                        <p class="mt-2 text-sm font-bold text-red-500">{{ $errors->userDeletion->first('password') }}</p>
                    @endif
                </div>

                <div class="flex gap-3">
                    <button type="button" onclick="closeDeleteAccountModal()" class="flex-1 rounded-2xl bg-slate-100 px-4 py-3 font-bold text-slate-700 transition hover:bg-slate-200 dark:bg-slate-800 dark:text-slate-200 dark:hover:bg-slate-700">
                        إلغاء
                    </button>
                    <button type="submit" class="flex-1 rounded-2xl bg-red-600 px-4 py-3 font-bold text-white transition hover:bg-red-700">
                        حذف الحساب
                    </button>
                </div>
            </form>
        </div>
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
                    console.log('البحث عن:', searchTerm);
                });
            }
        });

        // Change profile picture
        function changeProfilePicture() {
            document.getElementById('profileImageInput').click();
        }

        function handleImageUpload(event) {
            const file = event.target.files[0];
            if (file) {
                if (file.size > 2 * 1024 * 1024) {
                    showToast('❌ حجم الصورة يتجاوز 2 ميجابايت', 'error');
                    event.target.value = '';
                    return;
                }
                if (!file.type.match('image/(jpeg|jpg|png)')) {
                    showToast('❌ الصيغة غير مدعومة. استخدم JPG أو PNG', 'error');
                    event.target.value = '';
                    return;
                }

                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('profileAvatarPreview').src = e.target.result;
                    showToast('⏳ جاري حفظ صورة الملف الشخصي...', 'info');
                    event.target.form?.requestSubmit();
                };
                reader.readAsDataURL(file);
            }
        }

        // Cancel settings
        function cancelSettings() {
            showToast('تم إلغاء التعديلات', 'info');
            setTimeout(() => {
                location.reload();
            }, 1000);
        }

        function openDeleteAccountModal() {
            const modal = document.getElementById('deleteAccountModal');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            document.body.style.overflow = 'hidden';
            document.getElementById('delete_password')?.focus();
        }

        function closeDeleteAccountModal(event) {
            if (event && event.target !== event.currentTarget) {
                return;
            }

            const modal = document.getElementById('deleteAccountModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
            document.body.style.overflow = 'auto';
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

        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closeDeleteAccountModal();
            }
        });

        @if ($errors->userDeletion->isNotEmpty())
            openDeleteAccountModal();
        @endif
    </script>
</body>

</html>
