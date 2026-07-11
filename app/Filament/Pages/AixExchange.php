<?php

namespace App\Filament\Pages;

use App\Services\AixcoinPriceService;
use Filament\Actions\Action;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;

class AixExchange extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-currency-dollar';

    protected static ?string $navigationGroup = 'Aix Exchange';

    protected static ?string $navigationLabel = 'Set Aixcoin Price';

    protected static ?int $navigationSort = 1;

    protected static ?string $title = 'Aix Exchange — Aixcoin Price';

    protected static string $view = 'filament.pages.aix-exchange';

    public ?array $data = [];

    public function mount(AixcoinPriceService $aixcoin): void
    {
        $this->form->fill([
            'aixcoin_price' => (string) $aixcoin->current(),
        ]);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Aixcoin Price Control')
                    ->description('All other coins use live market prices. Aixcoin is controlled here — raise or reduce its USD price.')
                    ->schema([
                        TextInput::make('aixcoin_price')
                            ->label('Aixcoin Price (USD)')
                            ->numeric()
                            ->step('0.0001')
                            ->minValue(0)
                            ->prefix('$')
                            ->required()
                            ->helperText('Current price: $' . number_format(app(AixcoinPriceService::class)->current(), 4)),
                    ]),
            ])
            ->statePath('data');
    }

    public function getFormActions(): array
    {
        return [
            Action::make('save')
                ->label('Save Price')
                ->submit('save'),
            Action::make('raise')
                ->label('Raise by $0.05')
                ->color('success')
                ->action(fn () => $this->adjustPrice(0.05)),
            Action::make('reduce')
                ->label('Reduce by $0.05')
                ->color('danger')
                ->action(fn () => $this->adjustPrice(-0.05)),
        ];
    }

    public function save(AixcoinPriceService $aixcoin): void
    {
        $data = $this->form->getState();
        $aixcoin->recordChange((float) $data['aixcoin_price']);

        Notification::make()
            ->title('Aixcoin price updated')
            ->success()
            ->send();
    }

    private function adjustPrice(float $delta): void
    {
        $aixcoin = app(AixcoinPriceService::class);
        $new = max(0, $aixcoin->current() + $delta);
        $aixcoin->recordChange($new);

        $this->form->fill(['aixcoin_price' => (string) $new]);

        Notification::make()
            ->title('Aixcoin price ' . ($delta >= 0 ? 'raised' : 'reduced') . ' to $' . number_format($new, 4))
            ->success()
            ->send();
    }

    public static function shouldRegisterNavigation(): bool
    {
        return true;
    }
}
