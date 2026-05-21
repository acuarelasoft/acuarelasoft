<?php

namespace App\Http\Middleware;

use App\Support\LocalizedRoute;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

class SetLocaleFromSession
{
    /**
     * @var list<string>
     */
    private const PUBLIC_ROUTE_NAMES = [
        'home',
        'service',
        'intake',
        'intake.thanks',
        'en.home',
        'en.service',
        'en.intake',
        'en.intake.thanks',
        'sitemap',
        'robots',
    ];

    public function handle(Request $request, Closure $next): Response
    {
        $locale = $this->resolveLocale($request);

        App::setLocale($locale);

        if ($request->hasSession()) {
            $request->session()->put('lang', $locale);
        }

        return $next($request);
    }

    private function resolveLocale(Request $request): string
    {
        $pathLocale = (string) $request->segment(1);

        if (in_array($pathLocale, LocalizedRoute::SUPPORTED_LOCALES, true)) {
            return $pathLocale;
        }

        $routeName = $request->route()?->getName();

        if (in_array($routeName, self::PUBLIC_ROUTE_NAMES, true)) {
            return LocalizedRoute::DEFAULT_LOCALE;
        }

        if ($request->hasSession()) {
            return LocalizedRoute::resolveLocale((string) $request->session()->get('lang'));
        }

        return LocalizedRoute::DEFAULT_LOCALE;
    }
}
