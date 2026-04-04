<?php

use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

test('profile page is displayed', function () {
    $user = User::factory()->create();

    $response = $this
        ->actingAs($user)
        ->get('/settings');

    $response->assertOk();
});

test('legacy profile route redirects to settings page', function () {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->get('/profile')
        ->assertRedirect('/settings');
});

test('profile information can be updated', function () {
    $user = User::factory()->create();

    $response = $this
        ->actingAs($user)
        ->patch('/settings', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'address' => 'Cairo',
        ]);

    $response
        ->assertSessionHasNoErrors()
        ->assertRedirect('/settings');

    $user->refresh();

    $this->assertSame('Test User', $user->name);
    $this->assertSame('test@example.com', $user->email);
    $this->assertSame('Cairo', $user->address);
    $this->assertNull($user->email_verified_at);
});

test('profile photo can be uploaded', function () {
    Storage::fake('public');

    $user = User::factory()->create();

    $response = $this
        ->actingAs($user)
        ->patch('/settings', [
            'name' => $user->name,
            'email' => $user->email,
            'address' => 'Cairo',
            'profile_photo' => UploadedFile::fake()->image('avatar.png'),
        ]);

    $response
        ->assertSessionHasNoErrors()
        ->assertRedirect('/settings');

    $user->refresh();

    expect($user->profile_photo_path)->not->toBeNull();
    Storage::disk('public')->assertExists($user->profile_photo_path);

    $this->actingAs($user)
        ->get(route('users.avatar', $user))
        ->assertOk();
});

test('email verification status is unchanged when the email address is unchanged', function () {
    $user = User::factory()->create();

    $response = $this
        ->actingAs($user)
        ->patch('/settings', [
            'name' => 'Test User',
            'email' => $user->email,
        ]);

    $response
        ->assertSessionHasNoErrors()
        ->assertRedirect('/settings');

    $this->assertNotNull($user->refresh()->email_verified_at);
});

test('user can delete their account', function () {
    $user = User::factory()->create();

    $response = $this
        ->actingAs($user)
        ->delete('/settings', [
            'password' => 'password',
        ]);

    $response
        ->assertSessionHasNoErrors()
        ->assertRedirect('/');

    $this->assertGuest();
    $this->assertNull($user->fresh());
});

test('correct password must be provided to delete account', function () {
    $user = User::factory()->create();

    $response = $this
        ->actingAs($user)
        ->from('/settings')
        ->delete('/settings', [
            'password' => 'wrong-password',
        ]);

    $response
        ->assertSessionHasErrorsIn('userDeletion', 'password')
        ->assertRedirect('/settings');

    $this->assertNotNull($user->fresh());
});
