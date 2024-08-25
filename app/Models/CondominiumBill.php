<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class CondominiumBill extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'amount',
        'start_date',
        'end_date',
        'document',
        'created_by',
    ];

    /**
     * Get the rates for the CondominiumBill.
     */
    public function rates()
    {
        return $this->belongsToMany(Rate::class, 'rate_condominium_bill');
    }
}
