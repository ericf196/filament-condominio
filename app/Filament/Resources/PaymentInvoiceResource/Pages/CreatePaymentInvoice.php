<?php

namespace App\Filament\Resources\PaymentInvoiceResource\Pages;

use App\Filament\Resources\PaymentInvoiceResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePaymentInvoice extends CreateRecord
{
    protected static string $resource = PaymentInvoiceResource::class;
}
