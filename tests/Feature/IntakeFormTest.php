<?php

use App\Mail\IntakeSubmissionConfirmation;
use App\Models\ProjectIntakeSubmission;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Livewire\Livewire;

use function Pest\Laravel\get;

uses(RefreshDatabase::class);

test('intake pages render in both locales', function () {
    get('/intake')->assertSuccessful();
    get('/en/intake')->assertSuccessful();
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

test('thanks pages render in both locales', function () {
    get('/intake/gracias')->assertSuccessful();
    get('/en/intake/thanks')->assertSuccessful();
});
