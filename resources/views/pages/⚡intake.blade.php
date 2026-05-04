<?php

use App\Mail\IntakeSubmissionConfirmation;
use App\Models\ProjectIntakeSubmission;
use App\Services\TurnstileService;
use App\Support\IntakeEstimator;
use App\Support\IntakeModuleCatalog;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Component;

new #[Title('Project Intake')] class extends Component {
    public string $fullName = '';
    public string $email = '';
    public string $phone = '';
    public string $projectSummary = '';
    public string $searchTerm = '';
    public string $categoryFilter = 'all';
    public string $turnstileToken = '';

    /**
     * @var list<string>
     */
    public array $selectedModules = [];

    /**
     * @return array<string, mixed>
     */
    protected function rules(): array
    {
        return [
            'fullName' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email:rfc', 'max:255'],
            'phone' => ['required', 'string', 'max:60'],
            'projectSummary' => ['required', 'string', 'min:20', 'max:2000'],
            'selectedModules' => ['required', 'array', 'min:1'],
            'selectedModules.*' => ['string', 'in:'.implode(',', IntakeModuleCatalog::moduleIds())],
        ];
    }

    /**
     * @return array<string, string>
     */
    protected function messages(): array
    {
        return [
            'fullName.required' => __('intake.validation.full_name_required'),
            'email.required' => __('intake.validation.email_required'),
            'email.email' => __('intake.validation.email_email'),
            'phone.required' => __('intake.validation.phone_required'),
            'projectSummary.required' => __('intake.validation.project_summary_required'),
            'projectSummary.min' => __('intake.validation.project_summary_min'),
            'selectedModules.required' => __('intake.validation.selected_modules_required'),
            'selectedModules.array' => __('intake.validation.selected_modules_array'),
            'selectedModules.min' => __('intake.validation.selected_modules_min'),
            'selectedModules.*.in' => __('intake.validation.selected_modules_in'),
        ];
    }

    /**
     * @return array<string, string>
     */
    protected function validationAttributes(): array
    {
        return [
            'fullName' => __('intake.fields.full_name'),
            'email' => __('intake.fields.email'),
            'phone' => __('intake.fields.phone'),
            'projectSummary' => __('intake.fields.project_summary'),
            'selectedModules' => __('intake.sections.modules'),
        ];
    }

    public function clearFilters(): void
    {
        $this->searchTerm = '';
        $this->categoryFilter = 'all';
    }

    public function submit(): void
    {
        if (app()->isProduction()) {
            /** @var TurnstileService $turnstile */
            $turnstile = app(TurnstileService::class);

            if (! $turnstile->verify($this->turnstileToken, request()->ip())) {
                $this->addError('turnstileToken', __('intake.validation.captcha_invalid'));

                return;
            }
        }

        $validated = $this->validate();
        $estimate = IntakeEstimator::estimate($validated['selectedModules']);

        $submission = ProjectIntakeSubmission::query()->create([
            'full_name' => $validated['fullName'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'project_summary' => $validated['projectSummary'],
            'locale' => app()->getLocale(),
            'selected_modules' => $validated['selectedModules'],
            'estimate_score' => $estimate['score'],
            'estimate_size' => $estimate['size'],
            'budget_tier' => $estimate['budget_tier'],
        ]);

        Mail::to($submission->email)->send(new IntakeSubmissionConfirmation(
            clientName: $submission->full_name,
            clientLocale: $submission->locale,
            projectSummary: $submission->project_summary,
            selectedModules: $this->selectedModuleRecords,
            estimate: $estimate,
        ));

        $this->redirectRoute('intake.thanks');
    }

    /**
     * @return array<string, mixed>
     */
    #[Computed]
    public function groupedModules(): array
    {
        $catalog = IntakeModuleCatalog::modules();
        $search = Str::lower(trim($this->searchTerm));
        $groups = [];

        foreach ($catalog as $moduleId => $moduleData) {
            $trans = trans('intake.modules.'.$moduleId);

            if (! is_array($trans)) {
                continue;
            }

            $label = (string) ($trans['label'] ?? $moduleId);
            $description = (string) ($trans['description'] ?? '');
            $category = (string) ($moduleData['category'] ?? 'platform');
            $complexity = (string) ($moduleData['complexity'] ?? 'media');

            $matchesSearch = $search === ''
                || Str::contains(Str::lower($label), $search)
                || Str::contains(Str::lower($description), $search);

            if (! $matchesSearch) {
                continue;
            }

            if ($this->categoryFilter !== 'all' && $this->categoryFilter !== $category) {
                continue;
            }

            $translatedUseCases = $trans['use_cases'] ?? null;

            if (! is_array($translatedUseCases) || $translatedUseCases === []) {
                $translatedUseCases = (array) ($moduleData['use_cases'] ?? []);
            }

            $groups[$category][$moduleId] = [
                'id' => $moduleId,
                'short' => (string) ($trans['short'] ?? $label),
                'label' => $label,
                'description' => $description,
                'complexity' => $complexity,
                'use_cases' => array_values(array_map(static fn (mixed $useCase): string => (string) $useCase, $translatedUseCases)),
            ];
        }

        $positions = array_map(
            static fn (array $category): int => (int) ($category['position'] ?? 99),
            IntakeModuleCatalog::categories(),
        );

        uksort($groups, static fn (string $left, string $right): int => ($positions[$left] ?? 99) <=> ($positions[$right] ?? 99));

        return $groups;
    }

    /**
     * @return list<array<string, mixed>>
     */
    #[Computed]
    public function selectedModuleRecords(): array
    {
        $records = [];

        foreach ($this->selectedModules as $moduleId) {
            $moduleData = IntakeModuleCatalog::module($moduleId);
            $trans = trans('intake.modules.'.$moduleId);

            if ($moduleData === [] || ! is_array($trans)) {
                continue;
            }

            $records[] = [
                'id' => $moduleId,
                'label' => (string) ($trans['label'] ?? $moduleId),
                'complexity' => (string) ($moduleData['complexity'] ?? 'media'),
            ];
        }

        return $records;
    }

};
?>

<section class="relative overflow-hidden py-16 md:py-20" aria-labelledby="intake-title">
        <div class="absolute inset-0" aria-hidden="true" style="background: radial-gradient(ellipse 70% 54% at 20% 10%, rgba(111,168,216,0.18) 0%, transparent 70%), radial-gradient(ellipse 55% 50% at 85% 80%, rgba(191,231,214,0.16) 0%, transparent 72%);"></div>

        <div class="relative mx-auto max-w-6xl px-6">
            <header class="max-w-3xl">
                <h1 id="intake-title" class="font-heading text-4xl font-bold text-ink md:text-5xl">{{ __('intake.hero_title') }}</h1>
                <p class="mt-4 text-base leading-relaxed text-ink/80 md:text-lg">{{ __('intake.hero_subtitle') }}</p>
            </header>

            {{-- 3-step guide --}}
            <div class="mt-8 flex flex-col gap-4 sm:flex-row sm:gap-0" aria-label="{{ __('intake.helpers.steps_label') }}" role="list">
                @foreach ([
                    ['n' => '1', 'title' => __('intake.helpers.step_1_title'), 'desc' => __('intake.helpers.step_1_desc')],
                    ['n' => '2', 'title' => __('intake.helpers.step_2_title'), 'desc' => __('intake.helpers.step_2_desc')],
                    ['n' => '3', 'title' => __('intake.helpers.step_3_title'), 'desc' => __('intake.helpers.step_3_desc')],
                ] as $i => $step)
                    <div class="flex flex-1 items-start gap-3 {{ $i > 0 ? 'sm:border-l sm:border-acuarela-300/35 sm:pl-6' : '' }}" role="listitem">
                        <span class="inline-flex h-7 w-7 shrink-0 items-center justify-center rounded-full bg-petroleo text-xs font-bold text-paper" aria-hidden="true">{{ $step['n'] }}</span>
                        <div>
                            <p class="font-semibold text-ink text-sm">{{ $step['title'] }}</p>
                            <p class="text-xs text-ink/60 mt-0.5">{{ $step['desc'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>

            <form wire:submit="submit" class="mt-10 space-y-10">
                <section class="rounded-soft border border-acuarela-300/35 bg-paper/85 p-6 backdrop-blur-sm md:p-8" aria-labelledby="client-section">
                    <h2 id="client-section" class="font-heading text-2xl font-semibold text-ink">{{ __('intake.sections.client') }}</h2>
                    <p class="mt-1.5 text-sm text-ink/60">{{ __('intake.sections.client_hint') }}</p>

                    <div class="mt-6 grid gap-5 md:grid-cols-2">
                        <div>
                            <label for="fullName" class="text-sm font-medium text-ink">{{ __('intake.fields.full_name') }}</label>
                            <input id="fullName" wire:model="fullName" type="text" autocomplete="name" class="mt-2 w-full rounded-soft border border-acuarela-300/45 bg-white/75 px-4 py-3 text-ink outline-none transition focus:border-petroleo focus:ring-2 focus:ring-petroleo/20" aria-required="true">
                            @error('fullName') <p class="mt-1.5 text-sm text-[#9e3a34]" role="alert">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="email" class="text-sm font-medium text-ink">{{ __('intake.fields.email') }}</label>
                            <input id="email" wire:model="email" type="email" autocomplete="email" class="mt-2 w-full rounded-soft border border-acuarela-300/45 bg-white/75 px-4 py-3 text-ink outline-none transition focus:border-petroleo focus:ring-2 focus:ring-petroleo/20" aria-required="true">
                            @error('email') <p class="mt-1.5 text-sm text-[#9e3a34]" role="alert">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="phone" class="text-sm font-medium text-ink">{{ __('intake.fields.phone') }}</label>
                            <input id="phone" wire:model="phone" type="text" autocomplete="tel" class="mt-2 w-full rounded-soft border border-acuarela-300/45 bg-white/75 px-4 py-3 text-ink outline-none transition focus:border-petroleo focus:ring-2 focus:ring-petroleo/20" aria-required="true">
                            @error('phone') <p class="mt-1.5 text-sm text-[#9e3a34]" role="alert">{{ $message }}</p> @enderror
                        </div>

                        <div class="md:col-span-2">
                            <label for="projectSummary" class="text-sm font-medium text-ink">{{ __('intake.fields.project_summary') }}</label>
                            <p class="mt-0.5 text-xs text-ink/55">{{ __('intake.fields.project_summary_hint') }}</p>
                            <textarea id="projectSummary" wire:model="projectSummary" rows="5" class="mt-2 w-full rounded-soft border border-acuarela-300/45 bg-white/75 px-4 py-3 text-ink outline-none transition focus:border-petroleo focus:ring-2 focus:ring-petroleo/20" aria-required="true"></textarea>
                            @error('projectSummary') <p class="mt-1.5 text-sm text-[#9e3a34]" role="alert">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </section>

                <section class="rounded-soft border border-acuarela-300/35 bg-paper/85 p-6 backdrop-blur-sm md:p-8" aria-labelledby="module-section">
                    <div class="flex flex-wrap items-end justify-between gap-4">
                        <h2 id="module-section" class="font-heading text-2xl font-semibold text-ink">{{ __('intake.sections.modules') }}</h2>
                        <p class="text-sm text-ink/70">{{ __('intake.helpers.selected_count', ['count' => count($selectedModules)]) }}</p>
                    </div>
                    <p class="mt-1.5 text-sm text-ink/60">{{ __('intake.sections.modules_hint') }}</p>

                    <div class="mt-6 grid gap-4 md:grid-cols-3">
                        <div class="md:col-span-2">
                            <label for="searchTerm" class="text-sm font-medium text-ink">{{ __('intake.fields.module_search') }}</label>
                            <input id="searchTerm" wire:model.live.debounce.250ms="searchTerm" type="text" placeholder="{{ __('intake.fields.module_search_placeholder') }}" class="mt-2 w-full rounded-soft border border-acuarela-300/45 bg-white/75 px-4 py-3 text-ink outline-none transition focus:border-petroleo focus:ring-2 focus:ring-petroleo/20">
                        </div>

                        <div>
                            <label for="categoryFilter" class="text-sm font-medium text-ink">{{ __('intake.fields.category_filter') }}</label>
                            <select id="categoryFilter" wire:model.live="categoryFilter" class="mt-2 w-full rounded-soft border border-acuarela-300/45 bg-white/75 px-4 py-3 text-ink outline-none transition focus:border-petroleo focus:ring-2 focus:ring-petroleo/20">
                                <option value="all">{{ __('intake.categories.all') }}</option>
                                @foreach (config('intake.categories', []) as $categoryKey => $category)
                                    <option value="{{ $categoryKey }}">{{ __('intake.categories.'.$categoryKey) }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    @error('selectedModules') <p class="mt-4 text-sm text-[#9e3a34]" role="alert">{{ $message }}</p> @enderror

                    {{-- Module tip callout --}}
                    <div class="mt-5 flex items-start gap-3 rounded-soft border border-acuarela-200/70 bg-acuarela-50/60 px-4 py-3" role="note">
                        <svg class="mt-0.5 h-4 w-4 shrink-0 text-petroleo" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z"/></svg>
                        <p class="text-sm text-ink/75">{{ __('intake.helpers.module_tip') }}</p>
                    </div>

                    <div class="mt-6 space-y-7">
                        @forelse ($this->groupedModules as $category => $modules)
                            <section wire:key="group-{{ $category }}" class="space-y-3">
                                <h3 class="font-heading text-xl text-ink">{{ __('intake.categories.'.$category) }}</h3>

                                <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                                    @foreach ($modules as $module)
                                        @php $isSelected = in_array($module['id'], $selectedModules, true); @endphp
                                        <label wire:key="module-{{ $module['id'] }}" class="group relative block cursor-pointer rounded-soft border p-4 transition-all {{ $isSelected ? 'border-petroleo bg-acuarela-100/60' : 'border-acuarela-300/45 bg-white/70 hover:border-acuarela-500/55' }}">
                                            <input type="checkbox" value="{{ $module['id'] }}" wire:model.live="selectedModules" class="peer sr-only" aria-label="{{ $module['label'] }}">

                                            <div class="flex items-start justify-between gap-3">
                                                <div>
                                                    <p class="font-medium text-ink">{{ $module['short'] }}</p>
                                                    <p class="mt-1 text-sm text-ink/75">{{ __('intake.helpers.complexity_tag') }}: {{ __('intake.complexity.'.$module['complexity']) }}</p>
                                                </div>

                                                <span class="mt-0.5 inline-flex h-5 w-5 shrink-0 items-center justify-center rounded-full border {{ $isSelected ? 'border-petroleo bg-petroleo text-paper' : 'border-acuarela-400/55 text-transparent' }}" aria-hidden="true">
                                                    <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" /></svg>
                                                </span>
                                            </div>

                                            <details class="mt-3 rounded-soft border border-acuarela-200/70 bg-paper/85 p-3 text-sm text-ink/80">
                                                <summary class="cursor-pointer font-medium text-petroleo">{{ __('intake.actions.toggle_details') }}</summary>
                                                <p class="mt-2 leading-relaxed">{{ $module['description'] }}</p>

                                                <p class="mt-3 font-medium text-ink">{{ __('intake.helpers.use_cases') }}</p>
                                                <ul class="mt-1 list-disc space-y-1 pl-5">
                                                    @foreach ($module['use_cases'] as $useCase)
                                                        <li>{{ $useCase }}</li>
                                                    @endforeach
                                                </ul>
                                            </details>
                                        </label>
                                    @endforeach
                                </div>
                            </section>
                        @empty
                            <p class="text-sm text-ink/70">{{ __('intake.helpers.no_results') }}</p>
                        @endforelse
                    </div>
                </section>

                <section class="rounded-soft border border-acuarela-300/35 bg-paper/90 p-6 md:p-8" aria-labelledby="summary-section">
                    <div class="flex flex-wrap items-end justify-between gap-4">
                        <h2 id="summary-section" class="font-heading text-2xl font-semibold text-ink">{{ __('intake.sections.summary') }}</h2>
                        @if (count($selectedModules) > 0)
                            <span class="rounded-full bg-petroleo/10 px-3 py-1 text-sm font-medium text-petroleo">{{ __('intake.helpers.selected_count', ['count' => count($selectedModules)]) }}</span>
                        @endif
                    </div>
                    <p class="mt-1.5 text-sm text-ink/60">{{ __('intake.sections.summary_hint') }}</p>

                    @if ($this->selectedModuleRecords !== [])
                        <ul class="mt-5 grid gap-2 sm:grid-cols-2 lg:grid-cols-3">
                            @foreach ($this->selectedModuleRecords as $record)
                                <li class="flex items-center gap-2.5 rounded-soft border border-acuarela-300/45 bg-white/70 px-4 py-3">
                                    <span class="inline-flex h-5 w-5 shrink-0 items-center justify-center rounded-full bg-petroleo text-paper" aria-hidden="true">
                                        <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" /></svg>
                                    </span>
                                    <span class="text-sm font-medium text-ink">{{ $record['label'] }}</span>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="mt-4 text-sm text-ink/70">{{ __('intake.helpers.no_modules_selected') }}</p>
                    @endif
                </section>

                <div class="flex flex-col items-end gap-2">
                    @production
                    <div
                        x-data
                        x-on:turnstile-intake-token.window="$wire.set('turnstileToken', $event.detail)"
                        class="self-start"
                    >
                        <div
                            class="cf-turnstile"
                            data-sitekey="{{ config('services.turnstile.sitekey') }}"
                            data-theme="light"
                            data-callback="onIntakeTurnstileSuccess"
                            data-expired-callback="onIntakeTurnstileExpired"
                        ></div>
                        @error('turnstileToken')
                            <p role="alert" class="mt-1.5 font-sans text-sm text-salmon">{{ $message }}</p>
                        @enderror
                    </div>
                    @endproduction

                    <button type="submit" class="inline-flex items-center rounded-soft bg-petroleo px-6 py-3 text-sm font-semibold text-paper transition-all hover:scale-[1.02] hover:bg-[#245A65] focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-petroleo">
                        {{ __('intake.actions.submit') }}
                    </button>
                    <p class="text-xs text-ink/50">{{ __('intake.helpers.submit_note') }}</p>
                </div>
            </form>
        </div>
    </section>

@production
@push('scripts')
<script src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer></script>
<script>
    function onIntakeTurnstileSuccess(token) {
        window.dispatchEvent(new CustomEvent('turnstile-intake-token', { detail: token }));
    }
    function onIntakeTurnstileExpired() {
        window.dispatchEvent(new CustomEvent('turnstile-intake-token', { detail: '' }));
    }
</script>
@endpush
@endproduction
