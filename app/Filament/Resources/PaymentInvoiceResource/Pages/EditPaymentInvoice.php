<?php

namespace App\Filament\Resources\PaymentInvoiceResource\Pages;

use App\Filament\Resources\PaymentInvoiceResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPaymentInvoice extends EditRecord
{
    protected static string $resource = PaymentInvoiceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }
}
