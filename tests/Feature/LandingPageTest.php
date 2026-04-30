<?php

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
    $this->get('/en')
        ->assertStatus(200)
        ->assertSee('The art of')
        ->assertSee('crafting software')
        ->assertSee('AcuarelaSoft')
        ->assertSee('Solutions we build')
        ->assertSee('Request Free Consultation');
});

test('landing page contains all main sections in spanish', function () {
    $this->get('/')
        ->assertStatus(200)
        ->assertSee('¿Tu proyecto necesita más que solo código?')
        ->assertSee('Nuestros servicios')
        ->assertSee('Soluciones que construimos')
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

test('service page cta points to spanish landing contact form', function () {
    $this->get('/servicios/diseno-web')
        ->assertStatus(200)
        ->assertSee('href="'.route('home').'#contacto"', false);
});

test('english service page cta points to english landing contact form', function () {
    $this->get('/en/services/web-apps')
        ->assertStatus(200)
        ->assertSee('href="'.route('home.en').'#contacto"', false);
});

test('service page company footer links point to spanish landing sections', function () {
    $this->get('/servicios/diseno-web')
        ->assertStatus(200)
        ->assertSee('href="'.route('home').'#servicios"', false)
        ->assertSee('href="'.route('home').'#por-que-nosotros"', false)
        ->assertSee('href="'.route('home').'#contacto"', false);
});

test('english service page company footer links point to english landing sections', function () {
    $this->get('/en/services/web-apps')
        ->assertStatus(200)
        ->assertSee('href="'.route('home.en').'#servicios"', false)
        ->assertSee('href="'.route('home.en').'#por-que-nosotros"', false)
        ->assertSee('href="'.route('home.en').'#contacto"', false);
});

test('landing footer lists links for all spanish services', function () {
    $response = $this->get('/');

    $response->assertStatus(200);

    foreach (config('site_services') as $service) {
        $response->assertSee(route('service', ['service' => $service['slug']]), false);
    }
});

test('landing footer lists links for all english services', function () {
    $response = $this->get('/en');

    $response->assertStatus(200);

    foreach (config('site_services') as $service) {
        $response->assertSee(route('service.en', ['service' => $service['slug']]), false);
    }
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
