<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExtraPayments extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'amount',
    ];

    public function condominiumBillInvoices()
    {
        return $this->belongsToMany(CondominiumBillInvoice::class, 'condominium_extra_payment')->withTimestamps();
    }
}
