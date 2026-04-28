<?php

use Illuminate\Support\Facades\Mail;

test('landing page loads in spanish by default', function () {
    $this->get('/')
        ->assertStatus(200)
        ->assertSee('El arte de crear software a tu medida')
        ->assertSee('AcuarelaSoft')
        ->assertSee('Solicitar Consulta Gratuita');
});

test('landing page loads in english', function () {
    $this->get('/en')
        ->assertStatus(200)
        ->assertSee('The art of crafting custom software')
        ->assertSee('AcuarelaSoft')
        ->assertSee('Request Free Consultation');
});

test('landing page contains all main sections in spanish', function () {
    $this->get('/')
        ->assertStatus(200)
        ->assertSee('¿Tu proyecto necesita más que solo código?')
        ->assertSee('Nuestros servicios')
        ->assertSee('Así trabajamos contigo')
        ->assertSee('¿Por qué elegirnos?')
        ->assertSee('Cuéntanos sobre tu proyecto');
});

test('landing page contains json-ld structured data', function () {
    $this->get('/')
        ->assertStatus(200)
        ->assertSee('"@type": "Organization"', false)
        ->assertSee('"@type": "WebSite"', false)
        ->assertSee('"name": "AcuarelaSoft"', false);
});

test('landing page contains hreflang tags', function () {
    $this->get('/')
        ->assertStatus(200)
        ->assertSee('hreflang="es"', false)
        ->assertSee('hreflang="en"', false)
        ->assertSee('hreflang="x-default"', false);
});

test('contact form rejects invalid data', function () {
    $this->post(route('contact.submit'), [])
        ->assertSessionHasErrors(['name', 'email', 'project_type', 'message']);
});

test('contact form rejects invalid project type', function () {
    $this->post(route('contact.submit'), [
        'name' => 'Test User',
        'email' => 'test@example.com',
        'project_type' => 'invalid',
        'message' => 'Test message',
    ])->assertSessionHasErrors('project_type');
});

test('contact form submits successfully with valid data', function () {
    Mail::fake();

    $this->post(route('contact.submit'), [
        'name' => 'Test User',
        'email' => 'test@example.com',
        'project_type' => 'new',
        'message' => 'I need a web application for my business.',
    ])
        ->assertRedirect()
        ->assertSessionHas('success');
});

test('contact form honeypot blocks spam', function () {
    Mail::fake();

    $this->post(route('contact.submit'), [
        'name' => 'Spammer',
        'email' => 'spam@example.com',
        'project_type' => 'new',
        'message' => 'Buy cheap stuff!',
        'website' => 'http://spam.com',
    ])->assertRedirect();

    Mail::assertNothingSent();
});

test('contact form is rate limited', function () {
    Mail::fake();

    $data = [
        'name' => 'Test',
        'email' => 'test@example.com',
        'project_type' => 'new',
        'message' => 'Test message for rate limiting.',
    ];

    for ($i = 0; $i < 5; $i++) {
        $this->post(route('contact.submit'), $data);
    }

    $this->post(route('contact.submit'), $data)
        ->assertStatus(429);
});
