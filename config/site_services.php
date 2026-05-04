<?php

return [

    /*
    |--------------------------------------------------------------------------
    | AcuarelaSoft Service Definitions
    |--------------------------------------------------------------------------
    | Each service has a unique slug (used in URLs), a translation key that maps
    | to lang/{locale}/services.php, an icon bg color token, an icon SVG path
    | (Heroicons, stroke), and the technology badges shown on the service page.
    */

    [
        'slug' => 'web-design',
        'key' => 'web_design',
        'icon_bg' => 'bg-acuarela-400/10',
        'icon_path' => 'M9.53 16.122a3 3 0 00-5.78 1.128 2.25 2.25 0 01-2.4 2.245 4.5 4.5 0 008.4-2.245c0-.399-.078-.78-.22-1.128zm0 0a15.998 15.998 0 003.388-1.62m-5.043-.025a15.994 15.994 0 011.622-3.395m3.42 3.42a15.995 15.995 0 004.764-4.648l3.876-5.814a1.151 1.151 0 00-1.597-1.597L14.146 6.32a15.996 15.996 0 00-4.649 4.763m3.42 3.42a6.776 6.776 0 00-3.42-3.42',
        'techs' => ['HTML/CSS', 'Tailwind CSS', 'JavaScript', 'Alpine.js', 'Figma', 'Blade'],
    ],
    [
        'slug' => 'web-apps',
        'key' => 'web_apps',
        'icon_bg' => 'bg-salmon/10',
        'icon_path' => 'M17.25 6.75L22.5 12l-5.25 5.25m-10.5 0L1.5 12l5.25-5.25m7.5-3l-4.5 16.5',
        'techs' => ['Laravel', 'Angular', 'PostgreSQL', 'MariaDB', 'Docker', 'REST API'],
    ],
    [
        'slug' => 'mobile-apps',
        'key' => 'mobile_apps',
        'icon_bg' => 'bg-mint/20',
        'icon_path' => 'M10.5 1.5H8.25A2.25 2.25 0 006 3.75v16.5a2.25 2.25 0 002.25 2.25h7.5A2.25 2.25 0 0018 20.25V3.75a2.25 2.25 0 00-2.25-2.25H13.5m-3 0V3h3V1.5m-3 0h3m-3 8.25h3',
        'techs' => ['React Native', 'Flutter', 'iOS', 'Android', 'Firebase', 'REST API'],
    ],
    [
        'slug' => 'app-maintenance',
        'key' => 'app_maintenance',
        'icon_bg' => 'bg-acuarela-400/10',
        'icon_path' => 'M11.42 15.17L17.25 21A2.652 2.652 0 0021 17.25l-5.877-5.877M11.42 15.17l2.496-3.03c.317-.384.74-.626 1.208-.766M11.42 15.17l-4.655 5.653a2.548 2.548 0 11-3.586-3.586l6.837-5.63m5.108-.233c.55-.164 1.163-.188 1.743-.14a4.5 4.5 0 004.486-6.336l-3.276 3.277a3.004 3.004 0 01-2.25-2.25l3.276-3.276a4.5 4.5 0 00-6.336 4.486c.091 1.076-.071 2.264-.904 2.95l-.102.085m-1.745 1.437L5.909 7.5H4.5L2.25 3.75l1.5-1.5L7.5 4.5v1.409l4.26 4.26m-1.745 1.437l1.745-1.437m6.615 8.206L15.75 15.75M4.867 19.125h.008v.008h-.008v-.008z',
        'techs' => ['Laravel', 'Node.js', 'Docker', 'GitHub Actions', 'Sentry', 'CI/CD'],
    ],
    [
        'slug' => 'legacy-migration',
        'key' => 'legacy_migration',
        'icon_bg' => 'bg-salmon/10',
        'icon_path' => 'M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99',
        'techs' => ['Laravel', 'PostgreSQL', 'Docker', 'AWS', 'Redis', 'Queues'],
    ],
    [
        'slug' => 'web-servers',
        'key' => 'web_servers',
        'icon_bg' => 'bg-mint/20',
        'icon_path' => 'M5.25 14.25h13.5m-13.5 0a3 3 0 01-3-3m3 3a3 3 0 100 6h13.5a3 3 0 100-6m-16.5-3a3 3 0 013-3h13.5a3 3 0 013 3m-19.5 0a4.5 4.5 0 01.9-2.7L5.737 5.1a3.375 3.375 0 012.7-1.35h7.126c1.062 0 2.062.5 2.7 1.35l2.587 3.45a4.5 4.5 0 01.9 2.7m0 0a3 3 0 01-3 3m0 3h.008v.008h-.008v-.008zm0-6h.008v.008h-.008v-.008zm-3 6h.008v.008h-.008v-.008zm0-6h.008v.008h-.008v-.008z',
        'techs' => ['Nginx', 'Apache', 'PM2', "Let's Encrypt", 'AWS', 'Cloudflare', 'UFW'],
    ],
    [
        'slug' => 'desktop-apps',
        'key' => 'desktop_apps',
        'icon_bg' => 'bg-acuarela-400/10',
        'icon_path' => 'M9 17.25v1.007a3 3 0 01-.879 2.122L7.5 21h9l-.621-.621A3 3 0 0115 18.257V17.25m6-12V15a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 15V5.25m18 0A2.25 2.25 0 0018.75 3H5.25A2.25 2.25 0 003 5.25m18 0V12a2.25 2.25 0 01-2.25 2.25H5.25A2.25 2.25 0 013 12V5.25',
        'techs' => ['Electron', 'Tauri', 'Node.js', 'SQLite', 'Windows', 'macOS', 'Linux'],
    ],
    [
        'slug' => 'web-apis',
        'key' => 'web_apis',
        'icon_bg' => 'bg-salmon/10',
        'icon_path' => 'M3.75 13.5l10.5-11.25L12 10.5h8.25L9.75 21.75 12 13.5H3.75z',
        'techs' => ['Laravel', 'Node.js', 'REST', 'GraphQL', 'SOAP', 'OpenAPI', 'OAuth2'],
    ],

];
