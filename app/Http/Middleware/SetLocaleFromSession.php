<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

class SetLocaleFromSession
{
    public function handle(Request $request, Closure $next): Response
    {
        $supportedLocales = ['en', 'es'];

        $locale = 'es';

        if ($request->hasSession()) {
            $locale = (string) $request->session()->get('lang', $locale);
        }

        if (! in_array($locale, $supportedLocales, true)) {
            $locale = 'es';
        }

        App::setLocale($locale);

        return $next($request);
    }
}
