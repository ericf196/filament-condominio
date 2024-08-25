<?php

namespace Database\Seeders;

use App\Models\Apartment;
use App\Models\Owner;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OwnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $apartment = Apartment::create([
            'floor' => 4,
            'apartment_number' => 1,
            'area' => NULL,
            'number_bathrooms' => 1,
            'other' => NULL,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        Owner::create([
            'first_name' => 'Arminda Coromoto',
            'last_name' => 'Osorio',
            'email' => 'armindaosorio44@gmail.com',
            'phone' => '04148563751',
            'apartment_id' => $apartment->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        $apartment = Apartment::create([
            'floor' => 4,
            'apartment_number' => 2,
            'area' => NULL,
            'number_bathrooms' => 1,
            'other' => NULL,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        Owner::create([
            'first_name' => 'Belkis Tesorina',
            'last_name' => 'Atacho Paez',
            'email' => 'atacho@gmail.com',
            'phone' => '04148563751',
            'apartment_id' => $apartment->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        $apartment = Apartment::create([
            'floor' => 4,
            'apartment_number' => 3,
            'area' => NULL,
            'number_bathrooms' => 1,
            'other' => NULL,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);


        Owner::create([
            'first_name' => 'Maritza Sinforosa',
            'last_name' => 'Garcia Morales',
            'email' => 'maritza@gmail.com',
            'phone' => '04125296378',
            'apartment_id' => $apartment->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        $apartment = Apartment::create([
            'floor' => 4,
            'apartment_number' => 4,
            'area' => NULL,
            'number_bathrooms' => 1,
            'other' => NULL,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        Owner::create([
            'first_name' => 'Francisca Antonia',
            'last_name' => 'Gonzalez',
            'email' => 'francisca44@gmail.com',
            'phone' => '04147451963',
            'apartment_id' => $apartment->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
