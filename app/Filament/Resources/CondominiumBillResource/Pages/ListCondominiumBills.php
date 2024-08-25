<?php

namespace App\Filament\Resources\CondominiumBillResource\Pages;

use App\Filament\Resources\CondominiumBillResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCondominiumBills extends ListRecords
{
    protected static string $resource = CondominiumBillResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
