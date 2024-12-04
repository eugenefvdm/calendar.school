# The Music HQ App

## https://themusichq.com

## Installing Filament

Be sure to publish the configuration file otherwise Echo won't work.

```bash
php artisan vendor:publish --tag=filament-config
```

Then uncomment this:

```php
'broadcasting' => [

        'echo' => [
            'broadcaster' => 'reverb',
            'key' => env('VITE_REVERB_APP_KEY'),
            'cluster' => env('VITE_REVERB_APP_CLUSTER'),
            'wsHost' => env('VITE_REVERB_HOST'),
            'wsPort' => env('VITE_REVERB_PORT'),
            'wssPort' => env('VITE_REVERB_PORT'),
            'authEndpoint' => '/broadcasting/auth',
            'disableStats' => true,
            'encrypted' => true,
            'forceTLS' => false,
        ],

    ],
```

## Permissions

By default, the tenants should not be able to see Users, so copy the policy files across.

## configuration

- Add name of app to .env on both localhost and Forge
- Add app_short_name to .env and app.php:

```php
'short_name' => env('APP_SHORT_NAME', 'Laravel'),
```

- Set the correct `APP_TIMEZONE`
- Copy `Notificications`, which are WebpushNotificationTest and NewTenantSignup
- Install Reverb
- Composer install Laravel Reverb
- php artisan reverb:install
- php artisan install:broadcasting
- Make queue connection sync otherwise you have to start a queue every time for reverb
- Ensure Filament broadcasting is enabled

Reverb needs six settings:

```dotenv
REVERB_APP_ID=1001
REVERB_APP_KEY=laravel-herd
REVERB_APP_SECRET=secret
REVERB_HOST="reverb.herd.test"
REVERB_PORT=443
REVERB_SCHEME=https
```

## Installation

- Herd SSL
- Add Laravel Socialite 
- Copy over controller for Socialite
- Copy over socialite.google view
- Copy over web routes for oAuth
- Add .env for oAuth
- Add to the user model for socialite?
- Prep the User model for Filament (implements and required methods)
- Install Notification Channels, Webpush
- Install migrations for Webpush
- Import Setting (Tenant Setting) model
- Copy filament.forms.components.install-app

PWA STUFF

- PWA directories for the Controller, and WebPush Stuff
- PWA resources folder
- PWA config/pwa.php AND config/webpush.php
- Add .env settings for VAPID
- public/pwa directory
- APP URL must be SSL
- AppServiceProvider:

```php
    // See https://laraveldaily.com/post/filament-sign-in-with-google-using-laravel-socialite
    URL::forceScheme('https');

    FilamentView::registerRenderHook(
        PanelsRenderHook::HEAD_END,
        fn (): string => Blade::render('<link rel="manifest" href="' . config('app.url') . '/manifest.json">'),
    );
```

Other

- Copy over the layouts/pwa and its associated view component.

Check ENV:

- BROADCAST_CONNECTION=log
- FILESYSTEM_DISK=local
- QUEUE_CONNECTION=database

### Check Inspect Application to see manifest issues

### Landing page

This page asks you to install the application.

### Roles

- SuperAdmin
- Admin
- Teacher
- Student
- Parent/Guardian

### Models

- Classes
- A teacher has many classes
- A Student can belong to a guardian (optional)
- A Student attends a class
- A Student can miss a class due to being absent

### Logo

The logo is stored in `/public/img`

### Back Office

The user's profile page has a section for App diagnostics

## oAuth Errors

^[[2024-12-03 20:38:49] production.ERROR: Trying to access array offset on null {"exception":"[object] (ErrorException(code: 0): Trying to access array offset on null at /home/forge/themusichq.com/vendor/laravel/socialite/src/SocialiteManager.php:227)

See Povilas course, in services:

```php
'google' => [
    'client_id'     => env('GOOGLE_CLIENT_ID'),
    'client_secret' => env('GOOGLE_CLIENT_SECRET'),
    'redirect'      => '/auth/google/callback',
],
```

Google link for oAuth credentials troubleshooting:

https://console.cloud.google.com/apis/credentials?pli=1

