<?php

use App\Models\User;

test('settings page displays authenticated user data', function () {
    $user = User::factory()->create([
        'name' => 'Ahmed Ali',
        'email' => 'ahmed@example.com',
        'address' => 'Cairo',
    ]);

    $response = $this
        ->actingAs($user)
        ->get(route('settings'));

    $response
        ->assertOk()
        ->assertSee('Ahmed Ali')
        ->assertSee('ahmed@example.com')
        ->assertSee('Cairo')
        ->assertDontSee('مي محمد')
        ->assertDontSee('mai.mohamed@example.com');
});
