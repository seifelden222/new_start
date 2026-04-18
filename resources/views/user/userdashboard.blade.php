<!DOCTYPE html>
<html dir="rtl" lang="ar">

<head>
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>لوحة التحكم - بداية جديدة</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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

        /* ── Count-up pulse ── */
        @keyframes countPulse {
            0%   { transform: scale(1); }
            40%  { transform: scale(1.12); }
            100% { transform: scale(1); }
        }

        /* ── Wallet card flash green ── */
        @keyframes flashGreen {
            0%   { box-shadow: 0 0 0 0 rgba(16,185,129,0); }
            30%  { box-shadow: 0 0 0 6px rgba(16,185,129,0.35); background-color: rgba(16,185,129,0.08); }
            100% { box-shadow: 0 0 0 0 rgba(16,185,129,0); background-color: transparent; }
        }

        .wallet-flash {
            animation: flashGreen 0.9s ease-out;
        }

        /* ── Slide-up for stat cards ── */
        @keyframes slideUp {
            from { opacity: 0; transform: translateY(28px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .stat-card {
            opacity: 0;
            animation: slideUp 0.55s ease forwards;
        }
        .stat-card:nth-child(1) { animation-delay: 0.1s; }
        .stat-card:nth-child(2) { animation-delay: 0.22s; }
        .stat-card:nth-child(3) { animation-delay: 0.34s; }
    </style>
</head>

<body class="bg-background-light dark:bg-background-dark text-slate-900 dark:text-slate-100">
    @php
        $user = auth()->user();
    @endphp

    <div class="flex min-h-screen">

        <!-- Sidebar -->
        <x-user-slider />

        <main class="flex-1 mr-64">
            <x-user-navbar />

            <!-- Main Content -->
            <div class="p-8 max-w-7xl mx-auto space-y-8">

                <!-- Welcome Section -->
                <div class="bg-white dark:bg-slate-900 rounded-xl border border-slate-200 dark:border-slate-800 shadow-sm p-8">
                    <h2 class="text-3xl font-black mb-2 text-primary">أهلاً بك {{ $user?->name ?? 'في منصة بداية جديدة' }} 👋</h2>
                    <p class="text-slate-500 dark:text-slate-400 mb-3">لوحة التحكم الخاصة بك - تابعي تبرعاتك وأثرك في المجتمع</p>
                    <span class="inline-flex rounded-full bg-blue-50 px-4 py-2 text-sm font-black text-blue-600">{{ $user?->accountTypeLabel() }}</span>
                </div>

                <!-- Stats Cards -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                    <!-- Wallet Card -->
                    <div id="walletCard" class="stat-card bg-white dark:bg-slate-900 rounded-xl border border-slate-200 dark:border-slate-800 shadow-sm p-6 hover:shadow-md transition-shadow">
                        <div class="flex items-center gap-4 mb-4">
                            <div class="size-12 bg-blue-50 dark:bg-blue-900/20 text-primary rounded-xl flex items-center justify-center">
                                <span class="material-symbols-outlined text-2xl">account_balance_wallet</span>
                            </div>
                            <div>
                                <p class="text-xs text-slate-500 dark:text-slate-400 font-medium">رصيد المحفظة</p>
                                <h3 class="text-2xl font-black text-slate-900 dark:text-white">
                                    <span id="walletBalance" data-value="{{ $user?->balance ?? 0 }}" data-target="{{ $user?->balance ?? 0 }}">0</span>
                                    <span class="text-sm text-slate-400"> ج.م</span>
                                </h3>
                            </div>
                        </div>
                        <button onclick="chargeWallet()" class="w-full py-2 bg-primary/10 hover:bg-primary hover:text-white text-primary text-sm font-bold rounded-lg transition-all">
                            شحن رصيد
                        </button>
                    </div>

                    <!-- Donations Card -->
                    <div class="stat-card bg-white dark:bg-slate-900 rounded-xl border border-slate-200 dark:border-slate-800 shadow-sm p-6 hover:shadow-md transition-shadow">
                        <div class="flex items-center gap-4 mb-4">
                            <div class="size-12 bg-emerald-50 dark:bg-emerald-900/20 text-emerald-500 rounded-xl flex items-center justify-center">
                                <span class="material-symbols-outlined text-2xl">volunteer_activism</span>
                            </div>
                            <div>
                                <p class="text-xs text-slate-500 dark:text-slate-400 font-medium">إجمالي التبرعات</p>
                                <h3 class="text-2xl font-black text-emerald-600">
                                    <span id="totalDonations" data-value="0" data-target="{{ $totalDonated }}">0</span>
                                    <span class="text-sm text-slate-400"> ج.م</span>
                                </h3>
                            </div>
                        </div>
                        <p class="text-xs text-emerald-600 font-bold">
                            تم مساعدة <span id="helpedCount" data-value="0" data-target="{{ $helpedCount }}">0</span> شخص ✓
                        </p>
                    </div>

                    <!-- Points Card -->
                    <div class="stat-card bg-white dark:bg-slate-900 rounded-xl border border-slate-200 dark:border-slate-800 shadow-sm p-6 hover:shadow-md transition-shadow">
                        <div class="flex items-center gap-4 mb-4">
                            <div class="size-12 bg-amber-50 dark:bg-amber-900/20 text-amber-500 rounded-xl flex items-center justify-center">
                                <span class="material-symbols-outlined text-2xl">stars</span>
                            </div>
                            <div>
                                <p class="text-xs text-slate-500 dark:text-slate-400 font-medium">نقاط الأثر</p>
                                @php $impactPoints = (int)($totalDonated / 10); @endphp
                                <h3 class="text-2xl font-black text-amber-500">
                                    <span id="impactPoints" data-value="0" data-target="{{ $impactPoints }}">0</span>
                                    <span class="text-sm text-slate-400"> نقطة</span>
                                </h3>
                            </div>
                        </div>
                        <div class="w-full bg-slate-100 dark:bg-slate-800 h-2 rounded-full overflow-hidden">
                            <div id="pointsBar" class="h-full bg-amber-500 transition-all duration-1000 ease-out" style="width:0%"></div>
                        </div>
                    </div>

                </div>

                <!-- Charts Section -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <div class="bg-white dark:bg-slate-900 rounded-xl border border-slate-200 dark:border-slate-800 shadow-sm p-6">
                        <h3 class="text-lg font-black text-slate-900 dark:text-white mb-6">تحليلات التبرعات الأسبوعية</h3>
                        <canvas id="donationChart" height="200"></canvas>
                    </div>

                    <div class="bg-white dark:bg-slate-900 rounded-xl border border-slate-200 dark:border-slate-800 shadow-sm p-6">
                        <h3 class="text-lg font-black text-slate-900 dark:text-white mb-6">توزيع التبرعات حسب الفئة</h3>
                        <canvas id="impactChart" height="200"></canvas>
                    </div>
                </div>

                <!-- Recent Donations -->
                <div class="bg-white dark:bg-slate-900 rounded-xl border border-slate-200 dark:border-slate-800 shadow-sm overflow-hidden">
                    <div class="p-6 border-b border-slate-200 dark:border-slate-800">
                        <h3 class="text-lg font-black text-slate-900 dark:text-white">آخر التبرعات</h3>
                    </div>
                    <div class="overflow-x-auto">
                        <table id="donationsTable" class="w-full text-right">
                            <thead class="bg-slate-50 dark:bg-slate-800/60 border-b border-slate-200 dark:border-slate-700">
                                <tr>
                                    <th class="px-6 py-3 text-xs font-bold text-slate-500 uppercase">رقم العملية</th>
                                    <th class="px-6 py-3 text-xs font-bold text-slate-500 uppercase">الفئة</th>
                                    <th class="px-6 py-3 text-xs font-bold text-slate-500 uppercase">المبلغ</th>
                                    <th class="px-6 py-3 text-xs font-bold text-slate-500 uppercase">التاريخ</th>
                                    <th class="px-6 py-3 text-xs font-bold text-slate-500 uppercase text-center">الإيصال</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                                @forelse($donations->take(10) as $donation)
                                <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/40 transition-colors">
                                    <td class="px-6 py-4 text-sm text-slate-500">#TX-{{ $donation->id }}</td>
                                    <td class="px-6 py-4 font-bold text-sm">{{ $donation->charityCase?->category ?? '—' }}</td>
                                    <td class="px-6 py-4 font-bold text-emerald-600">{{ number_format($donation->amount) }} ج.م</td>
                                    <td class="px-6 py-4 text-sm text-slate-500">{{ $donation->created_at->format('Y-m-d') }}</td>
                                    <td class="px-6 py-4 text-center">
                                        <button onclick="viewReceipt('#TX-{{ $donation->id }}', '{{ $donation->charityCase?->category ?? '—' }}', '{{ number_format($donation->amount) }}')" class="text-primary hover:text-blue-700">
                                            <span class="material-symbols-outlined">article</span>
                                        </button>
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
                </div>

            </div>
        </main>

    </div>

    <script>
        /* ═══════════════════════════════════════════════
           COUNT-UP ENGINE
           from: current data-value
           to:   target number
           uses: easeOutExpo for natural deceleration
        ═══════════════════════════════════════════════ */
        function countUp(el, targetValue, duration) {
            duration = duration || 1300;

            // Cancel any running animation on this element
            if (el._animFrame) cancelAnimationFrame(el._animFrame);

            var startValue = parseInt(el.dataset.value) || 0;
            var range      = targetValue - startValue;
            var startTime  = null;

            function easeOutExpo(t) {
                return t >= 1 ? 1 : 1 - Math.pow(2, -10 * t);
            }

            function step(timestamp) {
                if (!startTime) startTime = timestamp;
                var elapsed  = timestamp - startTime;
                var progress = Math.min(elapsed / duration, 1);
                var eased    = easeOutExpo(progress);
                var current  = Math.round(startValue + range * eased);

                // Format with commas  e.g. 2,450
                el.textContent = current.toLocaleString('en-US');
                el.dataset.value = current;

                if (progress < 1) {
                    el._animFrame = requestAnimationFrame(step);
                } else {
                    el.textContent   = targetValue.toLocaleString('en-US');
                    el.dataset.value = targetValue;
                    el._animFrame    = null;

                    // Tiny pulse at the end so the eye catches the final value
                    el.style.transition  = 'transform 0.25s ease';
                    el.style.display     = 'inline-block';
                    el.style.transform   = 'scale(1.1)';
                    setTimeout(function () { el.style.transform = 'scale(1)'; }, 250);
                }
            }

            el._animFrame = requestAnimationFrame(step);
        }

        /* ═══════════════════════════════════════════════
           PAGE-LOAD — animate all [data-target] spans
        ═══════════════════════════════════════════════ */
        function runPageLoadCountUps() {
            document.querySelectorAll('[data-target]').forEach(function (el) {
                var target = parseInt(el.dataset.target);
                countUp(el, target, 1400);
            });

            // Progress bar for points
            setTimeout(function () {
                document.getElementById('pointsBar').style.width = '65%';
            }, 500);
        }

        /* ═══════════════════════════════════════════════
           CHARTS
        ═══════════════════════════════════════════════ */
        function initCharts() {
            // Weekly donation line chart
            new Chart(document.getElementById('donationChart'), {
                type: 'line',
                data: {
                    labels: ['السبت', 'الأحد', 'الاثنين', 'الثلاثاء', 'الأربعاء', 'الخميس', 'الجمعة'],
                    datasets: [{
                        data: @json($weeklyData),
                        borderColor: '#007bff',
                        borderWidth: 3,
                        tension: 0.4,
                        fill: true,
                        backgroundColor: 'rgba(0,123,255,0.1)',
                        pointRadius: 4,
                        pointBackgroundColor: '#007bff'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: true,
                    plugins: { legend: { display: false } },
                    scales: {
                        y: { beginAtZero: true, grid: { color: 'rgba(0,0,0,0.05)' } },
                        x: { grid: { display: false } }
                    }
                }
            });

            // Category doughnut chart
            new Chart(document.getElementById('impactChart'), {
                type: 'doughnut',
                data: {
                    labels: ['تأهيل أيتام', 'سكن مشردين', 'تعليم', 'صحة'],
                    datasets: [{
                        data: [40, 25, 20, 15],
                        backgroundColor: ['#007bff', '#10b981', '#f59e0b', '#f43f5e'],
                        borderWidth: 0
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: true,
                    cutout: '70%',
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                font: { family: 'Cairo', weight: 'bold', size: 11 },
                                padding: 15
                            }
                        }
                    }
                }
            });
        }

        /* ═══════════════════════════════════════════════
           NOTIFICATIONS
        ═══════════════════════════════════════════════ */
        function toggleNotifications() {
            document.getElementById('notificationsPopup').classList.remove('hidden');
        }

        function closeNotifications(event) {
            if (event) event.stopPropagation();
            document.getElementById('notificationsPopup').classList.add('hidden');
        }

        /* ═══════════════════════════════════════════════
           SEARCH — filters the recent donations table
        ═══════════════════════════════════════════════ */

        /* ═══════════════════════════════════════════════
           CHARGE WALLET
        ═══════════════════════════════════════════════ */
        function chargeWallet() {
            var balanceEl   = document.getElementById('walletBalance');
            var donationsEl = document.getElementById('totalDonations');
            // Read from data-target (real DB value) not data-value (animation progress)
            var balance   = parseInt(balanceEl.dataset.target) || 0;
            var donations = parseInt(donationsEl.dataset.target) || 0;

            document.getElementById('popupCurrentBalance').textContent  = balance.toLocaleString('en-US') + ' ج.م';
            document.getElementById('popupTotalDonations').textContent  = donations.toLocaleString('en-US') + ' ج.م';
            document.getElementById('chargeWalletPopup').classList.remove('hidden');
        }

        function closeChargeWallet(event) {
            if (event) event.stopPropagation();
            document.getElementById('chargeWalletPopup').classList.add('hidden');
        }

        var selectedPayment = '';

        function selectPaymentMethod(method) {
            selectedPayment = method;
            document.querySelectorAll('.payment-method').forEach(function (btn) {
                btn.classList.remove('border-primary', 'bg-primary/10');
            });
            event.target.closest('.payment-method').classList.add('border-primary', 'bg-primary/10');
        }

        function confirmCharge() {
            var inputEl = document.getElementById('chargeAmount');
            var amount  = parseInt(inputEl.value);

            if (!amount || amount <= 0) {
                showToast('❌ برجاء إدخال مبلغ صحيح', 'error');
                return;
            }
            if (!selectedPayment) {
                showToast('❌ برجاء اختيار طريقة الدفع', 'error');
                return;
            }

            // Send to backend
            fetch('{{ route("wallet.charge") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                },
                body: JSON.stringify({ amount: amount }),
            })
            .then(function (res) { return res.json(); })
            .then(function (data) {
                closeChargeWallet();

                var balanceEl = document.getElementById('walletBalance');
                var newValue  = data.balance;

                // Update data-target so popup shows correct value next time
                balanceEl.dataset.target = newValue;

                var card = document.getElementById('walletCard');
                card.classList.remove('wallet-flash');
                void card.offsetWidth;
                card.classList.add('wallet-flash');
                setTimeout(function () { card.classList.remove('wallet-flash'); }, 950);

                var duration = Math.min(800 + amount / 10, 1400);
                countUp(balanceEl, newValue, duration);

                showToast('✅ تم شحن ' + amount.toLocaleString('en-US') + ' ج.م عبر ' + selectedPayment, 'success');

                inputEl.value   = '';
                selectedPayment = '';
                document.querySelectorAll('.payment-method').forEach(function (btn) {
                    btn.classList.remove('border-primary', 'bg-primary/10');
                });
            })
            .catch(function () {
                showToast('❌ حدث خطأ، حاول مرة أخرى', 'error');
            });
        }

        /* ═══════════════════════════════════════════════
           RECEIPT
        ═══════════════════════════════════════════════ */
        function viewReceipt(id, category, amount) {
            document.getElementById('receiptId').textContent       = id;
            document.getElementById('receiptCategory').textContent = category;
            document.getElementById('receiptAmount').textContent   = amount + ' ج.م';
            document.getElementById('receiptDate').textContent     = new Date().toLocaleDateString('ar-EG');
            document.getElementById('receiptPopup').classList.remove('hidden');
        }

        function closeReceipt(event) {
            if (event) event.stopPropagation();
            document.getElementById('receiptPopup').classList.add('hidden');
        }

        function downloadReceipt() {
            showToast('📄 جاري تحميل الإيصال...', 'info');
            setTimeout(function () {
                showToast('✅ تم تحميل الإيصال بنجاح', 'success');
            }, 1000);
        }

        /* ═══════════════════════════════════════════════
           TOAST
        ═══════════════════════════════════════════════ */
        function showToast(message, type) {
            type = type || 'info';
            var colors = { success: '#10b981', error: '#ef4444', info: '#3b82f6' };
            var toast  = document.createElement('div');

            toast.textContent = message;
            toast.style.cssText = [
                'position:fixed',
                'top:24px',
                'left:50%',
                'transform:translateX(-50%)',
                'background:' + colors[type],
                'color:#fff',
                'padding:12px 24px',
                'border-radius:12px',
                'box-shadow:0 8px 32px rgba(0,0,0,0.18)',
                'z-index:9999',
                'font-family:Cairo,sans-serif',
                'font-weight:700',
                'font-size:14px',
                'white-space:nowrap',
                'opacity:1',
                'transition:opacity 0.4s ease'
            ].join(';');

            document.body.appendChild(toast);

            setTimeout(function () { toast.style.opacity = '0'; }, 2600);
            setTimeout(function () { toast.remove(); },           3000);
        }

        /* ═══════════════════════════════════════════════
           INIT
        ═══════════════════════════════════════════════ */
        window.onload = function () {
            initCharts();
            runPageLoadCountUps();

            // Search
            var searchInput = document.getElementById('searchInput');
            if (searchInput) {
                searchInput.addEventListener('input', function (e) {
                    var searchTerm = e.target.value.toLowerCase().trim();
                    var rows = document.querySelectorAll('#donationsTable tbody tr');
                    rows.forEach(function (row) {
                        row.style.display = searchTerm === '' || row.textContent.toLowerCase().includes(searchTerm) ? '' : 'none';
                    });
                });
            }
        };
    </script>

    <!-- ══════════════════════════════════════════════
         NOTIFICATIONS POPUP
    ══════════════════════════════════════════════ -->
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

    <!-- ══════════════════════════════════════════════
         CHARGE WALLET POPUP
    ══════════════════════════════════════════════ -->
    <div id="chargeWalletPopup" class="hidden fixed inset-0 bg-black/50 z-50 flex items-center justify-center" onclick="closeChargeWallet(event)">
        <div class="bg-white dark:bg-slate-900 rounded-2xl shadow-2xl w-full max-w-md mx-4" onclick="event.stopPropagation()">
            <div class="p-6 border-b border-slate-200 dark:border-slate-800 flex items-center justify-between">
                <h3 class="text-lg font-bold text-slate-900 dark:text-white">شحن رصيد المحفظة</h3>
                <button onclick="closeChargeWallet()" class="text-slate-400 hover:text-slate-600 dark:hover:text-slate-400">
                    <span class="material-symbols-outlined">close</span>
                </button>
            </div>
            <div class="p-6">
                <!-- Wallet summary -->
                <div class="mb-5 grid grid-cols-2 gap-3">
                    <div class="rounded-xl bg-blue-50 dark:bg-blue-900/20 p-3 text-center">
                        <p class="text-xs text-slate-500 dark:text-slate-400 font-medium mb-1">رصيدك الحالي</p>
                        <p class="text-lg font-black text-primary" id="popupCurrentBalance">0 ج.م</p>
                    </div>
                    <div class="rounded-xl bg-emerald-50 dark:bg-emerald-900/20 p-3 text-center">
                        <p class="text-xs text-slate-500 dark:text-slate-400 font-medium mb-1">إجمالي تبرعاتك</p>
                        <p class="text-lg font-black text-emerald-600" id="popupTotalDonations">0 ج.م</p>
                    </div>
                </div>
                <div class="mb-6">
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">المبلغ (ج.م)</label>
                    <input type="number" id="chargeAmount"
                        class="w-full px-4 py-3 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-lg focus:ring-2 focus:ring-primary/50 focus:border-primary outline-none"
                        placeholder="أدخل المبلغ">
                </div>
                <div class="mb-6">
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-3">طريقة الدفع</label>
                    <div class="grid grid-cols-2 gap-3">
                        <button onclick="selectPaymentMethod('فودافون كاش')" class="payment-method p-4 border-2 border-slate-200 dark:border-slate-700 rounded-xl hover:border-primary hover:bg-primary/5 transition-all text-center">
                            <span class="material-symbols-outlined text-3xl text-primary mb-2">smartphone</span>
                            <p class="text-xs font-bold">فودافون كاش</p>
                        </button>
                        <button onclick="selectPaymentMethod('بطاقة بنكية')" class="payment-method p-4 border-2 border-slate-200 dark:border-slate-700 rounded-xl hover:border-primary hover:bg-primary/5 transition-all text-center">
                            <span class="material-symbols-outlined text-3xl text-primary mb-2">credit_card</span>
                            <p class="text-xs font-bold">بطاقة بنكية</p>
                        </button>
                    </div>
                </div>
                <button onclick="confirmCharge()" class="w-full bg-primary text-white py-3 rounded-lg font-bold hover:bg-blue-600 transition-colors">
                    تأكيد الشحن
                </button>
            </div>
        </div>
    </div>

    <!-- ══════════════════════════════════════════════
         RECEIPT POPUP
    ══════════════════════════════════════════════ -->
    <div id="receiptPopup" class="hidden fixed inset-0 bg-black/50 z-50 flex items-center justify-center" onclick="closeReceipt(event)">
        <div class="bg-white dark:bg-slate-900 rounded-2xl shadow-2xl w-full max-w-md mx-4" onclick="event.stopPropagation()">
            <div class="p-6 border-b border-slate-200 dark:border-slate-800 flex items-center justify-between">
                <h3 class="text-lg font-bold text-slate-900 dark:text-white">إيصال التبرع</h3>
                <button onclick="closeReceipt()" class="text-slate-400 hover:text-slate-600 dark:hover:text-slate-400">
                    <span class="material-symbols-outlined">close</span>
                </button>
            </div>
            <div class="p-6">
                <div class="text-center mb-6">
                    <div class="size-16 bg-emerald-100 dark:bg-emerald-900/30 rounded-full flex items-center justify-center mx-auto mb-3">
                        <span class="material-symbols-outlined text-3xl text-emerald-600">check_circle</span>
                    </div>
                    <h4 class="text-xl font-bold text-slate-900 dark:text-white mb-1">تم التبرع بنجاح</h4>
                    <p class="text-sm text-slate-500">شكراً لعطائك الكريم</p>
                </div>
                <div class="space-y-3 bg-slate-50 dark:bg-slate-800 rounded-xl p-4 mb-6">
                    <div class="flex justify-between">
                        <span class="text-sm text-slate-600 dark:text-slate-400">رقم العملية</span>
                        <span id="receiptId" class="text-sm font-bold text-slate-900 dark:text-white"></span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-sm text-slate-600 dark:text-slate-400">الفئة</span>
                        <span id="receiptCategory" class="text-sm font-bold text-slate-900 dark:text-white"></span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-sm text-slate-600 dark:text-slate-400">المبلغ</span>
                        <span id="receiptAmount" class="text-sm font-bold text-emerald-600"></span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-sm text-slate-600 dark:text-slate-400">التاريخ</span>
                        <span id="receiptDate" class="text-sm font-bold text-slate-900 dark:text-white"></span>
                    </div>
                </div>
                <button onclick="downloadReceipt()" class="w-full bg-primary text-white py-3 rounded-lg font-bold hover:bg-blue-600 transition-colors mb-2">
                    تحميل الإيصال PDF
                </button>
                <button onclick="closeReceipt()" class="w-full bg-slate-100 dark:bg-slate-800 text-slate-700 dark:text-slate-300 py-3 rounded-lg font-medium hover:bg-slate-200 dark:hover:bg-slate-700 transition-colors">
                    إغلاق
                </button>
            </div>
        </div>
    </div>

</body>
</html>
