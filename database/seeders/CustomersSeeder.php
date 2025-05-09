<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class CustomersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        for($i = 0; $i <= 1000; $i++){
            DB::table('customer') -> insert([
                'first_name' => $faker -> firstName(),
                'last_name' => $faker -> lastName(),
                'date_of_birth' => $faker -> dateTime(),
                'email' => $faker -> email(),
                'phone_number' => $faker -> phoneNumber(),
                'address' => $faker -> address(),
                'date_joined'=> $faker -> dateTime(),
            ]);
        }
    }
}
