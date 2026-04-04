<?php

test('registration screen can be rendered', function () {
    $response = $this->get('/register');

    $response->assertStatus(200);
});

test('new users can register', function () {
    $response = $this->post('/register', [
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
    ]);

    $this->assertAuthenticated();
    $response->assertRedirect(route('userdashboard', absolute: false));
});

test('newly registered user sees their name on the dashboard', function () {
    $this->post('/register', [
        'name' => 'Mai Real Name',
        'email' => 'mai@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
    ]);

    $this->assertAuthenticated();

    $this->get(route('userdashboard'))
        ->assertOk()
        ->assertSee('Mai Real Name')
        ->assertDontSee('أهلاً بكِ👋');
});
