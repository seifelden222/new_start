<?php

test('signup alias redirects to register page', function () {
    $this->get('/signup')->assertRedirect('/register');
});

test('public support pages are available', function () {
    $this->get(route('contactus'))->assertOk();
    $this->get(route('privacy'))->assertOk();
    $this->get(route('vocationaltraining'))->assertOk();
});
