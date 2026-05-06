<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class TurnstileService
{
    public function verify(string $token, ?string $ip = null): bool
    {
        if (! app()->isProduction()) {
            return true;
        }

        if ($token === '') {
            Log::warning('Turnstile verification failed: empty token');

            return false;
        }

        $response = Http::asForm()->post('https://challenges.cloudflare.com/turnstile/v0/siteverify', array_filter([
            'secret' => config('services.turnstile.secret'),
            'response' => $token,
            'remoteip' => $ip,
        ]));

        $isValid = $response->successful() && $response->json('success') === true;

        if (! $isValid) {
            Log::warning('Turnstile verification failed', [
                'status' => $response->status(),
                'error_codes' => $response->json('error-codes'),
                'hostname' => $response->json('hostname'),
                'action' => $response->json('action'),
                'has_token' => $token !== '',
            ]);
        }

        return $isValid;
    }
}
