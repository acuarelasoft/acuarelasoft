<?php

use App\Support\LocalizedRoute;

test('diseno-web page loads successfully', function () {
    $this->get('/servicios/diseno-web')
        ->assertSuccessful()
        ->assertSee(__('services.web_design.badge'))
        ->assertSee(__('services.web_design.title'));
});

test('old english-style web-design slug no longer resolves', function () {
    $this->get('/servicios/web-design')->assertNotFound();
});

test('diseno-web page shows the 3-part offering with pricing', function () {
    $this->get('/servicios/diseno-web')
        ->assertSuccessful()
        ->assertSee(__('services.web_design.offering_title'))
        ->assertSee(__('services.web_design.step_design_title'))
        ->assertSee(__('services.web_design.step_design_price'))
        ->assertSee(__('services.web_design.step_photo_title'))
        ->assertSee(__('services.web_design.step_photo_price'))
        ->assertSee(__('services.web_design.step_photo_badge'))
        ->assertSee(__('services.web_design.step_hosting_title'))
        ->assertSee(__('services.web_design.step_hosting_price_monthly'))
        ->assertSee(__('services.web_design.step_hosting_price_annual'));
});

test('diseno-web page still renders the shared tech stack and related services sections', function () {
    $this->get('/servicios/diseno-web')
        ->assertSuccessful()
        ->assertSee(__('services.tech_title'))
        ->assertSee(__('services.related_title'));
});

test('diseno-web page resolves its title and canonical url via laravel head', function () {
    $this->get('/servicios/diseno-web')
        ->assertSuccessful()
        ->assertSee('<title>'.__('services.web_design.meta_title').'</title>', false)
        ->assertSee('rel="canonical" href="'.LocalizedRoute::route('service', ['service' => 'diseno-web']).'"', false);
});

test('diseno-web page includes breadcrumbs structured data', function () {
    $this->get('/servicios/diseno-web')
        ->assertSuccessful()
        ->assertSee('"@type":"BreadcrumbList"', false)
        ->assertSee(__('services.web_design.badge'));
});
