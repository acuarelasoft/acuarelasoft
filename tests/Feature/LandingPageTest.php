<?php

use App\Services\TurnstileService;
use App\Support\LocalizedRoute;
use Illuminate\Support\Facades\Mail;

test('landing page loads in spanish by default', function () {
    $this->get('/')
        ->assertStatus(200)
        ->assertSee('El arte de')
        ->assertSee('crear software')
        ->assertSee('AcuarelaSoft')
        ->assertSee('Soluciones que construimos')
        ->assertSee('Solicitar Consulta Gratuita');
});

test('public landing page always renders in spanish regardless of session', function () {
    $this->withSession(['lang' => 'en'])
        ->get('/')
        ->assertStatus(200)
        ->assertSee('El arte de')
        ->assertSee('crear software');
});

test('landing page contains all main sections in spanish', function () {
    $this->get('/')
        ->assertStatus(200)
        ->assertSee('¿Tu proyecto necesita más que solo código?')
        ->assertSee('Nuestros servicios')
        ->assertSee('Soluciones que construimos')
        ->assertSee('Así trabajamos contigo')
        ->assertSee('¿Por qué elegirnos?')
        ->assertSee('Agenda tu llamada gratuita');
});

test('landing page contains json-ld structured data', function () {
    $this->get('/')
        ->assertStatus(200)
        ->assertSee('"@type":"Organization"', false)
        ->assertSee('"@type":"WebSite"', false)
        ->assertSee('"name":"AcuarelaSoft"', false);
});

test('landing page outputs locale-specific canonical url', function () {
    $this->get('/')
        ->assertSuccessful()
        ->assertSee('<html lang="es-MX">', false)
        ->assertSee('rel="canonical" href="'.LocalizedRoute::route('home').'"', false);
});

test('landing page renders watercolor texture assets', function () {
    $this->get('/')
        ->assertStatus(200)
        ->assertSee(asset('assets/textures/texture.webp'), false)
        ->assertSee(asset('assets/textures/palete.webp'), false)
        ->assertDontSee(asset('assets/textures/texture5.jpg'), false)
        ->assertDontSee(asset('assets/textures/palete.jpg'), false)
        ->assertDontSee(asset('assets/textures/texture6.jpg'), false)
        ->assertDontSee(asset('assets/textures/texture3.jpg'), false)
        ->assertDontSee(asset('assets/textures/texture4.jpg'), false)
        ->assertDontSee(asset('assets/textures/texture1.jpg'), false);
});

test('service page cta points to spanish landing contact form', function () {
    $this->get('/servicios/web-design')
        ->assertStatus(200)
        ->assertSee('href="'.LocalizedRoute::route('home').'#contacto"', false)
        ->assertSee('href="'.LocalizedRoute::route('intake').'"', false);
});

test('service page company footer links point to spanish landing sections', function () {
    $this->get('/servicios/web-design')
        ->assertStatus(200)
        ->assertSee('href="'.LocalizedRoute::route('home').'#servicios"', false)
        ->assertSee('href="'.LocalizedRoute::route('home').'#por-que-nosotros"', false)
        ->assertSee('href="'.LocalizedRoute::route('home').'#contacto"', false);
});

test('landing footer lists links for all spanish services', function () {
    $response = $this->get('/');

    $response->assertStatus(200);

    foreach (config('site_services') as $service) {
        $response->assertSee(LocalizedRoute::route('service', ['service' => $service['slug']]), false);
    }
});

test('legacy public urls no longer exist', function () {
    $this->get('/services/web-design')->assertNotFound();

    $this->get('/intake')->assertNotFound();

    $this->get('/intake/thanks')->assertNotFound();
});

test('sitemap exposes canonical public urls', function () {
    $response = $this->get('/sitemap.xml');

    $response->assertSuccessful()
        ->assertSee(LocalizedRoute::route('home'), false)
        ->assertSee(LocalizedRoute::route('intake'), false)
        ->assertSee(LocalizedRoute::route('service', ['service' => 'web-design']), false);
});

test('robots endpoint references sitemap', function () {
    $this->get('/robots.txt')
        ->assertSuccessful()
        ->assertSee('Sitemap: https://acuarelasoft.dev/sitemap.xml');
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
        ->assertSessionHas('success_key', 'landing.contact_success');
});

test('contact success banner is translated to current page locale', function () {
    $this->withSession(['success_key' => 'landing.contact_success'])
        ->get('/')
        ->assertStatus(200)
        ->assertSee('¡Gracias! Hemos recibido tu solicitud. Te contactaremos en menos de 24 horas para confirmar tu llamada.')
        ->assertSee('Cerrar notificacion');
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

test('contact form skips turnstile validation outside production', function () {
    Mail::fake();

    // TurnstileService always returns true outside production — no token needed
    $this->post(route('contact.submit'), [
        'name' => 'Local Dev',
        'email' => 'dev@example.com',
        'project_type' => 'new',
        'message' => 'Testing without captcha in local.',
    ])
        ->assertRedirect()
        ->assertSessionHas('success_key', 'landing.contact_success');
});

test('contact form blocks submission when turnstile fails in production', function () {
    Mail::fake();

    $turnstile = Mockery::mock(TurnstileService::class);
    $turnstile->shouldReceive('verify')->once()->andReturn(false);
    app()->instance(TurnstileService::class, $turnstile);

    $this->post(route('contact.submit'), [
        'name' => 'Bad Actor',
        'email' => 'bad@example.com',
        'project_type' => 'new',
        'message' => 'This should be blocked by captcha.',
        'cf-turnstile-response' => 'invalid-token',
    ])
        ->assertRedirect()
        ->assertSessionHasErrors('cf-turnstile-response');

    Mail::assertNothingSent();
});
