<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Apartment extends Model
{
    use HasFactory;

    public function owner(): HasOne
    {
        return $this->hasOne(Owner::class);
    }
}
