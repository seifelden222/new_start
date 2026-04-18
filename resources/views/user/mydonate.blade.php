<!DOCTYPE html>
<html dir="rtl" lang="ar">

<head>
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>تبرعاتي - بداية جديدة</title>
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
    @php
        $donorName = auth()->user()?->name ?? 'مستخدم المنصة';
    @endphp
    <div class="flex min-h-screen">

     
        <x-user-slider />

        <main class="flex-1 mr-64">

            <x-user-navbar />

            <div class="p-8 max-w-7xl mx-auto space-y-8">

                <div class="bg-white dark:bg-slate-900 rounded-xl border border-slate-200 dark:border-slate-800 shadow-sm p-8">
                    <h2 class="text-3xl font-black mb-2 text-primary">تبرعاتي</h2>
                    <p class="text-slate-500 dark:text-slate-400 mb-8">جميع التبرعات التي قمت بها حتى الآن - إجمالي: {{ number_format($totalDonated) }} جنيه مصري</p>

                    <div class="bg-white dark:bg-slate-900 rounded-xl border border-slate-200 dark:border-slate-800 overflow-hidden">
                        <table class="w-full text-right">
                            <thead class="bg-slate-50 dark:bg-slate-800/50 border-b border-slate-100 dark:border-slate-700">
                                <tr>
                                    <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase">الحالة</th>
                                    <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase">التاريخ</th>
                                    <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase">المبلغ</th>
                                    <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase">طريقة الدفع</th>
                                    <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase text-center">إيصال</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                                @forelse($donations as $donation)
                                <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-800/30 transition-colors">
                                    <td class="px-6 py-5">
                                        <div class="flex items-center gap-3">
                                            <div class="w-10 h-10 rounded-full bg-primary/20 flex items-center justify-center">
                                                <span class="material-symbols-outlined text-primary text-sm">volunteer_activism</span>
                                            </div>
                                            <div>
                                                <p class="font-bold text-sm">{{ $donation->charityCase?->title ?? 'تبرع عام' }}</p>
                                                <p class="text-xs text-slate-500">{{ $donation->charityCase?->category ?? '—' }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-5 text-sm text-slate-500">{{ $donation->created_at->format('d M Y') }}</td>
                                    <td class="px-6 py-5 text-sm font-black text-emerald-600">{{ number_format($donation->amount) }} جنيه مصري</td>
                                    <td class="px-6 py-5 text-sm text-slate-500">{{ $donation->payment_method ?? '—' }}</td>
                                    <td class="px-6 py-5 text-center">
                                        <button onclick="viewDonationReceipt('{{ $donation->charityCase?->title ?? 'تبرع عام' }}', '{{ number_format($donation->amount) }}', '{{ $donation->payment_method ?? '—' }}', '{{ $donation->created_at->format('d M Y') }}')" class="material-symbols-outlined text-slate-400 hover:text-primary transition-colors text-2xl">receipt_long</button>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-10 text-center text-slate-400 font-bold">لا توجد تبرعات بعد</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-8 flex justify-between items-center flex-wrap gap-4">
                        <div class="text-sm text-slate-500">
                            عرض {{ $donations->firstItem() ?? 0 }}–{{ $donations->lastItem() ?? 0 }} من {{ $donations->total() }} تبرع
                        </div>
                        <div class="flex gap-2">
                            <button class="px-4 py-2 bg-slate-100 dark:bg-slate-800 rounded-lg text-sm font-medium disabled:opacity-50" disabled>السابق</button>
                            <button class="px-4 py-2 bg-primary text-white rounded-lg text-sm font-medium hover:bg-blue-600 transition-colors">التالي</button>
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

    <!-- Donation Receipt Popup -->
    <div id="donationReceiptPopup" class="hidden fixed inset-0 bg-black/50 z-50 flex items-center justify-center" onclick="closeDonationReceipt(event)">
        <div class="bg-white dark:bg-slate-900 rounded-2xl shadow-2xl w-full max-w-md mx-4" onclick="event.stopPropagation()">
            <div class="p-6 border-b border-slate-200 dark:border-slate-800 flex items-center justify-between">
                <h3 class="text-lg font-bold text-slate-900 dark:text-white">إيصال التبرع</h3>
                <button onclick="closeDonationReceipt()" class="text-slate-400 hover:text-slate-600 dark:hover:text-slate-400">
                    <span class="material-symbols-outlined">close</span>
                </button>
            </div>
            <div class="p-6">
                <div class="text-center mb-6">
                    <div class="size-16 bg-emerald-100 dark:bg-emerald-900/30 rounded-full flex items-center justify-center mx-auto mb-3">
                        <span class="material-symbols-outlined text-3xl text-emerald-600">receipt_long</span>
                    </div>
                    <h4 class="text-xl font-bold text-slate-900 dark:text-white mb-1">إيصال تبرع</h4>
                    <p class="text-sm text-slate-500">شكراً لعطائك الكريم</p>
                </div>
                <div class="space-y-3 bg-slate-50 dark:bg-slate-800 rounded-xl p-4 mb-6">
                    <div class="flex justify-between">
                        <span class="text-sm text-slate-600 dark:text-slate-400">الحالة</span>
                        <span id="donationCase" class="text-sm font-bold text-slate-900 dark:text-white"></span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-sm text-slate-600 dark:text-slate-400">المبلغ</span>
                        <span id="donationAmount" class="text-sm font-bold text-emerald-600"></span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-sm text-slate-600 dark:text-slate-400">طريقة الدفع</span>
                        <span id="donationPayment" class="text-sm font-bold text-slate-900 dark:text-white"></span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-sm text-slate-600 dark:text-slate-400">التاريخ</span>
                        <span id="donationDate" class="text-sm font-bold text-slate-900 dark:text-white"></span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-sm text-slate-600 dark:text-slate-400">المتبرع</span>
                        <span class="text-sm font-bold text-slate-900 dark:text-white">{{ $donorName }}</span>
                    </div>
                </div>
                <button onclick="downloadDonationReceipt()" class="w-full bg-primary text-white py-3 rounded-lg font-bold hover:bg-blue-600 transition-colors mb-2">
                    تحميل الإيصال PDF
                </button>
                <button onclick="closeDonationReceipt()" class="w-full bg-slate-100 dark:bg-slate-800 text-slate-700 dark:text-slate-300 py-3 rounded-lg font-medium hover:bg-slate-200 dark:hover:bg-slate-700 transition-colors">
                    إغلاق
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
                    const rows = document.querySelectorAll('tbody tr');
                    let visibleCount = 0;

                    rows.forEach(row => {
                        const caseName = row.querySelector('.font-bold')?.textContent.toLowerCase() || '';
                        const description = row.querySelector('.text-xs')?.textContent.toLowerCase() || '';

                        if (caseName.includes(searchTerm) || description.includes(searchTerm)) {
                            row.style.display = '';
                            visibleCount++;
                        } else {
                            row.style.display = 'none';
                        }
                    });

                    console.log(`تم العثور على ${visibleCount} تبرع`);
                });
            }
        });

        // View donation receipt
        function viewDonationReceipt(caseName, amount, paymentMethod, date) {
            document.getElementById('donationCase').textContent = caseName;
            document.getElementById('donationAmount').textContent = amount + ' ج.م';
            document.getElementById('donationPayment').textContent = paymentMethod;
            document.getElementById('donationDate').textContent = date;
            document.getElementById('donationReceiptPopup').classList.remove('hidden');
        }

        function closeDonationReceipt(event) {
            if (event) event.stopPropagation();
            document.getElementById('donationReceiptPopup').classList.add('hidden');
        }

        function downloadDonationReceipt() {
            showToast('📄 جاري تحميل الإيصال...', 'info');
            setTimeout(() => {
                showToast('✅ تم تحميل الإيصال بنجاح', 'success');
            }, 1000);
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
