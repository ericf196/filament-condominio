<?php

namespace App\Filament\Resources\ExtraPaymentsResource\Pages;

use App\Filament\Resources\ExtraPaymentsResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListExtraPayments extends ListRecords
{
    protected static string $resource = ExtraPaymentsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
