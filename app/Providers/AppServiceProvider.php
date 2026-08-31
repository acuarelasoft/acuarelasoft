<?php

namespace App\Providers;

use App\Support\LocalizedRoute;
use Carbon\CarbonImmutable;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Rules\Password;
use Laravel\Head\Enums\OgType;
use Laravel\Head\Enums\TwitterCard;
use Laravel\Head\Facades\Head;
use Laravel\Head\HeadBuilder;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->configureDefaults();
        $this->configureHead();
    }

    /**
     * Configure default behaviors for production-ready applications.
     */
    protected function configureDefaults(): void
    {
        Date::use(CarbonImmutable::class);

        DB::prohibitDestructiveCommands(
            app()->isProduction(),
        );

        Password::defaults(fn (): ?Password => app()->isProduction()
            ? Password::min(12)
                ->mixedCase()
                ->letters()
                ->numbers()
                ->symbols()
                ->uncompromised()
            : null,
        );
    }

    /**
     * Register site-wide document head defaults (title, description, OG, Twitter, robots).
     */
    protected function configureHead(): void
    {
        Head::defaults(fn (HeadBuilder $head) => $head
            ->title(__('landing.meta_title'), exact: true)
            ->description(__('landing.meta_description'))
            ->canonical(forceHttps: false)
            ->robots('index, follow')
            ->og(
                type: OgType::Website,
                siteName: 'AcuarelaSoft',
                locale: LocalizedRoute::ogLocale(),
            )
            ->twitter(card: TwitterCard::SummaryWithLargeImage));
    }
}
