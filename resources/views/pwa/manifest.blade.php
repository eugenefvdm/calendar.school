<!-- PWA Includes -->
@php
    $config = config('pwa.manifest');
    if (!$config) {
        throw new exception('PWA Manifest config file not found. Check if the config/pwa.php file exists.');
    }
@endphp

<!-- Web Application Manifest -->
<link rel="manifest" href="{{ route('pwa.manifest') }}">
<!-- Chrome for Android theme color -->
<meta name="theme-color" content="{{ $config['theme_color'] }}">

<!-- Add to the home screen for Chrome on Android -->
<meta name="mobile-web-app-capable" content="{{ $config['display'] == 'standalone' ? 'yes' : 'no' }}">
<meta name="application-name" content="{{ $config['short_name'] }}">
<link rel="icon" sizes="{{ data_get(end($config['icons']), 'sizes') }}" href="{{ data_get(end($config['icons']), 'src') }}">

<!-- Add to the home screen for Safari on iOS -->
<meta name="apple-mobile-web-app-capable" content="{{ $config['display'] == 'standalone' ? 'yes' : 'no' }}">
<meta name="apple-mobile-web-app-status-bar-style" content="{{  $config['status_bar'] }}">
<meta name="apple-mobile-web-app-title" content="{{ $config['short_name'] }}">
<link rel="apple-touch-icon" href="{{ data_get(end($config['icons']), 'src') }}">

<!-- Portrait Orientations -->
<link href="{{ $config['splash']['640x1136'] }}" media="(device-width: 320px) and (device-height: 568px) and (-webkit-device-pixel-ratio: 2)" rel="apple-touch-startup-image" />
<link href="{{ $config['splash']['750x1334'] }}" media="(device-width: 375px) and (device-height: 667px) and (-webkit-device-pixel-ratio: 2)" rel="apple-touch-startup-image" />
<link href="{{ $config['splash']['828x1792'] }}" media="(device-width: 414px) and (device-height: 896px) and (-webkit-device-pixel-ratio: 2)" rel="apple-touch-startup-image" />
<link href="{{ $config['splash']['1125x2436'] }}" media="(device-width: 375px) and (device-height: 812px) and (-webkit-device-pixel-ratio: 3)" rel="apple-touch-startup-image" />
<link href="{{ $config['splash']['1242x2688'] }}" media="(device-width: 414px) and (device-height: 896px) and (-webkit-device-pixel-ratio: 3)" rel="apple-touch-startup-image" />
<link href="{{ $config['splash']['1280x720'] }}" media="(device-width: 640px) and (device-height: 360px) and (-webkit-device-pixel-ratio: 2)" rel="apple-touch-startup-image" />
<link href="{{ $config['splash']['1536x2048'] }}" media="(device-width: 768px) and (device-height: 1024px) and (-webkit-device-pixel-ratio: 2)" rel="apple-touch-startup-image" />
<link href="{{ $config['splash']['1668x2224'] }}" media="(device-width: 834px) and (device-height: 1112px) and (-webkit-device-pixel-ratio: 2)" rel="apple-touch-startup-image" />
<link href="{{ $config['splash']['1668x2388'] }}" media="(device-width: 834px) and (device-height: 1194px) and (-webkit-device-pixel-ratio: 2)" rel="apple-touch-startup-image" />
<link href="{{ $config['splash']['1920x1080'] }}" media="(device-width: 960px) and (device-height: 540px) and (-webkit-device-pixel-ratio: 2)" rel="apple-touch-startup-image" />
<link href="{{ $config['splash']['2048x2732'] }}" media="(device-width: 1024px) and (device-height: 1366px) and (-webkit-device-pixel-ratio: 2)" rel="apple-touch-startup-image" />
<link href="{{ $config['splash']['2160x3840'] }}" media="(device-width: 1080px) and (device-height: 1920px) and (-webkit-device-pixel-ratio: 2)" rel="apple-touch-startup-image" />

<!-- Landscape Orientations -->
<link href="{{ $config['splash']['1136x640'] }}" media="(device-width: 568px) and (device-height: 320px) and (-webkit-device-pixel-ratio: 2)" rel="apple-touch-startup-image" />
<link href="{{ $config['splash']['1334x750'] }}" media="(device-width: 667px) and (device-height: 375px) and (-webkit-device-pixel-ratio: 2)" rel="apple-touch-startup-image" />
<link href="{{ $config['splash']['1792x828'] }}" media="(device-width: 896px) and (device-height: 414px) and (-webkit-device-pixel-ratio: 2)" rel="apple-touch-startup-image" />
<link href="{{ $config['splash']['2436x1125'] }}" media="(device-width: 812px) and (device-height: 375px) and (-webkit-device-pixel-ratio: 3)" rel="apple-touch-startup-image" />
<link href="{{ $config['splash']['2688x1242'] }}" media="(device-width: 896px) and (device-height: 414px) and (-webkit-device-pixel-ratio: 3)" rel="apple-touch-startup-image" />
<link href="{{ $config['splash']['2048x1536'] }}" media="(device-width: 1024px) and (device-height: 768px) and (-webkit-device-pixel-ratio: 2)" rel="apple-touch-startup-image" />
<link href="{{ $config['splash']['2224x1668'] }}" media="(device-width: 1112px) and (device-height: 834px) and (-webkit-device-pixel-ratio: 2)" rel="apple-touch-startup-image" />
<link href="{{ $config['splash']['2388x1668'] }}" media="(device-width: 1194px) and (device-height: 834px) and (-webkit-device-pixel-ratio: 2)" rel="apple-touch-startup-image" />
<link href="{{ $config['splash']['2732x2048'] }}" media="(device-width: 1366px) and (device-height: 1024px) and (-webkit-device-pixel-ratio: 2)" rel="apple-touch-startup-image" />
<link href="{{ $config['splash']['3840x2160'] }}" media="(device-width: 1920px) and (device-height: 1080px) and (-webkit-device-pixel-ratio: 2)" rel="apple-touch-startup-image" />

<!-- Ultra-Wide Screens -->
<link href="{{ $config['splash']['1440x2960'] }}" media="(device-width: 720px) and (device-height: 1480px) and (-webkit-device-pixel-ratio: 2)" rel="apple-touch-startup-image" />
<link href="{{ $config['splash']['1080x2160'] }}" media="(device-width: 540px) and (device-height: 1080px) and (-webkit-device-pixel-ratio: 2)" rel="apple-touch-startup-image" />

<!-- Tile for Win8 -->
<meta name="msapplication-TileColor" content="{{ $config['background_color'] }}">
<meta name="msapplication-TileImage" content="{{ data_get(end($config['icons']), 'src') }}">

<script type="text/javascript">
    // Initialize the service worker
    if ('serviceWorker' in navigator) {
        navigator.serviceWorker.register('/serviceWorker.js', {
            scope: '.'
        }).then(function (registration) {
            // Registration was successful
            console.log('ServiceWorker registration successful with scope: ', registration.scope);
            console.log("Online status: " + navigator.onLine);
        }, function (err) {
            // registration failed :(
            console.log('ServiceWorker registration failed: ', err);
            console.log("Online status: " + navigator.onLine);
        });
    }
</script>
