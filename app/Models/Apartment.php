<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Apartment extends Model
{
    use HasFactory;

    protected $fillable = [
        'floor',
        'apartment_number',
        'area',
        'number_bathrooms',
        'other'
    ];

    public function owner(): HasOne
    {
        return $this->hasOne(Owner::class);
    }
}
