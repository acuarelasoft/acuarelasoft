<x-layouts.landing
    :title="__('intake.meta_title')"
    :metaDescription="__('intake.meta_description')"
>
    @push('structured-data')
        <script type="application/ld+json">
            {!! json_encode([
                '@'.'context' => 'https://schema.org',
                '@type' => 'Service',
                'name' => __('intake.hero_title'),
                'description' => __('intake.meta_description'),
                'provider' => [
                    '@type' => 'Organization',
                    'name' => 'AcuarelaSoft',
                    'url' => \App\Support\LocalizedRoute::route('home', [], 'es'),
                ],
                'serviceType' => 'Software requirements discovery',
                'areaServed' => ['MX', 'US'],
                'url' => \App\Support\LocalizedRoute::route('intake'),
                'inLanguage' => \App\Support\LocalizedRoute::languageTag(),
            ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
        </script>
    @endpush

    @php
        $categories = config('intake.categories', []);
        $groupedModules = collect(config('intake.modules', []))
            ->map(static function (array $moduleConfig, string $moduleId): ?array {
                $moduleTrans = trans('intake.modules.'.$moduleId);

                if (! is_array($moduleTrans)) {
                    return null;
                }

                return [
                    'category' => (string) ($moduleConfig['category'] ?? 'platform'),
                    'short' => (string) ($moduleTrans['short'] ?? $moduleId),
                    'label' => (string) ($moduleTrans['label'] ?? $moduleId),
                    'description' => (string) ($moduleTrans['description'] ?? ''),
                    'complexity' => (string) ($moduleConfig['complexity'] ?? 'media'),
                    'use_cases' => array_values((array) ($moduleTrans['use_cases'] ?? [])),
                    'dependencies' => array_values((array) ($moduleConfig['dependencies'] ?? [])),
                ];
            })
            ->filter()
            ->groupBy('category')
            ->sortKeysUsing(static fn (string $left, string $right): int =>
                ((int) data_get($categories, $left.'.position', 99)) <=> ((int) data_get($categories, $right.'.position', 99))
            )
            ->all();
    @endphp

    <section class="relative overflow-hidden py-16 md:py-20" aria-labelledby="intake-title">
        <div class="absolute inset-0" aria-hidden="true" style="background: radial-gradient(ellipse 70% 54% at 20% 10%, rgba(111,168,216,0.18) 0%, transparent 70%), radial-gradient(ellipse 55% 50% at 85% 80%, rgba(191,231,214,0.16) 0%, transparent 72%);"></div>

        <div class="relative mx-auto max-w-6xl px-6">
            <header class="max-w-3xl">
                <h1 id="intake-title" class="font-heading text-4xl font-bold text-ink md:text-5xl">{{ __('intake.hero_title') }}</h1>
                <p class="mt-4 text-base leading-relaxed text-ink/80 md:text-lg">{{ __('intake.hero_subtitle') }}</p>
            </header>

            <div class="mt-10 space-y-7">
                @foreach ($groupedModules as $category => $modules)
                    <section class="space-y-3" aria-labelledby="category-{{ $category }}">
                        <h2 id="category-{{ $category }}" class="font-heading text-2xl font-semibold text-ink">{{ __('intake.categories.'.$category) }}</h2>

                        <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                            @foreach ($modules as $module)
                                <article class="rounded-soft border border-acuarela-300/45 bg-white/75 p-4">
                                    <div class="flex items-start justify-between gap-3">
                                        <div>
                                            <p class="font-medium text-ink">{{ $module['short'] }}</p>
                                            <h3 class="mt-1 text-base font-semibold text-ink">{{ $module['label'] }}</h3>
                                        </div>
                                        <span class="rounded-full bg-petroleo/10 px-2.5 py-1 text-xs font-medium text-petroleo">
                                            {{ __('intake.complexity.'.$module['complexity']) }}
                                        </span>
                                    </div>

                                    <p class="mt-3 text-sm leading-relaxed text-ink/80">{{ $module['description'] }}</p>

                                    @if ($module['dependencies'] !== [])
                                        <p class="mt-3 text-xs font-semibold uppercase tracking-wide text-ink/70">{{ __('intake.helpers.dependencies') }}</p>
                                        <ul class="mt-1 list-disc space-y-1 pl-5 text-sm text-ink/75">
                                            @foreach ($module['dependencies'] as $dependency)
                                                <li>{{ $dependency }}</li>
                                            @endforeach
                                        </ul>
                                    @endif

                                    @if ($module['use_cases'] !== [])
                                        <p class="mt-3 text-xs font-semibold uppercase tracking-wide text-ink/70">{{ __('intake.helpers.use_cases') }}</p>
                                        <ul class="mt-1 list-disc space-y-1 pl-5 text-sm text-ink/75">
                                            @foreach ($module['use_cases'] as $useCase)
                                                <li>{{ $useCase }}</li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </article>
                            @endforeach
                        </div>
                    </section>
                @endforeach
            </div>

            <div class="mt-12 rounded-soft border border-acuarela-300/45 bg-paper/90 p-6 text-center md:p-8">
                <h2 class="font-heading text-2xl font-semibold text-ink">{{ __('intake.info.cta_title') }}</h2>
                <p class="mx-auto mt-3 max-w-3xl text-sm leading-relaxed text-ink/75 md:text-base">{{ __('intake.info.cta_description') }}</p>
                <a href="{{ \App\Support\LocalizedRoute::route('home') }}#contacto" class="mt-6 inline-flex rounded-soft bg-petroleo px-6 py-3 text-sm font-semibold text-paper transition-all duration-200 hover:bg-[#245A65] hover:scale-[1.02] focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-petroleo">
                    {{ __('intake.info.cta_action') }}
                </a>
            </div>
        </div>
    </section>
</x-layouts.landing>
