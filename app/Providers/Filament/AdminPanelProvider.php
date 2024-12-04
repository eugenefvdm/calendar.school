<?php

namespace App\Providers\Filament;

use App\Enums\Role;
use App\Filament\Pages\Tenancy\EditMyTenantProfile;
use App\Filament\Pages\Tenancy\RegisterNewTenant;
use App\Http\Middleware\ApplyTenantScopes;
use App\Models\Tenant;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Saade\FilamentLaravelLog\FilamentLaravelLogPlugin;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login()
            ->colors([
                'primary' => Color::Amber,
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
                Widgets\FilamentInfoWidget::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ])->tenant(Tenant::class)
            ->tenantRegistration(RegisterNewTenant::class)
            ->tenantProfile(EditMyTenantProfile::class)
            ->registration()
            ->passwordReset()
            ->tenantMiddleware([
                ApplyTenantScopes::class,
            ], isPersistent: true)
            ->sidebarCollapsibleOnDesktop()
            ->plugin(
                FilamentLaravelLogPlugin::make()
                    ->authorize(
                        fn () => auth()->user()->role === Role::SuperAdmin
                    )
            )
            ->databaseNotifications()
            ->renderHook(
                'panels::auth.login.form.after',
                fn () => view('auth.socialite.google')
            )
            ->profile(\App\Filament\Pages\Auth\EditProfile::class);
    }
}
