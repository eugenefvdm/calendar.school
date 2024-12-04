<?php

use App\Http\Controllers\SocialiteController;
use App\PWA\PWAController;
use App\PWA\WebPushController;
use App\PWA\WebPushSubscriptionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Start PWA routes
Route::get('/app', function () {

    return view('pwa.landing', [
        'vapidPublicKey' => config('webpush.vapid.public_key')
    ]);
});

Route::group(['as' => 'pwa.'], function () {
    // So far, the /backupdashboard seems completely arbitrary, and the route is probably linked to the name or something
    Route::get('/manifest.json', [PWAController::class, 'manifestJson'])
        ->name('manifest');
    Route::get('/offline/', [PWAController::class, 'offline']);
});

Route::match(['post', 'put', 'delete'], '/push-subscription', [WebPushSubscriptionController::class, 'handle']);

Route::post('/send-notification', [WebPushController::class, 'sendNotification']);
// End PWA routes

// Socialite routes
Route::get('/auth/{provider}/redirect', [SocialiteController::class, 'redirect'])
    ->name('socialite.redirect');
Route::get('/auth/{provider}/callback', [SocialiteController::class, 'callback'])
    ->name('socialite.callback');
