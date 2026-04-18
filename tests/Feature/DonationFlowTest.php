<?php

use App\Models\CharityCase;
use App\Models\Donation;
use App\Models\User;

test('wallet can be charged using supported payment methods', function () {
    $user = User::factory()->create(['balance' => 0]);

    $this->actingAs($user)
        ->postJson(route('wallet.charge'), [
            'amount' => 250,
            'payment_method' => 'instapay',
        ])
        ->assertOk()
        ->assertJson([
            'balance' => 250,
            'payment_method' => 'instapay',
        ]);

    expect($user->fresh()->balance)->toBe(250);
});

test('donation is deducted from the authenticated users balance only', function () {
    $user = User::factory()->create(['balance' => 600]);

    $charityCase = CharityCase::create([
        'title' => 'حالة محتاجة دعم',
        'description' => 'وصف',
        'category' => 'طبية',
        'status' => 'عاجلة',
        'target_amount' => 4000,
        'collected_amount' => 500,
    ]);

    $this->actingAs($user)
        ->postJson(route('donate'), [
            'charity_case_id' => $charityCase->id,
            'amount' => 200,
        ])
        ->assertOk()
        ->assertJson([
            'balance' => 400,
        ]);

    $donation = Donation::first();

    expect($donation)->not->toBeNull();
    expect($donation->user_id)->toBe($user->id);
    expect($donation->charity_case_id)->toBe($charityCase->id);
    expect($donation->payment_method)->toBe('wallet');
    expect($charityCase->fresh()->collected_amount)->toBe(700);
});

test('donation fails when balance is insufficient', function () {
    $user = User::factory()->create(['balance' => 50]);

    $charityCase = CharityCase::create([
        'title' => 'حالة أخرى',
        'description' => 'وصف',
        'category' => 'تعليم',
        'status' => 'نشطة',
        'target_amount' => 2000,
        'collected_amount' => 0,
    ]);

    $this->actingAs($user)
        ->postJson(route('donate'), [
            'charity_case_id' => $charityCase->id,
            'amount' => 100,
        ])
        ->assertStatus(422)
        ->assertJson([
            'error' => 'رصيدك غير كافٍ، يرجى شحن المحفظة أولاً',
        ]);

    expect(Donation::count())->toBe(0);
    expect($user->fresh()->balance)->toBe(50);
});
