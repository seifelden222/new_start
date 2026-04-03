    <header class="sticky top-0 z-50 bg-[#020617]/95 backdrop-blur-md border-b border-white/5 shadow-xl">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">
                <div class="flex items-center gap-4 group cursor-pointer">
                    <div class="relative">
                        <img src="assets/img/logo.jpeg" alt="Logo" width="50" height="50" class="rounded-xl shadow-lg group-hover:scale-105 transition-transform duration-300">
                        <div class="absolute inset-0 bg-blue-500/20 blur-xl rounded-full -z-10 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                    </div>
                    <span class="text-2xl font-bold tracking-tight text-white">بداية <span class="text-blue-500">جديدة</span></span>
                </div>

                <nav class="hidden md:flex items-center gap-10">
                    <a class="text-[#007bff] font-bold" href="{{url('/')}}">الرئيسية</a>
                    <a class="text-slate-300 hover:text-white font-medium transition-all relative after:content-[''] after:absolute after:w-0 after:h-0.5 after:bg-blue-500 after:bottom-[-4px] after:right-0 hover:after:w-full after:transition-all" href="{{url('caseslist')}}">الحالات</a>
                    <a class="text-slate-300 hover:text-white font-medium transition-all relative after:content-[''] after:absolute after:w-0 after:h-0.5 after:bg-blue-500 after:bottom-[-4px] after:right-0 hover:after:w-full after:transition-all" href="{{url('donation')}}">خدمتنا</a>
                    <a class="text-slate-300 hover:text-white font-medium transition-all relative after:content-[''] after:absolute after:w-0 after:h-0.5 after:bg-blue-500 after:bottom-[-4px] after:right-0 hover:after:w-full after:transition-all" href="{{url('aboutus')}}">من نحن</a>
                </nav>

                <div class="flex items-center gap-4">
                    <button class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2.5 rounded-xl font-bold transition-all shadow-lg shadow-blue-500/20 active:scale-95 hidden sm:flex items-center gap-2">
                        <span class="material-symbols-outlined text-[20px]">volunteer_activism</span>
                        <a href="{{route('login')}}"> تسجيل دخول</a>
                    </button>



                    <button class="md:hidden text-white p-2">
                        <span class="material-symbols-outlined">menu</span>
                    </button>
                </div>
            </div>
        </div>
    </header>