<?php

test('registration screen can be rendered', function () {
    $response = $this->get('/register');

    $response->assertOk()
        ->assertSee('نوع الحساب')
        ->assertSee('متبرع')
        ->assertSee('موظف')
        ->assertSee('أخصائي');
});

test('new users can register', function () {
    $response = $this->post('/register', [
        'name' => 'Test User',
        'email' => 'test@gmail.com',
        'account_type' => 'donor',
        'password' => 'Password1',
        'password_confirmation' => 'Password1',
    ]);

    $this->assertAuthenticated();
    $response->assertRedirect(route('userdashboard', absolute: false));
    expect(auth()->user()->account_type)->toBe('donor');
});

test('newly registered user sees their name on the dashboard', function () {
    $this->post('/register', [
        'name' => 'Mai Real Name',
        'email' => 'mai@gmail.com',
        'account_type' => 'specialist',
        'password' => 'Password1',
        'password_confirmation' => 'Password1',
    ]);

    $this->assertAuthenticated();

    $this->get(route('userdashboard'))
        ->assertOk()
        ->assertSee('Mai Real Name')
        ->assertSee('أخصائي')
        ->assertDontSee('أهلاً بكِ👋');
});

test('registration rejects weak passwords and missing account type', function () {
    $response = $this->from('/register')->post('/register', [
        'name' => 'Weak User',
        'email' => 'weak@gmail.com',
        'password' => '12345678',
        'password_confirmation' => '12345678',
    ]);

    $response->assertRedirect('/register');
    $response->assertSessionHasErrors(['account_type', 'password']);
    $this->assertGuest();
});
