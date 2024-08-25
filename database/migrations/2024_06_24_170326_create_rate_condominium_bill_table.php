<?php

use App\Models\CondominiumBill;
use App\Models\Rate;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('rate_condominium_bill', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(CondominiumBill::class);
            $table->foreignIdFor(Rate::class);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rate_condominium_bill');
    }
};
