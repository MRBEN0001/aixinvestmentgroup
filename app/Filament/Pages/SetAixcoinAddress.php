<?php

namespace App\Filament\Pages;

use App\Models\CompanyWallet;
use Filament\Actions\Action;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;

class SetAixcoinAddress extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-wallet';

    protected static ?string $navigationGroup = 'Aix Exchange';

    protected static ?string $navigationLabel = 'Set Aixcoin Address';

    protected static ?int $navigationSort = 2;

    protected static ?string $title = 'Aix Exchange — Aixcoin Deposit Address';

    protected static string $view = 'filament.pages.set-aixcoin-address';

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill([
            'aixcoin_deposit_address' => CompanyWallet::query()
                ->where('abbr', 'AIX')
                ->value('wallet_address') ?? '',
        ]);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Aixcoin Deposit Address')
                    ->description('This wallet address is shown when users deposit AIX on the exchange.')
                    ->schema([
                        TextInput::make('aixcoin_deposit_address')
                            ->label('AIX Wallet Address')
                            ->placeholder('Enter the Aixcoin deposit wallet address')
                            ->required()
                            ->maxLength(255)
                            ->helperText('Users will see this address on the exchange deposit page after selecting Aixcoin.'),
                    ]),
            ])
            ->statePath('data');
    }

    public function getFormActions(): array
    {
        return [
            Action::make('save')
                ->label('Save Address')
                ->submit('save'),
        ];
    }

    public function save(): void
    {
        $data = $this->form->getState();
        $address = trim($data['aixcoin_deposit_address'] ?? '');

        CompanyWallet::updateOrCreate(
            ['abbr' => 'AIX'],
            [
                'coin' => 'Aixcoin',
                'wallet_address' => $address,
            ]
        );

        Notification::make()
            ->title('Aixcoin deposit address saved')
            ->success()
            ->send();
    }

    public static function shouldRegisterNavigation(): bool
    {
        return true;
    }
}
