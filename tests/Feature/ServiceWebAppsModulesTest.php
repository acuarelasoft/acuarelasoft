<?php

use function Pest\Laravel\get;

test('web-apps service page renders the modules catalog', function () {
    get('/servicios/web-apps')
        ->assertSuccessful()
        ->assertSee(__('intake.hero_title'))
        ->assertSee(__('intake.categories.platform'))
        ->assertSee(__('intake.modules.portal-cliente-selfservice.label'))
        ->assertDontSee('wire:submit');
});

test('other service pages do not render the modules catalog', function () {
    get('/servicios/diseno-web')
        ->assertSuccessful()
        ->assertDontSee(__('intake.hero_title'));
});

test('legacy modules urls no longer exist', function () {
    get('/modulos')->assertNotFound();
    get('/modulos/gracias')->assertNotFound();
    get('/intake')->assertNotFound();
    get('/intake/thanks')->assertNotFound();
});
