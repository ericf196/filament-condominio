<?php

namespace App\Filament\Resources\CondominiumBillInvoiceResource\Pages;

use App\Filament\Resources\CondominiumBillInvoiceResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCondominiumBillInvoices extends ListRecords
{
    protected static string $resource = CondominiumBillInvoiceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            //Actions\CreateAction::make(),
        ];
    }
}
