# New Start

منصة Laravel لإدارة التبرعات والحالات الخيرية، مع واجهات منفصلة للمستخدم والأدمن ونظام تسجيل دخول يعتمد على `role`.

## Stack

- PHP 8.4
- Laravel 12
- Laravel Breeze
- Pest
- Vite
- Tailwind CSS

## Features

- تسجيل مستخدم جديد مع تحويل مباشر إلى `userdashboard`
- تسجيل دخول يعتمد على الدور:
  - `admin` يتم تحويله إلى `admindashboard`
  - `user` يتم تحويله إلى `userdashboard`
- صفحات عامة للموقع مثل:
  - الصفحة الرئيسية
  - من نحن
  - اتصل بنا
  - الخصوصية
  - قائمة الحالات
- لوحة مستخدم تشمل:
  - نظرة عامة
  - تبرعاتي
  - الحالات التي أتابعها
  - إعدادات الملف الشخصي
- لوحة أدمن تشمل:
  - نظرة عامة
  - إدارة الحالات
  - طلبات التبرع
  - قائمة المتبرعين
  - التقارير

## Authentication And Roles

جدول `users` يحتوي على حقل `role` بالقيم التالية:

- `admin`
- `user`

السلوك الحالي:

- التسجيل من `register` ينشئ مستخدمًا عاديًا ثم يحوله إلى `userdashboard`
- تسجيل الدخول من `login` يحدد وجهة المستخدم حسب قيمة `role`

## Project Structure

- `app/Http/Controllers/Auth`:
  منطق تسجيل الدخول والتسجيل والخروج
- `app/Models`:
  النماذج الأساسية مثل `User`, `Donors`, `Reports`, `Social_Workers`
- `resources/views/auth`:
  صفحات `login` و`register`
- `resources/views/user`:
  صفحات لوحة المستخدم
- `resources/views/admin`:
  صفحات لوحة الأدمن
- `resources/views/components`:
  المكونات المشتركة مثل:
  - `user-navbar`
  - `user-slider`
  - `admin-navbar`
  - `admin-slider`
- `database/migrations`:
  تعريف الجداول

## Installation

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
npm install
```

## Run Locally

لتشغيل المشروع كاملًا أثناء التطوير:

```bash
composer run dev
```

أو بشكل منفصل:

```bash
php artisan serve
npm run dev
```

## Build Frontend

إذا لم تظهر تغييرات الواجهة:

```bash
npm run build
```

أو أثناء التطوير:

```bash
npm run dev
```

## Testing

تشغيل جميع الاختبارات:

```bash
php artisan test --compact
```

تشغيل اختبارات محددة:

```bash
php artisan test --compact --filter=Authentication
php artisan test --compact --filter=Registration
```

## Notes

- بعض صفحات الأدمن والمستخدم ما زالت تعرض بيانات ثابتة داخل المحتوى نفسه، حتى لو كان الـ navbar والـ sidebar يعتمدان على المستخدم المسجل.
- توجد Models إضافية للجداول المخصصة:
  - `Donors`
  - `Reports`
  - `Social_Workers`
- إذا أردت توسيع المشروع لاحقًا، فالخطوة المنطقية التالية هي:
  - إضافة Middleware حقيقي لحماية مسارات الأدمن حسب `role`
  - ربط صفحات الأدمن والمستخدم ببيانات فعلية من قاعدة البيانات بدل المحتوى الثابت
