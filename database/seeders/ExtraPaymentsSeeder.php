<?php

namespace Database\Seeders;

use App\Models\ExtraPayments;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ExtraPaymentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ExtraPayments::create([
            'name' => 'Pago puesto Estacionamiento',
            'amount' => 10.2,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        ExtraPayments::create([
            'name' => 'Pago para fondo de reserva',
            'amount' => 1.5,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        ExtraPayments::create([
            'name' => 'Pago del Gas',
            'amount' => 1.5,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
