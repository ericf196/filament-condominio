<?php

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
        Schema::create('condominium_extra_payment', function (Blueprint $table) {
            $table->id();
            $table->foreignId('condominium_bill_invoice_id')->constrained()->onDelete('cascade');
            $table->foreignId('extra_payment_id')->constrained()->onDelete('cascade');
            $table->decimal('amount', 10,2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('condominium_extra_payment');
    }
};
