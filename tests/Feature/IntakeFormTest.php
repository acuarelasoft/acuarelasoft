<?php

use App\Mail\IntakeSubmissionConfirmation;
use App\Models\ProjectIntakeSubmission;
use App\Services\TurnstileService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Livewire\Livewire;

use function Pest\Laravel\get;

uses(RefreshDatabase::class);

test('intake page renders in spanish for spanish browser locale', function () {
    get('/intake', ['Accept-Language' => 'es-MX,es;q=0.9,en;q=0.8'])
        ->assertSuccessful()
        ->assertSee('<html lang="es">', false);
});

test('requires at least one module', function () {
    Livewire::test('pages::intake')
        ->set('fullName', 'Jane Doe')
        ->set('email', 'jane@example.com')
        ->set('phone', '+52 5512345678')
        ->set('projectSummary', 'We need to modernize our internal operations with dashboards and automation.')
        ->set('selectedModules', [])
        ->call('submit')
        ->assertHasErrors(['selectedModules' => 'required']);
});

test('stores submission and sends confirmation email', function () {
    Mail::fake();

    Livewire::test('pages::intake')
        ->set('fullName', 'John Client')
        ->set('email', 'john@example.com')
        ->set('phone', '+1 555 232 1212')
        ->set('projectSummary', 'We need a customer portal with subscriptions, invoices, and analytics dashboards.')
        ->set('selectedModules', ['portal-cliente-selfservice', 'suscripciones', 'kpis-dashboards'])
        ->call('submit')
        ->assertRedirect(route('intake.thanks'));

    expect(ProjectIntakeSubmission::query()->count())->toBe(1);

    $submission = ProjectIntakeSubmission::query()->first();

    expect($submission)->not->toBeNull();
    expect($submission->selected_modules)->toBeArray();
    expect($submission->estimate_score)->toBeGreaterThan(0);

    Mail::assertSent(IntakeSubmissionConfirmation::class, function (IntakeSubmissionConfirmation $mail): bool {
        return $mail->hasTo('john@example.com');
    });
});

test('thanks page renders in spanish for spanish browser locale', function () {
    get('/intake/thanks', ['Accept-Language' => 'es-MX,es;q=0.9,en;q=0.8'])
        ->assertSuccessful()
        ->assertSee('<html lang="es">', false);
});

test('intake form skips turnstile validation outside production', function () {
    Mail::fake();

    // No turnstileToken set — TurnstileService always passes outside production
    Livewire::test('pages::intake')
        ->set('fullName', 'Dev User')
        ->set('email', 'dev@example.com')
        ->set('phone', '+52 5500001111')
        ->set('projectSummary', 'A local development submission without captcha token.')
        ->set('selectedModules', ['portal-cliente-selfservice'])
        ->call('submit')
        ->assertRedirect(route('intake.thanks'));
});

test('intake form blocks submission when turnstile fails in production', function () {
    $turnstile = Mockery::mock(TurnstileService::class);
    $turnstile->shouldReceive('verify')->once()->andReturn(false);
    app()->instance(TurnstileService::class, $turnstile);

    // Temporarily fake production to exercise the guard
    app()->bind('env', fn () => 'production');

    Livewire::test('pages::intake')
        ->set('fullName', 'Bad Actor')
        ->set('email', 'bad@example.com')
        ->set('phone', '+52 5500009999')
        ->set('projectSummary', 'This submission should be blocked by captcha.')
        ->set('selectedModules', ['portal-cliente-selfservice'])
        ->set('turnstileToken', 'fake-token')
        ->call('submit')
        ->assertHasErrors('turnstileToken');
});
