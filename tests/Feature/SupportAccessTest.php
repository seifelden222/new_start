<?php

use App\Models\CharityCase;
use App\Models\User;

test('guests cannot access cases or services pages', function () {
    $case = CharityCase::create([
        'title' => 'حالة اختبار',
        'description' => 'وصف الحالة',
        'category' => 'طبية',
        'status' => 'عاجلة',
        'target_amount' => 1000,
        'collected_amount' => 200,
    ]);

    $this->get(route('caseslist'))->assertRedirect(route('login'));
    $this->get(route('cases.urgent'))->assertRedirect(route('login'));
    $this->get(route('donation'))->assertRedirect(route('login'));
    $this->get(route('cases.show', $case))->assertRedirect(route('login'));
});

test('authenticated users can access protected support pages', function () {
    $user = User::factory()->create();

    $case = CharityCase::create([
        'title' => 'حالة نشطة',
        'description' => 'وصف الحالة النشطة',
        'category' => 'سكن',
        'status' => 'نشطة',
        'target_amount' => 5000,
        'collected_amount' => 1500,
    ]);

    $this->actingAs($user)->get(route('caseslist'))
        ->assertOk()
        ->assertSee('صفحة الحالات متاحة فقط للمستخدمين المسجلين')
        ->assertSee('حالة نشطة');

    $this->actingAs($user)->get(route('cases.urgent'))
        ->assertOk()
        ->assertSee('قسم مستقل للحالات العاجلة داخل النظام');

    $this->actingAs($user)->get(route('donation'))
        ->assertOk()
        ->assertSee($user->name)
        ->assertSee('خدماتنا مرتبطة بحسابك الحالي بالكامل');

    $this->actingAs($user)->get(route('cases.show', $case))
        ->assertOk()
        ->assertSee('حالة نشطة');
});
