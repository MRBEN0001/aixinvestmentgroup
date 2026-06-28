<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TeslaProductResource\Pages;
use App\Models\TeslaProduct;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\HtmlString;

class TeslaProductResource extends Resource
{
    protected static ?string $model = TeslaProduct::class;

    protected static ?string $navigationIcon = 'heroicon-o-truck';

    protected static ?string $navigationLabel = 'Tesla Products';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255),
                Forms\Components\FileUpload::make('images')
                    ->label('Product Images')
                    ->image()
                    ->multiple()
                    ->disk('public')
                    ->directory('tesla-products')
                    ->helperText('Upload one or more images for this product.')
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('description')
                    ->required()
                    ->rows(5)
                    ->columnSpanFull(),
                Forms\Components\TagsInput::make('features')
                    ->label('Product Features')
                    ->placeholder('Add a feature')
                    ->helperText('Press Enter after each feature.')
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('price')
                    ->required()
                    ->numeric()
                    ->prefix('$'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('image')
                    ->label('Images')
                    ->html()
                    ->formatStateUsing(function (TeslaProduct $record): HtmlString {
                        if (empty($record->product_images)) {
                            return new HtmlString('<span style="color:#9ca3af;">No image</span>');
                        }

                        $title = e($record->title);
                        $images = collect($record->product_images)
                            ->take(9)
                            ->map(function (string $image) use ($title): string {
                                $imageUrl = e($image);

                                return "<img src=\"{$imageUrl}\" alt=\"{$title}\" style=\"width:42px;height:42px;object-fit:cover;border-radius:6px;\" />";
                            })
                            ->implode('');

                        return new HtmlString("<div style=\"display:grid;grid-template-columns:repeat(3,42px);gap:6px;width:138px;max-width:138px;\">{$images}</div>");
                    }),
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('price')
                    ->money('USD')
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTeslaProducts::route('/'),
            'create' => Pages\CreateTeslaProduct::route('/create'),
            'edit' => Pages\EditTeslaProduct::route('/{record}/edit'),
        ];
    }
}
