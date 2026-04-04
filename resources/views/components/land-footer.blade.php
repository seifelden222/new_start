    <footer class="bg-[#020617] text-white py-10">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-12 gap-8">

                <div class="md:col-span-5">
                    <div class="flex items-center gap-2 mb-4">
                        <img src="assets/img/logo.jpeg" alt="Logo" width="50" height="50" class="rounded-xl shadow-lg">
                        <span class="text-xl font-bold tracking-tight text-white">بداية جديدة</span>
                    </div>
                    <p class="leading-relaxed text-white text-sm max-w-sm opacity-90 font-medium">
                        منصة رائدة تهدف إلى تمكين المشردين والأيتام من خلال توفير الدعم النفسي، التدريب المهني، والمأوى الكريم لبناء مستقبل أفضل.
                    </p>
                </div>

                <div class="md:col-span-3">
                    <h4 class="text-base font-bold mb-5 text-white underline decoration-blue-500 underline-offset-8">روابط سريعة</h4>
                    <ul class="space-y-3 text-sm font-bold text-slate-300">
                        <li><a class="hover:text-blue-400 transition-all flex items-center gap-2" href="{{ url('/') }}">الرئيسية</a></li>
                        <li><a class="hover:text-blue-400 transition-all flex items-center gap-2" href="{{ route('caseslist') }}">الحالات العاجلة</a></li>
                        <li><a class="hover:text-blue-400 transition-all flex items-center gap-2" href="{{ route('aboutus') }}">من نحن</a></li>
                        <li><a class="hover:text-blue-400 transition-all flex items-center gap-2" href="{{ route('contactus') }}">اتصل بنا</a></li>
                        <li><a class="hover:text-blue-400 transition-all flex items-center gap-2" href="{{ route('register') }}">انضم كمتطوع</a></li>
                        <li><a class="hover:text-blue-400 transition-all flex items-center gap-2" href="{{ route('privacy') }}">سياسة الخصوصية</a></li>
                    </ul>
                </div>

                <div class="md:col-span-4">
                    <h4 class="text-base font-bold mb-5 text-white underline decoration-blue-500 underline-offset-8">تواصل معنا</h4>
                    <div class="space-y-3 text-sm font-bold text-slate-300">
                        <button onclick="openMapPopup()" class="flex items-center gap-3 hover:text-white transition-all cursor-pointer">
                            <span class="material-symbols-outlined text-blue-400 text-lg">location_on</span>
                            <p>جمهورية مصر العربية</p>
                        </button>
                        <a href="tel:+20123456789" class="flex items-center gap-3 hover:text-white transition-all">
                            <span class="material-symbols-outlined text-blue-400 text-lg">call</span>
                            <p dir="ltr">+20 123 456 789</p>
                        </a>
                        <a href="mailto:info@newbeginning.org" class="flex items-center gap-3 hover:text-white transition-all">
                            <span class="material-symbols-outlined text-blue-400 text-lg">mail</span>
                            <p>info@newbeginning.org</p>
                        </a>

                        <div class="pt-2">
                            <a href="{{ route('contactus') }}" class="inline-flex items-center gap-2 bg-blue-600/10 hover:bg-blue-600 text-blue-400 hover:text-white px-4 py-2 rounded-xl text-[11px] border border-blue-600/20 transition-all">
                                <span class="material-symbols-outlined text-sm font-bold">send</span>
                                ارسل لنا رسالة مباشرة
                            </a>
                        </div>
                    </div>
                </div>

            </div>
            <div class="mt-10 pt-6 border-t border-white/10 text-center">
                <p class="text-white text-[12px] tracking-widest uppercase opacity-80 font-black">© 2026 بداية جديدة. جميع الحقوق محفوظة.</p>
            </div>
        </div>
    </footer>

    <style>
        body.page-is-ready {
            animation: pageFadeIn 0.35s ease-out;
        }

        body.page-is-leaving {
            opacity: 0;
            transform: translateY(8px);
            transition: opacity 0.2s ease, transform 0.2s ease;
        }

        @keyframes pageFadeIn {
            from {
                opacity: 0;
                transform: translateY(8px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            document.body.classList.add('page-is-ready');

            document.querySelectorAll('a[href]').forEach((link) => {
                link.addEventListener('click', (event) => {
                    const href = link.getAttribute('href');

                    if (!href || href.startsWith('#') || href.startsWith('mailto:') || href.startsWith('tel:') || link.target === '_blank') {
                        return;
                    }

                    const destination = new URL(href, window.location.origin);

                    if (destination.origin !== window.location.origin || destination.pathname === window.location.pathname) {
                        return;
                    }

                    event.preventDefault();
                    document.body.classList.add('page-is-leaving');

                    window.setTimeout(() => {
                        window.location.href = destination.toString();
                    }, 180);
                });
            });
        });
    </script>
