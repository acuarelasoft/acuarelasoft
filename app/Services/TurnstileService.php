<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class TurnstileService
{
    public function verify(string $token, ?string $ip = null): bool
    {
        if (! app()->isProduction()) {
            return true;
        }

        $response = Http::asForm()->post('https://challenges.cloudflare.com/turnstile/v0/siteverify', array_filter([
            'secret' => config('services.turnstile.secret'),
            'response' => $token,
            'remoteip' => $ip,
        ]));

        return $response->successful() && $response->json('success') === true;
    }
}
