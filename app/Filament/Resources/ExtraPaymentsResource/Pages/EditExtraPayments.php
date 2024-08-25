<?php

namespace App\Filament\Resources\ExtraPaymentsResource\Pages;

use App\Filament\Resources\ExtraPaymentsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditExtraPayments extends EditRecord
{
    protected static string $resource = ExtraPaymentsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }
}
