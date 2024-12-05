# The Calendar School App

A mobile friendly, multi-tenant application for student class management.

## Landing page

Thus far, the landing page has an animation.
In the future, this page will ask you to install the application.

## Roles

- SuperAdmin
- Admin
- Teacher
- Student
- Parent/Guardian

## Workflow Models

- The year is broken into four terms. Terms have start and stop dates.
- There are subjects and classes.
- A teacher has many students.
- There are venues.
- A student has attended a class. The number of classes attended to goes up and is used in reporting.
- A student has missed a class due to being absent with excuse (called `excused`).
- A student has missed a class and the class/fee is being `forfeit`.
- A student can belong to a guardian (optional).
- Guardians may be informed about a student's attendance.
- Students may be informed about their attendance summarized.

## Technical features

- The app is enabled for web push notifications (not in use).
- The app is configured for websocket notifications (not in use).

## Policy files and permissions

By default, tenants should not be able to see users, so we're using a standard policy file.

### Logo and images

The logo and images are stored in `/public/img`.

# Installation

## Key elements of the installation (an overview)

Setting up Laravel, Laravel Herd, Websockets service for Herd, 
Filament, Reverb, Webpush, and Websockets is a lot of work.

Here is a high level overview of the steps:

- After creating a new Laravel project, activate Laravel Herd SSL
- Add Laravel Socialite
- Copied over the controller for Socialite
- Copied over socialite.google view blade
- Copied over web routes for oAuth
- Added `.env` for oAuth
- Prepped the User model for Filament (implements and required methods)
- Install Notification Channels, Webpush
- Install migrations for Webpush
- Import Setting (Tenant Setting) model
- Copy filament.forms.components.install-app

## Installing Filament

Be sure to publish the configuration file otherwise Laravel `Echo` won't work:

```bash
php artisan vendor:publish --tag=filament-config
```

Then uncomment this (see Povilas article about websockets and FilamentPHP):

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

## Configuration

- Add name of app to `.env` on both localhost and the Forge server.
- Add `APP_SHORT_NAME` to `.env` and `short_name` to `app.php`. This is used by the mobile app.

```php
'short_name' => env('APP_SHORT_NAME', 'Laravel'),
```

- Set the correct `APP_TIMEZONE`
- Copy `Notificications`, which are WebpushNotificationTest and NewTenantSignup
- Install Reverb
- `composer require laravel/reverb`
- `php artisan reverb:install`
- `php artisan install:broadcasting`
- Ensure Filament broadcasting is enabled by reviewing the config file Laravel Daily supplies.

## Queues

Make the queue connection sync otherwise you have to
start a queue every time for Reverb websocket notifications
and can miss important workflows form happening, e.g., testing the websockets.

Reverb needs these six settings to work with Laravel Herd's Reverb Nginx reverse proxy implementation:

```dotenv
REVERB_APP_ID=1001
REVERB_APP_KEY=laravel-herd
REVERB_APP_SECRET=secret
REVERB_HOST="reverb.herd.test"
REVERB_PORT=443
REVERB_SCHEME=https
```

## Environment checks

Make sure these environment variables below are changed.
Reverb should update the broadcast connection by itself after installation.
The queueing is to simplify testing.

Check:

```dotenv
BROADCAST_CONNECTION=log
QUEUE_CONNECTION=database
```

Must be:

```dotenv
BROADCAST_CONNECTION=reverb
QUEUE_CONNECTION=sync
```

# Installation & Troubleshooting

## PWA

Check Inspect Application to see manifest issues.

PWA installation process:

- PWA directories for the Controller, and WebPush Stuff
- PWA resources folder
- PWA `config/pwa.php` AND `config/webpush.php`
- Add `.env` settings for VAPID
- public/pwa directory
- `APP_URL` must be SSL
- AppServiceProvider:

```php
    // Used for Social login, see Laravel Daily article.
    URL::forceScheme('https');

    // Used by the PWA, super important that there are no issues.
    FilamentView::registerRenderHook(
        PanelsRenderHook::HEAD_END,
        fn (): string => Blade::render('<link rel="manifest" href="' . config('app.url') . '/manifest.json">'),
    );
```

Other:

- Copy over the `layouts/pwa` and its associated view component.

## Back Office

The user's profile page has a section for App diagnostics,
which can be used in conjunction with Inspect Element to see 
PWA application issues.

## oAuth Errors

The oAuth implementation was based on this course with some multi-tenant magic thrown in:
https://laraveldaily.com/post/filament-sign-in-with-google-using-laravel-socialite

oAuth can fail at various points. This often is because it is not setup properly at Google.

### Google Link

Google link for oAuth credentials troubleshooting:
https://console.cloud.google.com/apis/credentials?pli=1

### oAuth error #1

```bash
[2024-12-03 20:38:49] production.ERROR: Trying to access array offset on null {"exception":"[object] (ErrorException(code: 0): Trying to access array offset on null at /home/forge/example.com/vendor/laravel/socialite/src/SocialiteManager.php:227)
```

See Povilas course, in services:

```php
'google' => [
    'client_id'     => env('GOOGLE_CLIENT_ID'),
    'client_secret' => env('GOOGLE_CLIENT_SECRET'),
    'redirect'      => '/auth/google/callback',
],
```

### oAuth error #2

This error happened on a production server working perfectly before.

```bash
[2024-12-05 09:28:07] production.ERROR:  {"exception":"[object] (Laravel\\Socialite\\Two\\InvalidStateException(code: 0):  at /home/forge/example.com/vendor/laravel/socialite/src/Two/AbstractProvider.php:237)
```
