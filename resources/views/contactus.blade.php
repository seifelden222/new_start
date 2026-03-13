<!DOCTYPE html>
<html dir="rtl" lang="ar">

<head>
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>بداية جديدة - اتصل بنا</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;700;900&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" rel="stylesheet" />
    <style>
        body {
            font-family: 'Cairo', sans-serif;
        }

        .image-overlay {
            background: linear-gradient(to bottom, rgba(30, 58, 138, 0.75), rgba(2, 6, 23, 0.9));
        }

        .input-error {
            border-color: #ef4444 !important;
            background-color: #fef2f2 !important;
        }

        .error-msg {
            color: #ef4444;
            font-size: 10px;
            font-weight: 800;
            margin-top: 4px;
            display: none;
        }

        #toast {
            visibility: hidden;
            min-width: 300px;
            background-color: #10b981;
            color: white;
            text-align: center;
            border-radius: 50px;
            padding: 20px;
            position: fixed;
            z-index: 1000;
            left: 50%;
            bottom: 40px;
            transform: translateX(-50%);
            font-weight: 900;
            box-shadow: 0 10px 20px rgba(16, 185, 129, 0.3);
        }

        #toast.show {
            visibility: visible;
            animation: fadein 0.5s, fadeout 0.5s 2.5s;
        }

        @keyframes fadein {
            from {
                bottom: 0;
                opacity: 0;
            }

            to {
                bottom: 40px;
                opacity: 1;
            }
        }

        @keyframes fadeout {
            from {
                bottom: 40px;
                opacity: 1;
            }

            to {
                bottom: 0;
                opacity: 0;
            }
        }
    </style>
</head>

<body class="bg-slate-100 min-h-screen flex flex-col">

    <div id="toast">تم إرسال رسالتك بنجاح.. تسلم إيدك! ✉️</div>

    <header class="w-full bg-[#020617] text-white py-6 px-10 flex justify-between items-center shadow-2xl z-50">
        <div class="flex items-center gap-3">
            <img src="assets/img/logo.jpeg" alt="Logo" class="w-12 h-12 rounded-lg border border-white/20">
            <span class="text-2xl font-black  tracking-tighter">بداية <span class="text-blue-500">جديدة</span></span>
        </div>
        <nav class="hidden md:flex items-center gap-10">
            <a class="text-slate-300 hover:text-white font-medium transition-all relative after:content-[''] after:absolute after:w-0 after:h-0.5 after:bg-blue-500 after:bottom-[-4px] after:right-0 hover:after:w-full after:transition-all" href="index.html">الرئيسية</a>
        </nav>

    </header>

    <main class="flex-grow flex items-center justify-center p-4">
        <div class="flex flex-col md:flex-row w-full max-w-5xl bg-white rounded-[3rem] overflow-hidden shadow-2xl border border-slate-100">

            <div class="md:w-1/2 relative min-h-[400px] flex flex-col justify-center items-center text-center p-12 text-white overflow-hidden">
                <img src="assets/img/child.jpg" alt="Contact Support" class="absolute inset-0 w-full h-full object-cover">
                <div class="absolute inset-0 image-overlay"></div>
                <div class="relative z-10">
                    <span class="material-symbols-outlined text-6xl mb-6 text-blue-400">support_agent</span>
                    <h2 class="text-5xl font-black mb-6 tracking-tight">إحنا هنا ليك</h2>
                    <p class="text-lg text-blue-50 font-medium mb-10 leading-relaxed">عندك استفسار؟ فريقنا جاهز للرد.</p>
                </div>
            </div>

            <div class="md:w-1/2 p-12 md:p-16 flex flex-col justify-center bg-white">
                <div class="mb-12 text-right">
                    <h1 class="text-3xl font-black text-slate-800 tracking-tight">تواصل معنا</h1>
                    <div class="h-1.5 w-16 bg-blue-600 mt-4 rounded-full"></div>
                </div>

                <form id="contactForm" class="space-y-6 text-right" onsubmit="handleContact(event)">
                    <div class="space-y-2">
                        <label class="text-[11px] font-black text-slate-400 uppercase tracking-widest mr-1">الاسم الكامل</label>
                        <input type="text" id="nameInp" placeholder="اكتب اسمك (حروف فقط)" required
                            class="w-full px-6 py-6 rounded-2xl border border-slate-100 bg-slate-50/50 outline-none transition-all font-bold text-slate-700 shadow-sm focus:border-blue-500">
                        <p id="nameError" class="error-msg mr-2">الاسم يجب أن يحتوي على حروف فقط</p>
                    </div>

                    <div class="space-y-2">
                        <label class="text-[11px] font-black text-slate-400 uppercase tracking-widest mr-1">البريد الإلكتروني</label>
                        <input type="text" id="emailInp" placeholder="name@example.com" required
                            class="w-full px-6 py-6 rounded-2xl border border-slate-100 bg-slate-50/50 outline-none transition-all font-bold text-slate-700 shadow-sm focus:border-blue-500">
                        <p id="emailError" class="error-msg mr-2">يرجى إدخال بريد إلكتروني صحيح (مثال: name@gmail.com)</p>
                    </div>

                    <div class="space-y-2">
                        <label class="text-[11px] font-black text-slate-400 uppercase tracking-widest mr-1">رسالتك</label>
                        <textarea rows="3" id="messageInp" placeholder="كيف يمكننا مساعدتك؟" required
                            class="w-full px-6 py-6 rounded-2xl border border-slate-100 bg-slate-50/50 outline-none transition-all font-bold text-slate-700 shadow-sm focus:border-blue-500 resize-none"></textarea>
                    </div>

                    <div class="pt-4">
                        <button type="submit" class="w-full bg-blue-700 hover:bg-blue-800 text-white py-5 rounded-2xl font-black text-lg shadow-2xl transition-all active:scale-[0.97] flex items-center justify-center gap-3">
                            <span>إرسال الرسالة</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <footer class="w-full bg-[#020617] text-white/40 py-10 px-10 flex flex-col md:flex-row justify-between items-center gap-6 text-xs font-bold border-t border-white/5">
        <div class="flex items-center gap-3">
            <span class="material-symbols-outlined text-blue-500">volunteer_activism</span>
            <p>© 2026 منصة بداية جديدة. يد واحدة لمستقبل أفضل.</p>
        </div>
        <div class="flex gap-10">
            <a href="privacy.html" class="hover:text-blue-400 transition-colors">سياسة الخصوصية</a>
        </div>
    </footer>

    <script>
        function isStrictEmail(email) {
            const pattern = /^[^\s@]+@[a-zA-Z]+\.[a-zA-Z]{2,}$/;
            return pattern.test(email);
        }


        document.getElementById('nameInp').addEventListener('input', function() {
            const nameRegex = /^[a-zA-Z\s\u0600-\u06FF]+$/;
            if (!nameRegex.test(this.value) && this.value !== "") {
                this.classList.add('input-error');
                document.getElementById('nameError').style.display = 'block';
            } else {
                this.classList.remove('input-error');
                document.getElementById('nameError').style.display = 'none';
            }
        });


        document.getElementById('emailInp').addEventListener('input', function() {
            const val = this.value.trim();
            if (!isStrictEmail(val) && val !== "") {
                this.classList.add('input-error');
                document.getElementById('emailError').style.display = 'block';
            } else {
                this.classList.remove('input-error');
                document.getElementById('emailError').style.display = 'none';
            }
        });

        function handleContact(e) {
            e.preventDefault();
            const nameValue = document.getElementById('nameInp').value;
            const emailValue = document.getElementById('emailInp').value.trim();
            const nameRegex = /^[a-zA-Z\s\u0600-\u06FF]+$/;

            if (nameRegex.test(nameValue) && isStrictEmail(emailValue)) {
                const toast = document.getElementById("toast");
                toast.className = "show";
                setTimeout(() => {
                    toast.className = toast.className.replace("show", "");
                    document.getElementById('contactForm').reset();

                    document.getElementById('emailInp').classList.remove('input-success');
                    document.getElementById('nameInp').classList.remove('input-success');
                }, 3000);
            } else {
                alert('يرجى التأكد من البيانات (الاسم حروف، والبريد بصيغة صحيحة)');
            }
        }
    </script>
</body>

</html>