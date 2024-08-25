<?php

namespace App\Http\Controllers\CondominiumBill;

use App\Http\Controllers\Controller;
use App\Jobs\SendEmailCondominiumBill;
use App\Models\Apartment;
use App\Models\CondominiumBill;
use App\Models\CondominiumBillInvoice;
use Carbon\Carbon;
use function Filament\Forms\Components\Concerns\json;
use Illuminate\Http\Request;

class CondominiumBillController extends Controller
{
    function sendCondominiumBillMail(CondominiumBill $condominiumBill) {

        //SendEmailCondominiumBill::dispatch($condominiumBill);

        $apartments = Apartment::all();

        $apartments->each(function ($apartment, $key) use ($condominiumBill) {
            CondominiumBillInvoice::create([
                "condominium_bill_id" => $condominiumBill->id,
                "apartment_id" => $apartment->id,
                "total_amount" => $condominiumBill->amount,
                "amount_paid" => 0,
                "issue_date" => Carbon::now()->format('Y-m-d'),
                "paid" => false,
            ]);
        });

        return response()->json(["success" => true, "message" => "Respuesta del servidor"]);
    }
}
