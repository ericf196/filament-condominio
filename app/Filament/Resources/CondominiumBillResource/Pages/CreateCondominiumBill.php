<?php

namespace App\Filament\Resources\CondominiumBillResource\Pages;

use App\Filament\Resources\CondominiumBillResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateCondominiumBill extends CreateRecord
{
    protected static string $resource = CondominiumBillResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['created_by'] = auth()->id();

        return $data;
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
