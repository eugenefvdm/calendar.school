<?php

namespace App\Filament\Pages\Tenancy;

use App\Enums\Role;
use App\Models\Tenant;
use App\Models\User;
use App\Notifications\NewTenantSignup;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Pages\Tenancy\RegisterTenant;

class RegisterNewTenant extends RegisterTenant
{
    public static function getLabel(): string
    {
        return 'Register';
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->helperText('The name of your business or entity.')
                    ->columnSpanFull(),
            ]);
    }

    protected function handleRegistration(array $data): Tenant
    {
        $tenant = Tenant::create($data);

        $tenant->users()->attach(auth()->user());

        // Send a new notification to Super Admins about this new signup
        // This stopped working: The "" scheme is not supported; supported schemes for mailer "smtp" are: "smtp", "smtps"
//        foreach (User::whereRole(Role::SuperAdmin)->get() as $admin) {
//            $admin->notify(new NewTenantSignup);
//        }

        return $tenant;
    }
}
