<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CondominiumBillResource\Pages;
use App\Filament\Resources\CondominiumBillResource\RelationManagers;
use App\Filament\Resources\CondominiumBillResource\RelationManagers\RatesRelationManager;
use App\Http\Controllers\CondominiumBill\CondominiumBillController;
use App\Models\CondominiumBill;
use App\Models\Owner;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Infolists\Components\TextEntry;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Enums\ActionsPosition;
use Filament\Tables\Actions\Action;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Components\Wizard\Step;
use Filament\Tables\Columns\Layout\View;
use Illuminate\Support\HtmlString;
use Filament\Infolists\Components\Section;
use Filament\Support\Enums\MaxWidth;

class CondominiumBillResource extends Resource
{
    protected static ?string $model = CondominiumBill::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('amount')
                    ->required()
                    ->numeric(),
                Forms\Components\DatePicker::make('start_date')
                    ->native(false)
                    ->prefix('Inicia')
                    ->closeOnDateSelection()
                    ->suffixIcon('heroicon-m-calendar')
                    ->required(),
                Forms\Components\DatePicker::make('end_date')
                    ->native(false)
                    ->prefix('Finaliza')
                    ->closeOnDateSelection()
                    ->suffixIcon('heroicon-m-calendar')
                    ->required(),
                Forms\Components\FileUpload::make('document')
                    ->required()
                    ->openable()
                    ->downloadable()
                    /*->previewable()*/
                    ->acceptedFileTypes(['application/pdf']),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('amount')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('start_date')
                    ->date()
                    ->sortable(),
                TextColumn::make('end_date')
                    ->date()
                    ->sortable(),
                TextColumn::make('month_year')
                    ->searchable(),
                TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Action::make('Enviar')
                    ->icon('heroicon-s-share')
                    ->form([
                        TextInput::make('name'),
                        TextInput::make('amount')

                    ])->fillForm(fn (CondominiumBill $condominiumBill): array => [
                        'name' => $condominiumBill->name,
                        'amount' => $condominiumBill->amount,
                    ])
                    ->disabledForm()
                    ->action(function (CondominiumBill $condominiumBill, array $data): void {
                        app(CondominiumBillController::class)->sendCondominiumBillMail($condominiumBill);

                        Notification::make()
                            ->title("Prueba")
                            ->success()
                            ->send();
                    })
                    ->requiresConfirmation()
                    ->modalWidth(MaxWidth::FiveExtraLarge)

                    /*->requiresConfirmation()*/
                    /*->steps([
                        Step::make('Name')
                            ->icon('heroicon-o-envelope')
                            ->description('Give the category a unique name')
                            ->schema([
                                //Owner::query()->get()->each(function ($item, $key) {
                                TextEntry::make('name')
                                    ->helperText(new HtmlString('Your <strong>full name</strong> here, including any middle names.'))
                                //})
                            ]),
                        Step::make('Freitez')
                            ->description('Give the category a unique name')
                            ->schema([
                                TextInput::make('name2')
                                    ->live()
                                ->afterStateUpdated(fn ($state, callable $set) => $set('slug', Str::slug($state))),
                                TextInput::make('slug')
                                    ->disabled()
                                    ->required(),
                            ])
                            ->columns(2),
                    ])->action(function (CondominiumBill $condominiumBill, array $data): void {
                        app(CondominiumBillController::class)->sendCondominiumBillMail($condominiumBill);

                        Notification::make()
                            ->title("Prueba")
                            ->success()
                            ->send();
                    })*/
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            RatesRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCondominiumBills::route('/'),
            'create' => Pages\CreateCondominiumBill::route('/create'),
            'edit' => Pages\EditCondominiumBill::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
