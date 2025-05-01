<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory;
use Illuminate\Support\Facades\DB;

class EmployeesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create();
        $positions = ['Bank Teller','Customer Service','Personal Banker','Loan Officer'];

        for($i = 0; $i <= 1000; $i++){
            $rand_position = rand(0,3);
            DB::table("employees") -> insert([
                'first_name' => $faker -> firstName(),
                'last_name' => $faker -> lastName(),
                'email' => $faker -> email(),
                'phone_number' => $faker -> phoneNumber(),
                'position' => $positions[$rand_position],
                'hire_date' => $faker -> dateTime(),
                'branch_id' =>  $faker -> randomNumber(5,false),
            ]);

        }
    }
}
