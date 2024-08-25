<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Rate extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'amount', 'is_active'];

    /**
     * Get the CondominiumBills for the Rate.
     */
    public function condominiumBills()
    {
        return $this->belongsToMany(CondominiumBill::class, 'rate_condominium_bill');
    }
}
