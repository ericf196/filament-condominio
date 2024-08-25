<?php

namespace App\Filament\Resources\CondominiumBillInvoiceResource\Pages;

use App\Filament\Resources\CondominiumBillInvoiceResource;
use App\Models\ExtraPayments;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCondominiumBillInvoice extends EditRecord
{
    protected static string $resource = CondominiumBillInvoiceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            /*Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),*/
        ];
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $condominiumBillInvoice = $this->record;

        $data['apartment_owner'] = $condominiumBillInvoice->apartment->owner->first_name;
        $data['apartment_number_full'] = $condominiumBillInvoice->apartment->apartment_number_full;

        $extraPaymnentPivot = 0;
        foreach ($condominiumBillInvoice->extraPayments as $extra){
            $extraPaymnentPivot = $extra->pivot->amount + $extraPaymnentPivot;

        }

        $data['total'] = $data['total_amount'] + $extraPaymnentPivot;

        return $data;
    }

    protected function afterSave(): void
    {
        $condominiumBillInvoice = $this->record;

        $extraPaymentsIds = $this->data['extraPayments'] ?? [];

        foreach ($extraPaymentsIds as $extraId){
            $extraPayment = ExtraPayments::find($extraId);
            $condominiumBillInvoice->extraPayments()->updateExistingPivot($extraId, [
                'amount' => $extraPayment->amount ,
            ]);
        }
    }
}
