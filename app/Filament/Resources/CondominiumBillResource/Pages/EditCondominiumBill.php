<?php

namespace App\Filament\Resources\CondominiumBillResource\Pages;

use App\Filament\Resources\CondominiumBillResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCondominiumBill extends EditRecord
{
    protected static string $resource = CondominiumBillResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }


}
