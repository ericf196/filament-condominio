<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OwnerResource\Pages;
//use App\Filament\Resources\OwnerResource\RelationManagers;
use App\Models\Owner;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;

class OwnerResource extends Resource
{
    protected static ?string $model = Owner::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $modelLabel = 'Propietario';

    protected static ?string $pluralModelLabel = 'Propietarios';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('first_name')
                    ->minLength(4)
                    ->maxLength(255)
                    ->label('Nombres')
                    ->autoComplete(false)
                    ->required(),
                TextInput::make('last_name')
                    ->minLength(4)
                    ->maxLength(255)
                    ->label('Apellidos')
                    ->autoComplete(false)
                    ->required(),
                TextInput::make('email')
                    ->email()
                    ->label('E-mail')
                    ->required(),
                TextInput::make('phone')
                    ->tel()
                    ->label('Telefono')
                    ->telRegex('/^[+]*[(]{0,1}[0-9]{1,4}[)]{0,1}[-\s\.\/0-9]*$/')
                    ->required(),
                Select::make('apartment_id')
                    ->relationship('apartment', 'apartment_number_full')
                    ->label('Apartamento')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('first_name')->label('Nombres'),
                TextColumn::make('last_name')->label('Apellidos'),
                TextColumn::make('email')->label('Correo'),
                TextColumn::make('phone')->label('Telefono'),
                TextColumn::make('apartment.apartment_number_full')->label('Numero apartamento'),
            ])
            ->filters([
                //
            ])
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
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOwners::route('/'),
            'create' => Pages\CreateOwner::route('/create'),
            'edit' => Pages\EditOwner::route('/{record}/edit'),
        ];
    }

}
