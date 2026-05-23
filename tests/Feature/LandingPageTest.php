<?php

use App\Support\LocalizedRoute;
use App\Services\TurnstileService;
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

test('landing page loads in english', function () {
    $this->followingRedirects()
        ->get('/en')
        ->assertStatus(200)
        ->assertSee('The art of')
        ->assertSee('crafting software')
        ->assertSee('AcuarelaSoft')
        ->assertSee('Solutions we build')
        ->assertSee('Request Free Consultation');
});

test('english url stores selected language in session', function () {
    $this->get('/en')
        ->assertOk()
        ->assertSessionHas('lang', 'en');
});

test('public landing page locale is determined by url instead of session', function () {
    $this->withSession(['lang' => 'en'])
        ->get('/')
        ->assertStatus(200)
        ->assertSee('El arte de')
        ->assertSee('crear software');

    $this->withSession(['lang' => 'es'])
        ->get('/en')
        ->assertStatus(200)
        ->assertSee('The art of')
        ->assertSee('crafting software');
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
        ->assertSee('"@type": "Organization"', false)
        ->assertSee('"@type": "WebSite"', false)
        ->assertSee('"name": "AcuarelaSoft"', false);
});

test('landing page contains hreflang tags', function () {
    $this->get('/')
        ->assertStatus(200)
        ->assertSee('hreflang="es-MX"', false)
        ->assertSee('hreflang="en"', false)
        ->assertSee('hreflang="x-default"', false);
});

test('landing page language switcher uses localized urls', function () {
    $this->get('/')
        ->assertStatus(200)
        ->assertSee('href="'.LocalizedRoute::route('home', [], 'es').'"', false)
        ->assertSee('href="'.LocalizedRoute::route('home', [], 'en').'"', false);
});

test('landing page outputs locale-specific canonical and alternate urls', function () {
    $this->get('/')
        ->assertSuccessful()
        ->assertSee('<html lang="es-MX">', false)
        ->assertSee('rel="canonical" href="'.LocalizedRoute::route('home', [], 'es').'"', false)
        ->assertSee('hreflang="es-MX" href="'.LocalizedRoute::route('home', [], 'es').'"', false)
        ->assertSee('hreflang="en" href="'.LocalizedRoute::route('home', [], 'en').'"', false);

    $this->get('/en')
        ->assertSuccessful()
        ->assertSee('<html lang="en">', false)
        ->assertSee('rel="canonical" href="'.LocalizedRoute::route('home', [], 'en').'"', false)
        ->assertSee('hreflang="es-MX" href="'.LocalizedRoute::route('home', [], 'es').'"', false)
        ->assertSee('hreflang="en" href="'.LocalizedRoute::route('home', [], 'en').'"', false);
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
        ->assertSee('href="'.LocalizedRoute::route('home', [], 'es').'#contacto"', false)
        ->assertSee('href="'.LocalizedRoute::route('intake', [], 'es').'"', false);
});

test('english service page cta points to english landing contact form', function () {
    $this->get('/en/services/web-apps')
        ->assertStatus(200)
        ->assertSee('href="'.LocalizedRoute::route('home', [], 'en').'#contacto"', false)
        ->assertSee('href="'.LocalizedRoute::route('intake', [], 'en').'"', false);
});

test('service page company footer links point to spanish landing sections', function () {
    $this->get('/servicios/web-design')
        ->assertStatus(200)
        ->assertSee('href="'.LocalizedRoute::route('home', [], 'es').'#servicios"', false)
        ->assertSee('href="'.LocalizedRoute::route('home', [], 'es').'#por-que-nosotros"', false)
        ->assertSee('href="'.LocalizedRoute::route('home', [], 'es').'#contacto"', false);
});

test('english service page company footer links point to english landing sections', function () {
    $this->get('/en/services/web-apps')
        ->assertStatus(200)
        ->assertSee('href="'.LocalizedRoute::route('home', [], 'en').'#servicios"', false)
        ->assertSee('href="'.LocalizedRoute::route('home', [], 'en').'#por-que-nosotros"', false)
        ->assertSee('href="'.LocalizedRoute::route('home', [], 'en').'#contacto"', false);
});

test('landing footer lists links for all spanish services', function () {
    $response = $this->get('/');

    $response->assertStatus(200);

    foreach (config('site_services') as $service) {
        $response->assertSee(LocalizedRoute::route('service', ['service' => $service['slug']], 'es'), false);
    }
});

test('landing footer lists links for all english services', function () {
    $response = $this->get('/en');

    $response->assertStatus(200);

    foreach (config('site_services') as $service) {
        $response->assertSee(LocalizedRoute::route('service', ['service' => $service['slug']], 'en'), false);
    }
});

test('legacy public urls redirect to spanish canonical urls', function () {
    $this->get('/services/web-design')
        ->assertRedirect(LocalizedRoute::route('service', ['service' => 'web-design'], 'es'));

    $this->get('/intake')
        ->assertRedirect(LocalizedRoute::route('intake', [], 'es'));

    $this->get('/intake/thanks')
        ->assertRedirect(LocalizedRoute::route('intake.thanks', [], 'es'));
});

test('sitemap exposes canonical public urls for both locales', function () {
    $response = $this->get('/sitemap.xml');

    $response->assertSuccessful()
        ->assertSee(LocalizedRoute::route('home', [], 'es'), false)
        ->assertSee(LocalizedRoute::route('home', [], 'en'), false)
        ->assertSee(LocalizedRoute::route('intake', [], 'es'), false)
        ->assertSee(LocalizedRoute::route('intake', [], 'en'), false)
        ->assertSee(LocalizedRoute::route('service', ['service' => 'web-design'], 'es'), false)
        ->assertSee(LocalizedRoute::route('service', ['service' => 'web-design'], 'en'), false)
        ->assertDontSee(LocalizedRoute::route('intake.thanks', [], 'es'), false)
        ->assertDontSee(LocalizedRoute::route('intake.thanks', [], 'en'), false);
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
        ->get('/en')
        ->assertStatus(200)
        ->assertSee('Thank you! We\'ve received your request. We\'ll contact you within 24 hours to confirm your call.')
        ->assertSee('Dismiss notification');

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
