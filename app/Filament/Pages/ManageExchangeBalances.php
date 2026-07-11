<?php

namespace App\Filament\Pages;

use App\Models\User;
use App\Services\ExchangeMarketService;
use Filament\Actions\Action;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Illuminate\Support\HtmlString;

class ManageExchangeBalances extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-banknotes';

    protected static ?string $navigationGroup = 'Aix Exchange';

    protected static ?string $navigationLabel = 'Manage Balances';

    protected static ?int $navigationSort = 5;

    protected static ?string $title = 'Manage Exchange Balances';

    protected static string $view = 'filament.pages.manage-exchange-balances';

    public ?array $data = [];

    public function mount(ExchangeMarketService $market): void
    {
        $this->form->fill([
            'user_id' => null,
            'symbol' => 'AIX',
            'operation' => 'add',
            'amount' => null,
        ]);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Select User')
                    ->schema([
                        Select::make('user_id')
                            ->label('User')
                            ->searchable()
                            ->getSearchResultsUsing(function (string $search): array {
                                return User::query()
                                    ->where('name', 'like', "%{$search}%")
                                    ->orWhere('email', 'like', "%{$search}%")
                                    ->limit(50)
                                    ->get()
                                    ->mapWithKeys(fn (User $user) => [$user->id => "{$user->name} ({$user->email})"])
                                    ->all();
                            })
                            ->getOptionLabelUsing(fn ($value): ?string => optional(User::find($value), fn (User $user) => "{$user->name} ({$user->email})"))
                            ->live()
                            ->required(),
                        Placeholder::make('balances')
                            ->label('Current Exchange Balances')
                            ->content(function (Get $get): string {
                                $userId = $get('user_id');

                                if (! $userId) {
                                    return 'Select a user to view balances.';
                                }

                                $user = User::find($userId);

                                if (! $user) {
                                    return 'User not found.';
                                }

                                $balances = app(ExchangeMarketService::class)->getExchangeBalancesForUser($user);
                                $lines = collect($balances)
                                    ->map(fn (array $row) => sprintf(
                                        '%s: %s units ($%s)',
                                        $row['symbol'],
                                        rtrim(rtrim(number_format($row['balance'], 8), '0'), '.'),
                                        number_format($row['value_usd'], 2)
                                    ))
                                    ->implode('<br>');

                                return new HtmlString($lines ?: 'No exchange balances yet.');
                            })
                            ->columnSpanFull(),
                    ]),
                Section::make('Add / Remove Balance')
                    ->description('Manual adjustments only. Approved exchange deposits are credited to the user AIX balance automatically.')
                    ->schema([
                        Select::make('symbol')
                            ->label('Coin')
                            ->options(collect(app(ExchangeMarketService::class)->exchangeSymbols())
                                ->mapWithKeys(fn (string $symbol) => [$symbol => $symbol])
                                ->all())
                            ->required(),
                        Select::make('operation')
                            ->label('Operation')
                            ->options([
                                'add' => 'Add',
                                'subtract' => 'Subtract',
                            ])
                            ->required(),
                        TextInput::make('amount')
                            ->label('Amount (coin units)')
                            ->numeric()
                            ->minValue(0.01)
                            ->required(),
                    ]),
            ])
            ->statePath('data');
    }

    public function getFormActions(): array
    {
        return [
            Action::make('updateBalance')
                ->label('Update Balance')
                ->submit('updateBalance'),
        ];
    }

    public function updateBalance(ExchangeMarketService $market): void
    {
        $data = $this->form->getState();
        $user = User::find($data['user_id']);

        if (! $user) {
            Notification::make()->title('User not found')->danger()->send();

            return;
        }

        $success = $market->adjustUserBalance(
            $user,
            $data['symbol'],
            (float) $data['amount'],
            $data['operation']
        );

        if (! $success) {
            Notification::make()->title('Insufficient balance')->warning()->send();

            return;
        }

        $this->form->fill([
            'user_id' => $data['user_id'],
            'symbol' => $data['symbol'],
            'operation' => $data['operation'],
            'amount' => null,
        ]);

        Notification::make()->title('Exchange balance updated')->success()->send();
    }

    public static function shouldRegisterNavigation(): bool
    {
        return true;
    }
}
