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
        Schema::create('condominium_bills', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->float('amount',  2);
            $table->date('start_date');
            $table->date('end_date');
            $table->string('month_year')->virtualAs("DATE_FORMAT(start_date,'%m/%Y')");
            $table->string('document');
            $table->integer('created_by');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('condominium_bills');
    }
};
