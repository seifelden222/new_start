<?php

use App\Models\User;

test('dashboard redirects users to the user dashboard', function () {
    $user = User::factory()->create();

    $response = $this
        ->actingAs($user)
        ->get(route('dashboard'));

    $response->assertRedirect(route('userdashboard'));
});

test('dashboard redirects admins to the admin dashboard', function () {
    $admin = User::factory()->admin()->create();

    $response = $this
        ->actingAs($admin)
        ->get(route('dashboard'));

    $response->assertRedirect(route('admindashboard'));
});
