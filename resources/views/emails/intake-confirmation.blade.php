@php
    $locale = $clientLocale;
    $t = fn (string $key, array $replace = []) => trans($key, $replace, $locale);
@endphp

<!DOCTYPE html>
<html lang="{{ $locale }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $t('intake.email.subject') }}</title>
</head>
<body style="font-family: Inter, Arial, sans-serif; line-height: 1.6; color: #21333A;">
    <p>{{ $t('intake.email.greeting', ['name' => $clientName]) }}</p>

    <p>{{ $t('intake.email.intro') }}</p>

    <h2>{{ $t('intake.email.summary') }}</h2>
    <p>{{ $projectSummary }}</p>

    <h2>{{ $t('intake.email.selected_modules') }}</h2>
    <ul>
        @foreach ($selectedModules as $module)
            <li>{{ $module['label'] ?? '' }} ({{ strtoupper($module['complexity'] ?? '') }})</li>
        @endforeach
    </ul>

    <h2>{{ $t('intake.email.estimate') }}</h2>
    <ul>
        <li>{{ $t('intake.estimate.score') }}: {{ $estimate['score'] }}</li>
        <li>{{ $t('intake.estimate.size') }}: {{ $estimate['size'] }}</li>
        <li>{{ $t('intake.estimate.budget_tier') }}: {{ $t('intake.estimate.budget_'.$estimate['budget_tier']) }}</li>
    </ul>

    <p>{{ $t('intake.email.outro') }}</p>

    <p>{{ $t('intake.email.signature') }}</p>
</body>
</html>
