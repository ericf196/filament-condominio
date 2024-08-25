<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CondominiumBillInvoiceResource\Pages;
use App\Filament\Resources\CondominiumBillInvoiceResource\RelationManagers;
use App\Models\CondominiumBillInvoice;
use App\Models\ExtraPayments;
use Filament\Forms;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\HtmlString;
use Illuminate\Support\Str;
use Filament\Forms\Components\Component;
use Filament\Forms\Components\Actions\Action;

class CondominiumBillInvoiceResource extends Resource
{
    protected static ?string $model = CondominiumBillInvoice::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                /*TextInput::make('condominium_bill_id')
                    ->required()
                    ->numeric(),*/
                /*TextInput::make('apartment_id')
                    ->disabled(),*/

                Section::make('Informacion del Apartamento')
                    ->columns([
                        'sm' => 1,
                        'xl' => 2,
                    ])
                    ->schema([
                        TextInput::make('apartment_owner')->label('Propietario')->readOnly(),
                        TextInput::make('apartment_number_full')->label('Apartamento relacionado')->readOnly(),
                    ]),


                Section::make('Informacion relacionada al condominio')
                    ->columns([
                        'sm' => 1,
                        'xl' => 2,
                    ])
                    ->schema([
                        Forms\Components\DatePicker::make('issue_date')
                            ->native(false)
                            ->required(),
                        Forms\Components\Toggle::make('paid')
                            ->required(),
                        Section::make('Pagos Adicionales')
                            ->description('Seleccione uno o mas servicios adicionales')
                            ->aside()
                            ->schema([
                                CheckboxList::make('extraPayments')
                                    ->relationship(
                                        name: 'extraPayments',
                                titleAttribute: 'name',
                                modifyQueryUsing: fn (Builder $query) => $query->where('is_active', 1)
                                )->getOptionLabelFromRecordUsing(fn (ExtraPayments $record) => "{$record->name} {$record->amount} ")
                                ->hint(new HtmlString(Blade::render('<x-filament::loading-indicator class="h-5 w-5" wire:loading />')))
                                ->hintColor('primary')
                                ->live()
                                ->afterStateUpdated(function (Component $component, Get $get, Set $set, $state, $old, CondominiumBillInvoice $condominiumBillInvoice){
                                    self::updateTotals($get, $set, $state, $old, $component);
                                })
                           ]),
                        Section::make('Montos')
                            ->columns([
                                'sm' => 1,
                                'xl' => 2,
                            ])
                            ->schema([
                                TextInput::make('total_amount')
                                    ->required()
                                    ->readOnly()
                                    ->numeric(),
                                TextInput::make('amount_paid')
                                    ->required()
                                    ->numeric()
                                    ->readOnly()
                                    ->default(0.00),
                                TextInput::make('total')
                                    ->readOnly()
                                    ->suffixIcon('heroicon-m-currency-dollar')
                                    ->suffixIconColor('success')
                            ])
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('condominium_bill_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('apartment.apartment_number_full')
                    ->sortable(),
                Tables\Columns\TextColumn::make('total_amount')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('amount_paid')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('issue_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\IconColumn::make('paid')
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            RelationManagers\PaymentsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCondominiumBillInvoices::route('/'),
            'create' => Pages\CreateCondominiumBillInvoice::route('/create'),
            'edit' => Pages\EditCondominiumBillInvoice::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }

    public static function updateTotals($get, $set, $state, $old, $component):void {

        $extraPayments = $get('extraPayments');
        $extraPaymentTotal = 0;
        foreach ($extraPayments as $extra){

            $extraPayment = ExtraPayments::find($extra);
            $extraPaymentTotal += $extraPayment->amount;

        }
        //$set('old', );
        $set('total', $get('total_amount') + $extraPaymentTotal);

    }
}
