<?php

namespace App\PWA;

class ManifestService
{
    public function generate(): array
    {
        $basicManifest = [
            'name' => config('pwa.manifest.name'),
            'short_name' => config('pwa.manifest.short_name'),
            'description' => config('pwa.manifest.description'),
            'start_url' => asset(config('pwa.manifest.start_url')), // Note the use of asset
            'display' => config('pwa.manifest.display'),
            'theme_color' => config('pwa.manifest.theme_color'),
            'background_color' => config('pwa.manifest.background_color'),
            'orientation' => config('pwa.manifest.orientation'),
            'status_bar' => config('pwa.manifest.status_bar'),
            'splash' => config('pwa.manifest.splash'),
            'screenshots' => config('pwa.manifest.screenshots'),
        ];

        foreach (config('pwa.manifest.icons') as $size => $file) {
            $fileInfo = pathinfo($file['path']);
            $basicManifest['icons'][] = [
                'src' => $file['path'],
                'type' => 'image/'.$fileInfo['extension'],
                'sizes' => $size,
                'purpose' => $file['purpose'],
            ];
        }

        if (config('pwa.manifest.shortcuts')) {
            foreach (config('pwa.manifest.shortcuts') as $shortcut) {

                if (array_key_exists('icons', $shortcut)) {
                    $fileInfo = pathinfo($shortcut['icons']['src']);
                    $icon = [
                        'src' => $shortcut['icons']['src'],
                        'type' => 'image/'.$fileInfo['extension'],
                        'sizes' => $shortcut['icons']['sizes'],
                        'purpose' => $shortcut['icons']['purpose'],
                    ];
                } else {
                    $icon = [];
                }

                $basicManifest['shortcuts'][] = [
                    'name' => trans($shortcut['name']),
                    'description' => trans($shortcut['description']),
                    'url' => $shortcut['url'],
                    'icons' => [
                        $icon,
                    ],
                ];
            }
        }

        foreach (config('pwa.manifest.custom') as $tag => $value) {
            $basicManifest[$tag] = $value;
        }

        return $basicManifest;
    }
}
