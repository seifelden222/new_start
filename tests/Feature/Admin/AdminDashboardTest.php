<?php

use App\Models\User;

test('admin dashboard can be rendered', function () {
    $admin = User::factory()->admin()->create();

    $response = $this
        ->actingAs($admin)
        ->get(route('admindashboard'));

    $response->assertSuccessful();
});
