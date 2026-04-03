<!DOCTYPE html>
<html dir="rtl" lang="ar">

<head>
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>بداية جديدة - خدماتنا الإنسانية</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700;900&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&display=swap" rel="stylesheet" />
    <style>
        body {
            font-family: 'Cairo', sans-serif;
        }

        .progress-glow {
            box-shadow: 0 0 15px rgba(59, 130, 246, 0.4);
        }

        .selected-card {
            border-color: #007bff !important;
            background-color: #f0f7ff !important;
            transform: scale(1.02);
        }

        .selection-card {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
    </style>
</head>

<body class="bg-slate-50 text-slate-900 overflow-x-hidden">

    <x-land-navbar />


    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

        <nav class="flex items-center gap-3 mb-8 text-sm font-semibold">
            <a class="flex items-center gap-1.5 text-slate-400 hover:text-[#007bff]" href="{{ url('/') }}">
                <span class="material-symbols-outlined text-[18px]">home</span> الرئيسية
            </a>
            <span class="material-symbols-outlined text-slate-300 text-[16px]">chevron_left</span>
            <span class="bg-blue-50 text-[#007bff] px-3 py-1 rounded-lg">خدمات التمكين والدعم</span>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">

            <div class="lg:col-span-8 flex flex-col gap-8">
                <div class="bg-white p-8 rounded-[2rem] shadow-sm border border-slate-100">
                    <h2 class="text-3xl font-black text-slate-900 mb-4">خدماتنا الأساسية</h2>
                    <p class="text-slate-600 leading-relaxed text-lg">نركز على حل مشكلات السكن والتوظيف للأيتام فوق سن 18 والمشردين. اختر الخدمة التي ترغب في دعمها:</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-5">
                    <div class="selection-card group bg-white p-5 rounded-3xl shadow-sm border border-slate-100 hover:border-[#007bff]/30 cursor-pointer" onclick="selectOption(this)">
                        <img src="https://img.freepik.com/free-photo/graduate-holding-diploma_23-2148522295.jpg" class="w-full h-32 object-cover rounded-2xl mb-4">
                        <h3 class="font-bold text-slate-900 mb-1">تأهيل وتوظيف</h3>
                        <p class="text-slate-500 text-xs mb-4">تمويل الدورات التدريبية وتوفير معدات العمل لبدء حياة مهنية مستقلة.</p>
                        <button class="option-btn w-full py-2.5 rounded-xl bg-slate-50 text-slate-600 text-sm font-bold transition-all">اختيار الخدمة</button>
                    </div>

                    <div class="selection-card group bg-white p-5 rounded-3xl shadow-sm border border-slate-100 hover:border-[#007bff]/30 cursor-pointer" onclick="selectOption(this)">
                        <img src="assets/img/donate3 (1).jpg" class="w-full h-32 object-cover rounded-2xl mb-4">
                        <h3 class="font-bold text-slate-900 mb-1">مأوى آمن</h3>
                        <p class="text-slate-500 text-xs mb-4">توفير سكن كريم للأيتام المستقلين حديثاً والمشردين لضمان حياة آمنة.</p>
                        <button class="option-btn w-full py-2.5 rounded-xl bg-slate-50 text-slate-600 text-sm font-bold transition-all">اختيار الخدمة</button>
                    </div>

                    <div class="selection-card group bg-white p-5 rounded-3xl shadow-sm border border-slate-100 hover:border-[#007bff]/30 cursor-pointer" onclick="selectOption(this)">
                        <img src="assets/img/donate3 (2).jpg" class="w-full h-32 object-cover rounded-2xl mb-4">
                        <h3 class="font-bold text-slate-900 mb-1">رعاية طبية</h3>
                        <p class="text-slate-500 text-xs mb-4">تغطية الفحوصات والعمليات الجراحية العاجلة للحالات الطبية الصعبة.</p>
                        <button class="option-btn w-full py-2.5 rounded-xl bg-slate-50 text-slate-600 text-sm font-bold transition-all">اختيار الخدمة</button>
                    </div>

                    <div class="selection-card group bg-white p-5 rounded-3xl shadow-sm border border-slate-100 hover:border-[#007bff]/30 cursor-pointer" onclick="selectOption(this)">
                        <img src="assets/img/donate1 (1).jpg" class="w-full h-32 object-cover rounded-2xl mb-4">
                        <h3 class="font-bold text-slate-900 mb-1">تجهيز وحدات</h3>
                        <p class="text-slate-500 text-xs mb-4">توفير الأثاث والأجهزة الأساسية لتجهيز بيوت الشباب المستقلين.</p>
                        <button class="option-btn w-full py-2.5 rounded-xl bg-slate-50 text-slate-600 text-sm font-bold transition-all">اختيار الخدمة</button>
                    </div>

                    <div class="selection-card group bg-white p-5 rounded-3xl shadow-sm border border-slate-100 hover:border-[#007bff]/30 cursor-pointer" onclick="selectOption(this)">
                        <img src="assets/img/donate5.jpg" class="w-full h-32 object-cover rounded-2xl mb-4">
                        <h3 class="font-bold text-slate-900 mb-1">كسوة ودفء</h3>
                        <p class="text-slate-500 text-xs mb-4">توفير الملابس والأغطية للمشردين لمواجهة ظروف الشتاء القاسية.</p>
                        <button class="option-btn w-full py-2.5 rounded-xl bg-slate-50 text-slate-600 text-sm font-bold transition-all">اختيار الخدمة</button>
                    </div>

                    <div class="selection-card group bg-white p-5 rounded-3xl shadow-sm border border-slate-100 hover:border-[#007bff]/30 cursor-pointer" onclick="selectOption(this)">
                        <img src="assets/img/donate1 (2).jpg" class="w-full h-32 object-cover rounded-2xl mb-4">
                        <h3 class="font-bold text-slate-900 mb-1">دعم معيشي</h3>
                        <p class="text-slate-500 text-xs mb-4">كفالة شهرية تغطي الاحتياجات اليومية للأيتام في مرحلة الانتقال للعمل.</p>
                        <button class="option-btn w-full py-2.5 rounded-xl bg-slate-50 text-slate-600 text-sm font-bold transition-all">اختيار الخدمة</button>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-4 space-y-8">
                <div class="bg-white p-7 rounded-[2rem] shadow-xl border border-slate-100 sticky top-24">
                    <h3 class="text-xl font-black text-slate-900 mb-6 text-center">نموذج المساهمة</h3>
                    <form id="donationForm" class="space-y-4" onsubmit="confirmDonation(event)">
                        <div>
                            <label class="block text-xs font-bold text-slate-400 mb-2 mr-2">الاسم بالكامل</label>
                            <input id="donorName" required pattern="^[A-Za-z\u0600-\u06FF\s]+$"
                                class="w-full bg-slate-50 border-none rounded-xl py-3.5 px-4 focus:ring-2 focus:ring-blue-500/20 text-sm font-bold"
                                placeholder="أدخل حروف فقط..." type="text" />
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-400 mb-2 mr-2">رقم الهاتف</label>
                            <input id="donorPhone" required pattern="^[0-9]{11}$" maxlength="11"
                                class="w-full bg-slate-50 border-none rounded-xl py-3.5 px-4 focus:ring-2 focus:ring-blue-500/20 text-sm font-bold"
                                placeholder="01xxxxxxxxx" type="tel" />
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-400 mb-2 mr-2">مبلغ التبرع (ج.م)</label>
                            <input required min="1" class="w-full bg-slate-50 border-none rounded-xl py-3.5 px-4 focus:ring-2 focus:ring-blue-500/20 text-sm font-bold"
                                placeholder="100" type="number" />
                        </div>

                        <button type="submit" class="w-full bg-[#007bff] text-white py-4 rounded-2xl font-black text-base shadow-lg shadow-[#007bff]/20 hover:bg-[#0056b3] active:scale-95 transition-all flex items-center justify-center gap-2">
                            <span>تأكيد المساهمة</span>
                            <span class="material-symbols-outlined">volunteer_activism</span>
                        </button>
                    </form>
                    <p class="text-[10px] text-slate-400 text-center mt-4">بضغطك على تأكيد، أنت توافق على سياسة التبرع في المنصة.</p>
                </div>
            </div>
        </div>
    </main>

    <!--Footer-->
    <x-land-footer />
    <!-- Map Popup Modal -->
    <div id="mapPopup" class="fixed inset-0 bg-black/70 backdrop-blur-sm z-[100] hidden items-center justify-center p-4" onclick="closeMapPopup(event)">
        <div class="bg-white rounded-3xl shadow-2xl max-w-4xl w-full overflow-hidden animate-fade-in" onclick="event.stopPropagation()">
            <div class="bg-gradient-to-r from-blue-600 to-blue-700 p-6 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <span class="material-symbols-outlined text-white text-3xl">location_on</span>
                    <h3 class="text-2xl font-bold text-white">موقعنا - جمهورية مصر العربية</h3>
                </div>
                <button onclick="closeMapPopup()" class="text-white hover:bg-white/20 p-2 rounded-xl transition-all">
                    <span class="material-symbols-outlined text-3xl">close</span>
                </button>
            </div>
            <div class="p-6">
                <div class="rounded-2xl overflow-hidden shadow-lg border-4 border-slate-100">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7290552.932147338!2d26.820553!3d26.820553!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x14368976c35c36e9%3A0x2c45a00925c4c444!2sEgypt!5e0!3m2!1sen!2seg!4v1234567890123!5m2!1sen!2seg"
                        width="100%"
                        height="450"
                        style="border:0;"
                        allowfullscreen=""
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
                <div class="mt-6 bg-blue-50 p-4 rounded-xl">
                    <p class="text-slate-700 text-center font-bold">
                        <span class="material-symbols-outlined text-blue-600 align-middle ml-2">info</span>
                        نخدم جميع محافظات جمهورية مصر العربية
                    </p>
                </div>
            </div>
        </div>
    </div>

    <script>
        function selectOption(cardOrBtn) {
            let card = cardOrBtn.classList.contains('selection-card') ? cardOrBtn : cardOrBtn.closest('.selection-card');

            document.querySelectorAll('.selection-card').forEach(c => {
                c.classList.remove('selected-card');
                const btn = c.querySelector('.option-btn');
                btn.innerText = 'اختيار الخدمة';
                btn.classList.replace('bg-[#007bff]', 'bg-slate-50');
                btn.classList.remove('text-white');
            });

            card.classList.add('selected-card');
            const btn = card.querySelector('.option-btn');
            btn.innerText = 'تم اختيار الخدمة ✓';
            btn.classList.replace('bg-slate-50', 'bg-[#007bff]');
            btn.classList.add('text-white');
        }

        function confirmDonation(event) {
            event.preventDefault();
            const name = document.getElementById('donorName').value;
            const phone = document.getElementById('donorPhone').value;
            const isSelected = document.querySelector('.selected-card');

            if (!isSelected) {
                alert("يرجى اختيار نوع الخدمة أولاً");
                return;
            }

            if (phone.length !== 11) {
                alert("رقم الهاتف يجب أن يكون 11 رقم");
                return;
            }

            alert("شكراً لكِ يا مي! تم تسجيل مساهمتك بنجاح 💙");
        }

        function openMapPopup() {
            const popup = document.getElementById('mapPopup');
            popup.classList.remove('hidden');
            popup.classList.add('flex');
            document.body.style.overflow = 'hidden';
        }

        function closeMapPopup(event) {
            if (event && event.target !== event.currentTarget) return;
            const popup = document.getElementById('mapPopup');
            popup.classList.add('hidden');
            popup.classList.remove('flex');
            document.body.style.overflow = 'auto';
        }

        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closeMapPopup();
            }
        });
    </script>

    <style>
        @keyframes fade-in {
            from {
                opacity: 0;
                transform: scale(0.95);
            }

            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        .animate-fade-in {
            animation: fade-in 0.3s ease-out;
        }
    </style>
</body>

</html>
