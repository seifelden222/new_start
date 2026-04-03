<?php

use App\Models\User;

test('admin pages render a post logout form', function (string $routeName) {
    $admin = User::factory()->admin()->create();

    $response = $this
        ->actingAs($admin)
        ->get(route($routeName));

    $response
        ->assertSuccessful()
        ->assertSee('id="logout-form"', false)
        ->assertSee('method="POST"', false)
        ->assertSee(route('logout', absolute: false), false)
        ->assertSee("document.getElementById('logout-form').submit()", false);
})->with([
    'admin dashboard' => 'admindashboard',
    'add case' => 'addcase',
    'case manage' => 'casemanage',
    'donors' => 'donors',
    'orders' => 'orders',
    'reports' => 'reports',
]);
