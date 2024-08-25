<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PaymentInvoice extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'condominium_invoice_id',
        'amount',
        'payment_date'
    ];

    public function condominiumInvoice()
    {
        return $this->belongsTo(CondominiumBillInvoice::class);
    }
}
