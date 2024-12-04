<?php

return [
    'name' => 'PWA Name Placeholder in config',
    'manifest' => [
        'name' => config('app.name'),
        'short_name' => config('app.short_name'),
        'description' => 'A Cloud App.',
        'start_url' => '/admin', // Start at Filament
        'background_color' => '#ffffff',
        'theme_color' => '#000000',
        'display' => 'standalone',
        'orientation' => 'any',
        'status_bar' => 'black',
        'icons' => [
            // The default "must have" sizes are 192x192 and 512x512.
            '192x192' => [
                'path' => '/img/pwa/android-chrome-192x192.png',
                'purpose' => 'any',
            ],
            '512x512' => [
                'path' => '/img/pwa/android-chrome-512x512.png',
                'purpose' => 'any',
            ],
            // The rest of the icons are filed in /icons.
            '72x72' => [
                'path' => '/img/pwa/icons/icon-72x72.png',
                'purpose' => 'any'
            ],
            '96x96' => [
                'path' => '/img/pwa/icons/icon-96x96.png',
                'purpose' => 'any'
            ],
            '128x128' => [
                'path' => '/img/pwa/icons/icon-128x128.png',
                'purpose' => 'any'
            ],
            '144x144' => [
                'path' => '/img/pwa/icons/icon-144x144.png',
                'purpose' => 'any'
            ],
            '152x152' => [
                'path' => '/img/pwa/icons/icon-152x152.png',
                'purpose' => 'any'
            ],
            '384x384' => [
                'path' => '/img/pwa/icons/icon-384x384.png',
                'purpose' => 'any'
            ],
        ],
        'splash' => [
            '640x1136'  => '/img/pwa/splash/splash-640x1136.png',
            '750x1334'  => '/img/pwa/splash/splash-750x1334.png',
            '828x1792'  => '/img/pwa/splash/splash-828x1792.png',
            '1080x2160' => '/img/pwa/splash/splash-1080x2160.png',
            '1125x2436' => '/img/pwa/splash/splash-1125x2436.png',
            '1136x640'  => '/img/pwa/splash/splash-1136x640.png',
            '1242x2688' => '/img/pwa/splash/splash-1242x2688.png',
            '1280x720'  => '/img/pwa/splash/splash-1280x720.png',
            '1334x750'  => '/img/pwa/splash/splash-1334x750.png',
            '1440x2960' => '/img/pwa/splash/splash-1440x2960.png',
            '1536x2048' => '/img/pwa/splash/splash-1536x2048.png',
            '1668x2224' => '/img/pwa/splash/splash-1668x2224.png',
            '1668x2388' => '/img/pwa/splash/splash-1668x2388.png',
            '1792x828'  => '/img/pwa/splash/splash-1792x828.png',
            '1920x1080' => '/img/pwa/splash/splash-1920x1080.png',
            '2048x1536' => '/img/pwa/splash/splash-2048x1536.png',
            '2048x2732' => '/img/pwa/splash/splash-2048x2732.png',
            '2160x3840' => '/img/pwa/splash/splash-2160x3840.png',
            '2224x1668' => '/img/pwa/splash/splash-2224x1668.png',
            '2388x1668' => '/img/pwa/splash/splash-2388x1668.png',
            '2436x1125' => '/img/pwa/splash/splash-2436x1125.png',
            '2688x1242' => '/img/pwa/splash/splash-2688x1242.png',
            '2732x2048' => '/img/pwa/splash/splash-2732x2048.png',
            '3840x2160' => '/img/pwa/splash/splash-3840x2160.png',
        ],
        'screenshots' => [
            [
                'src' => '/img/pwa/screenshots/screenshot-720x720.png',
                'sizes' => '720x720',
                'type' => 'image/png',
                'form_factor' => 'wide',
            ],
            [
                'src' => '/img/pwa/screenshots/screenshot-1280x720.png',
                'sizes' => '1280x720',
                'type' => 'image/png',
                'form_factor' => 'narrow',
            ],
        ],
        'shortcuts' => [
            [
                'name' => 'Shortcut Link 1',
                'short_name' => 'Link 1',
                'description' => 'Shortcut Link 1 Description',
                'url' => '/shortcutlink1',
                'icons' => [
                    'src' => '/img/pwa/icons/icon-96x96.png',
                    'sizes' => '96x96',
                    'purpose' => 'any'
                ]
            ],
            [
                'name' => 'Shortcut Link 2',
                'short_name' => 'Link 2',
                'description' => 'Shortcut Link 2 Description',
                'url' => '/shortcutlink2',
                'icons' => [
                    'src' => '/img/pwa/icons/icon-96x96.png',
                    'sizes' => '96x96',
                    'purpose' => 'any'
                ]
            ],
        ],
        'custom' => [],
    ],
];
