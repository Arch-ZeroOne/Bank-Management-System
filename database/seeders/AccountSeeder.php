<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

use Illuminate\Support\Facades\DB;
class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       $faker = Faker::create();
       $accountTypes = ['Savings','Checking','Basic'];
       $status = [1,0];
   for($i = 0; $i <= 1000; $i++){
     $random = rand(0,2);
     $random2 = rand(0,1);

       DB::table('accounts') -> insert([
        'account_number' => $faker -> randomNumber(9,true),
        'account_type' => $accountTypes[$random],
        'balance' => $faker -> randomNumber(8,false),
        'opened_date' => $faker -> dateTime(),
        'status' => $status[$random2],
        'customer_id' => $faker -> randomNumber(5,false),

       ]);
    }
    }
}
