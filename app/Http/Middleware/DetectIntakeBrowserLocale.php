<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DetectIntakeBrowserLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $preferredLocale = $request->getPreferredLanguage(['es', 'en']) === 'es' ? 'es' : 'en';

        if ($preferredLocale === 'en') {
            if ($request->routeIs('intake')) {
                return redirect()->route('intake.en');
            }

            if ($request->routeIs('intake.thanks')) {
                return redirect()->route('intake.thanks.en');
            }
        }

        return $next($request);
    }
}
