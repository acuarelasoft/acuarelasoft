<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class IntakeSubmissionConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @param  array<int, array<string, mixed>>  $selectedModules
     * @param  array{score:int,size:string,budget_tier:string}  $estimate
     */
    public function __construct(
        public string $clientName,
        public string $clientLocale,
        public string $projectSummary,
        public array $selectedModules,
        public array $estimate,
    ) {}

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: trans('intake.email.subject', [], $this->clientLocale),
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.intake-confirmation',
        );
    }
}
