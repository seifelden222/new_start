<!DOCTYPE html>
<html dir="rtl" lang="ar">

<head>
  <meta charset="utf-8" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta content="width=device-width, initial-scale=1.0" name="viewport" />
  <title>بداية جديدة - الحالات الإنسانية</title>
  <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
  <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&display=swap" rel="stylesheet" />
  <script id="tailwind-config">
    tailwind.config = {
      darkMode: "class",
      theme: {
        extend: {
          colors: {
            "primary": "#007bff",
            "background-light": "#f5f7f8",
            "background-dark": "#0f1923"
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
    }

    .material-symbols-outlined {
      font-variation-settings: 'FILL' 1, 'wght' 400, 'GRAD' 0, 'opsz' 24;
    }

    .case-card {
      transition: all 0.3s ease;
    }

    .line-clamp-custom {
      display: -webkit-box;
      -webkit-line-clamp: 2;
      -webkit-box-orient: vertical;
      overflow: hidden;
    }

    .expanded {
      -webkit-line-clamp: unset !important;
      display: block !important;
    }
  </style>
</head>

<body class="bg-background-light dark:bg-background-dark text-slate-900 dark:text-slate-100 min-h-screen">

  <x-land-navbar />

  <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="mb-8">
      <h2 class="text-3xl font-black mb-2">قائمة الحالات الإنسانية</h2>
      <p class="text-slate-500">ساهم في تغيير حياة الآخرين من خلال دعم الحالات الأكثر احتياجاً</p>
    </div>

    <div class="flex flex-col lg:flex-row gap-8">
      <aside class="w-full lg:w-80 space-y-8 lg:order-last">
        <div class="bg-white dark:bg-slate-900 rounded-xl p-6 shadow-sm border border-slate-200 dark:border-slate-800">
          <div class="flex items-center justify-between mb-6">
            <h3 class="text-xl font-bold flex items-center gap-3">تصفية النتائج</h3>
            <button onclick="resetFilters()" class="text-sm text-primary font-bold">مسح الكل</button>
          </div>

          <div class="mb-8">
            <label class="block font-bold mb-3">بحث سريع</label>
            <input id="searchInput" onkeyup="applyLogic()" class="w-full h-12 rounded-xl border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800" placeholder="رقم الحالة أو الاسم..." type="text" />
          </div>

          <div class="mb-8">
            <label class="block font-bold mb-4">فئة الحالة</label>
            <div class="space-y-4">
              <label class="flex items-center gap-4"><input type="checkbox" value="يتيم" onchange="applyLogic()" class="cat-f rounded"> <span>يتيم</span></label>
              <label class="flex items-center gap-4"><input type="checkbox" value="بلا مأوى" onchange="applyLogic()" class="cat-f rounded"> <span>بلا مأوى</span></label>
              <label class="flex items-center gap-4"><input type="checkbox" value="حالة طارئة" onchange="applyLogic()" class="cat-f rounded"> <span>حالات طارئة</span></label>
            </div>
          </div>

          <div class="mb-8">
            <label class="block font-bold mb-4">الفئة العمرية</label>
            <div class="space-y-4">
              <label class="flex items-center gap-4"><input name="age" type="radio" value="all" checked onchange="applyLogic()"> <span>الكل</span></label>
              <label class="flex items-center gap-4"><input name="age" type="radio" value="child" onchange="applyLogic()"> <span>أقل من 18 سنة</span></label>
              <label class="flex items-center gap-4"><input name="age" type="radio" value="young" onchange="applyLogic()"> <span>18 - 25 سنة</span></label>
              <label class="flex items-center gap-4"><input name="age" type="radio" value="adult" onchange="applyLogic()"> <span>26 - 40 سنة</span></label>
              <label class="flex items-center gap-4"><input name="age" type="radio" value="old" onchange="applyLogic()"> <span>أكثر من 40 سنة</span></label>
            </div>
          </div>

          <div>
            <label class="block font-bold mb-3">الحالة الاجتماعية</label>
            <select id="socialFilter" onchange="applyLogic()" class="w-full h-12 rounded-xl border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800">
              <option value="all">الكل</option>
              <option value="أرمل">أرمل / أرملة</option>
              <option value="مطلق">مطلق / مطلقة</option>
              <option value="أعزب">أعزب / عزباء</option>
            </select>
          </div>
        </div>
      </aside>

      <div class="flex-1">
        <div id="casesGrid" class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
          <div class="case-card bg-white dark:bg-slate-900 rounded-xl overflow-hidden border border-slate-200 dark:border-slate-800" data-name="سالي محمد" data-cat="يتيم" data-age="young" data-social="أعزب">
            <img class="w-full h-48 object-mediam" src="assets/img/girl.jpg">
            <div class="p-5">
              <h3 class="font-bold">سالي محمد (22 سنة)</h3>
              <p class="desc text-sm line-clamp-custom mb-4">طالبة جامعية متفوقة فقدت معيلها، تحتاج للمساعدة في توفير الرسوم الدراسية لإكمال عامها الأخير في كلية الطب.</p>
              <a href="{{url('case1')}}" class="block text-center w-full bg-slate-100 py-2.5 rounded-lg font-bold hover:bg-blue-600 hover:text-white transition">عرض التفاصيل</a>
            </div>
          </div>
          <div class="case-card bg-white dark:bg-slate-900 rounded-xl overflow-hidden border border-slate-200 dark:border-slate-800" data-name="العم إبراهيم" data-cat="بلا مأوى" data-age="old" data-social="أرمل">
            <img class="w-full h-48 object-cover" src="assets/img/man5 (2).jpg">
            <div class="p-5">
              <h3 class="font-bold">العم إبراهيم (65 سنة)</h3>
              <p class="desc text-sm line-clamp-custom mb-4">يعاني من ظروف معيشية صعبة ويحتاج إلى توفير سكن كريم ورعاية صحية دورية بسبب تقدمه في السن.</p>
              <a href="{{url('case2')}}" class="block text-center w-full bg-slate-100 py-2.5 rounded-lg font-bold hover:bg-blue-600 hover:text-white transition">عرض التفاصيل</a>
            </div>
          </div>
          <div class="case-card bg-white dark:bg-slate-900 rounded-xl overflow-hidden border border-slate-200 dark:border-slate-800" data-name="أحمد سالم" data-cat="حالة طارئة" data-age="adult" data-social="أعزب">
            <img class="w-full h-48 object-cover" src="assets/img/man6.jpg">
            <div class="p-5">
              <h3 class="font-bold">أحمد سالم (29 سنة)</h3>
              <p class="desc text-sm line-clamp-custom mb-4">يحتاج لعملية جراحية عاجلة في القلب. الحالة متأخرة وتتطلب تدخلاً طبياً سريعاً في إحدى المستشفيات المتخصصة.</p>
              <a href="{{url('case3')}}" class="block text-center w-full bg-slate-100 py-2.5 rounded-lg font-bold hover:bg-blue-600 hover:text-white transition">عرض التفاصيل</a>
            </div>
          </div>
          <div class="case-card bg-white dark:bg-slate-900 rounded-xl overflow-hidden border border-slate-200 dark:border-slate-800" data-name="فاطمة محمد" data-cat="مطلق" data-age="adult" data-social="مطلق">
            <img class="w-full h-48 object-cover" src="assets/img/mam2.jpg">
            <div class="p-5">
              <h3 class="font-bold">فاطمة محمد (37 سنة)</h3>
              <p class="desc text-sm line-clamp-custom mb-4">أم لثلاثة أطفال تسعى لتوفير دخل مستدام من خلال مشروع صغير لبيع المشغولات اليدوية وتحتاج لرأس مال بسيط.</p>
              <a href="{{url('case4')}}" class="block text-center w-full bg-slate-100 py-2.5 rounded-lg font-bold hover:bg-blue-600 hover:text-white transition">عرض التفاصيل</a>
            </div>
          </div>
          <div class="case-card bg-white dark:bg-slate-900 rounded-xl overflow-hidden border border-slate-200 dark:border-slate-800" data-name="اياد علي" data-cat="يتيم" data-age="child" data-social="أعزب">
            <img class="w-full h-48 object-cover" src="assets/img/man3.jpg">
            <div class="p-5">
              <h3 class="font-bold">اياد علي (17 سنة)</h3>
              <p class="desc text-sm line-clamp-custom mb-4">شاب فقد عائلته ويسعى لتعلم حرفة النجارة ليتمكن من الاعتماد على نفسه، يحتاج لدعم في تكاليف الدورة التدريبية.</p>
              <a href="{{url('case5')}}" class="block text-center w-full bg-slate-100 py-2.5 rounded-lg font-bold hover:bg-blue-600 hover:text-white transition">عرض التفاصيل</a>
            </div>
          </div>
          <div class="case-card bg-white dark:bg-slate-900 rounded-xl overflow-hidden border border-slate-200 dark:border-slate-800" data-name="خالد يوسف" data-cat="حالة طارئة" data-age="adult" data-social="أعزب">
            <img class="w-full h-48 object-cover" src="assets/img/man.jpg">
            <div class="p-5">
              <h3 class="font-bold">خالد يوسف (28 سنة)</h3>
              <p class="desc text-sm line-clamp-custom mb-4">تعرض لحادث سير أفقده القدرة على الحركة بشكل مؤقت، يحتاج لجلسات علاج طبيعي مكثفة للعودة لمزاولة عمله.</p>
              <a href="{{url('case6')}}" class="block text-center w-full bg-slate-100 py-2.5 rounded-lg font-bold hover:bg-blue-600 hover:text-white transition">عرض التفاصيل</a>
            </div>
          </div>
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

    // Close popup with Escape key
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

  <script>
    function toggleDetails(btn) {
      const p = btn.previousElementSibling;
      p.classList.toggle('expanded');
      btn.innerText = p.classList.contains('expanded') ? "إغلاق التفاصيل" : "عرض التفاصيل";
      btn.classList.toggle('bg-primary');
      btn.classList.toggle('text-white');
    }

    function applyLogic() {
      const s = document.getElementById('searchInput').value.toLowerCase();
      const soc = document.getElementById('socialFilter').value;
      const cats = Array.from(document.querySelectorAll('.cat-f:checked')).map(c => c.value);
      const age = document.querySelector('input[name="age"]:checked').value;

      document.querySelectorAll('.case-card').forEach(card => {
        const matchesS = card.getAttribute('data-name').toLowerCase().includes(s);
        const matchesC = cats.length === 0 || cats.includes(card.getAttribute('data-cat'));
        const matchesA = age === 'all' || card.getAttribute('data-age') === age;
        const matchesSoc = soc === 'all' || card.getAttribute('data-social').includes(soc);

        card.style.display = (matchesS && matchesC && matchesA && matchesSoc) ? 'block' : 'none';
      });
    }

    function resetFilters() {
      document.getElementById('searchInput').value = '';
      document.getElementById('socialFilter').value = 'all';
      document.querySelectorAll('.cat-f').forEach(c => c.checked = false);
      document.querySelector('input[value="all"]').checked = true;
      applyLogic();
    }
  </script>
</body>

</html>