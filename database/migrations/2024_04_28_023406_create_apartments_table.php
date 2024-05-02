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
        Schema::create('apartments', function (Blueprint $table) {
            $table->id();
            $table->integer('floor');
            $table->integer('apartment_number');
            $table->string('area')->nullable();
            $table->integer('number_bathrooms')->default(1);
            $table->text('other')->nullable();
            $table->string('apartment_number_full')->virtualAs("CONCAT(floor, '-', apartment_number)");
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('apartments');
    }
};
