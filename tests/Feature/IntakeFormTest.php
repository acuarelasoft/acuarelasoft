<?php

use App\Support\LocalizedRoute;

use function Pest\Laravel\get;

test('intake page renders in spanish for spanish browser locale', function () {
    get('/modulos', ['Accept-Language' => 'es-MX,es;q=0.9,en;q=0.8'])
        ->assertSuccessful()
        ->assertSee('<html lang="es-MX">', false)
        ->assertSee('rel="canonical" href="'.LocalizedRoute::route('intake', [], 'es').'"', false)
        ->assertSee(__('intake.hero_title'))
        ->assertSee(__('intake.categories.platform'));
});

test('intake page is informational and does not expose form submit controls', function () {
    get('/modulos')
        ->assertSuccessful()
        ->assertSee(__('intake.modules.portal-cliente-selfservice.label'))
        ->assertDontSee('wire:submit');
});

test('english intake page uses english canonical and informational content', function () {
    get('/en/intake')
        ->assertSuccessful()
        ->assertSee('<html lang="en">', false)
        ->assertSee('rel="canonical" href="'.LocalizedRoute::route('intake', [], 'en').'"', false)
        ->assertSee(trans('intake.hero_title', [], 'en'));
});

test('legacy thanks urls no longer exist', function () {
    get('/modulos/gracias')->assertNotFound();
    get('/en/intake/thanks')->assertNotFound();
    get('/intake/thanks')->assertNotFound();
});
