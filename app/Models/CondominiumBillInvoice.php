<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CondominiumBillInvoice extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'condominium_bill_id',
        'apartment_id',
        'total_amount',
        'amount_paid',
        'issue_date',
        'paid'
    ];

    public function condominiumBill()
    {
        return $this->belongsTo(CondominiumBill::class);
    }

    public function apartment()
    {
        return $this->belongsTo(Apartment::class);
    }

    public function extraPayments()
    {
        return $this->belongsToMany(
            ExtraPayments::class,
            'condominium_extra_payment',
            'condominium_bill_invoice_id',
            'extra_payment_id')
            ->withPivot("amount")
            ->withTimestamps();
    }

    public function payments()
    {
        return $this->hasMany(PaymentInvoice::class);
    }
}
