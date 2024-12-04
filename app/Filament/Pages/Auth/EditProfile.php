<?php

namespace App\Filament\Pages\Auth;

use App\Notifications\WebpushNotification;
use Filament\Facades\Filament;
use Filament\Forms\Components\Actions;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\ViewField;
use Filament\Forms\Form;
use Filament\Pages\Auth\EditProfile as BaseEditProfile;

class EditProfile extends BaseEditProfile
{
    public function form(Form $form): Form
    {
        return $form
            ->schema([

                Tabs::make('Label')->tabs([
                    'Profile' => $this->profileTab(),
                ]),

                Tabs::make('Label')->tabs([
                    'Settings' => $this->settingsTab(),
                ]),


            ]);
    }

    private function profileTab()
    {
        return Tabs\Tab::make('Profile')
            ->schema(
                [
                    $this->getNameFormComponent(),

                    $this->getEmailFormComponent(),

                    $this->getPasswordFormComponent(),

                    $this->getPasswordConfirmationFormComponent(),
                ]
            );
    }

    private function settingsTab()
    {
        return Tabs\Tab::make('App settings')
            ->schema(
                [

                    Fieldset::make('Notifications')->schema([
                        Toggle::make('enableNotifications')
                            ->label(''),

                        Actions::make([
                            Action::make('test')
                                ->action(function () {
                                    $recipient = auth()->user();

                                    $recipient->notify(new WebpushNotification());
                                })->color('gray'),
                        ]),
                    ]),

                    Actions::make([
                        Action::make('diagnostics')->url('/app'),
                    ]),

                    ViewField::make('installApp')
                        ->view('filament.forms.components.install-app'),

                ]
            );
    }
}

