@props([
    'href' => route('home'),
    'label' => __('landing.footer_tagline'),
    'size' => 'md',
    'iconVariant' => 'color',
])

@php
    $isLarge = $size === 'lg';

    $iconContainerSize = $isLarge ? 'size-10' : 'size-8';
    $iconPaletteSize = $isLarge ? 'size-7' : 'size-6';
    $wordmarkSize = $isLarge ? 'text-3xl' : 'text-xl';
@endphp

<a href="{{ $href }}"
   aria-label="AcuarelaSoft - {{ $label }}"
   {{ $attributes->merge(['class' => 'group inline-flex items-center gap-2.5 leading-none text-ink transition-colors duration-200 hover:text-petroleo']) }}>
    <span class="relative inline-flex {{ $iconContainerSize }} items-center justify-center rounded-soft border border-acuarela-300/50 bg-linear-to-br from-acuarela-100 via-paper to-acuarela-50 text-petroleo shadow-xs shadow-acuarela-400/20 transition-all duration-200 group-hover:border-acuarela-400/65 group-hover:from-acuarela-200 group-hover:to-paper">
        @if ($iconVariant === 'mono')
            <x-brand-logo-icon-mono class="{{ $iconPaletteSize }}" />
        @else
            <x-brand-logo-icon-color class="{{ $iconPaletteSize }}" />
        @endif
    </span>

    <span class="{{ $wordmarkSize }} font-heading font-bold tracking-[0.01em]">
        Acuarela<span class="font-sans font-semibold">Soft</span>
    </span>
</a>
