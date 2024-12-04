<?php

namespace App\Filament\Pages;

use App\Enums\TruncateFrequency;
use App\Models\Setting;
use Filament\Actions\Action;
use Filament\Facades\Filament;
use Filament\Forms\Components;
use Filament\Forms\Components\Actions;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;

class Settings extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static string $view = 'filament.pages.settings';

    protected static ?string $navigationGroup = 'System';

    protected static ?int $navigationSort = 120;

    public $truncate_events;

    public function mount(): void
    {
        $settingsArray = [];

        $settings = Setting::all();

        foreach ($settings as $setting) {
            $settingsArray[] = [
                "$setting->key" => $setting->value,
            ];
        }

        $this->form->fill([
            'truncate_events' => $settingsArray[0]['truncate_events'] ?? 'Never',
        ]);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([

                Tabs::make('Label')->tabs([
                    'General' => $this->generalTab(),
                ]),
            ])->model(Setting::class);
    }

    protected function generalTab()
    {
        return Tabs\Tab::make('General')
            ->schema(
                [
                    Components\Select::make('truncate_events')
                        ->options(TruncateFrequency::class)
                        ->hint('How frequently to delete events.'),

                        Actions::make([

                            Actions\Action::make('testWebSockets')
                                ->label('Test websockets')
                                ->action(function() {
                                    $recipient = auth()->user();

                                    Notification::make()
                                        ->title('If you see this websocket broadcasting is working.')
                                        ->success()
                                        ->broadcast($recipient);
                                })->color('gray'),
                        ]),
                ]);
    }

    public function create(): void
    {
        foreach ($this->form->getState() as $key => $value) {
            Setting::updateOrCreate(
                [
                    'tenant_id' => Filament::getTenant()->id,
                    'key' => $key,
                ],
                [
                    'value' => $value,
                ]
            );
        }

        // Display a notification that the settings have been saved
        Notification::make()
            ->title('Settings Saved')
            ->success()
            ->send();
    }

    public static function canAccess(): bool
    {
        return true;
    }
}
