<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory;

class TransactionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create();
        $types = ['Deposit','Withdrawal','Transfer'];

        for($i = 0; $i <= 1000; $i++){
            $select_type = rand(0,2);
            DB::table("transactions") -> insert([
                'transaction_date' => $faker -> dateTime(),
                'transaction_type' => $types[$select_type],
                'amount' => $faker -> randomNumber(8,false),
                'description' => $faker -> sentence(4),
                'account_id' => $faker -> randomNumber(5,false),

            ]);
        }
    }
}
