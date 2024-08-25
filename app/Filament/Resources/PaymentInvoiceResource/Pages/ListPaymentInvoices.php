<?php

namespace App\Filament\Resources\PaymentInvoiceResource\Pages;

use App\Filament\Resources\PaymentInvoiceResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPaymentInvoices extends ListRecords
{
    protected static string $resource = PaymentInvoiceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
