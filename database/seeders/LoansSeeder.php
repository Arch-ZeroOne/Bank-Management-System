<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory;

class LoansSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create();
        $loan_types = ['Personal','Business','Secured','Student'];
        $status = ['Paid','Unpaid'];
        
        for($i = 0; $i <= 1000; $i++){
            $loan_select = rand( 0,3);
            $status_select = rand(0,1);
            DB::table('loans') -> insert([
                'loan_type' => $loan_types[$loan_select],
                'principal_amount' => $faker -> randomNumber('8',false),
                'interest_rate' => $faker -> randomFloat(1,20,60),
                'start_date' => $faker -> dateTime(),
                'end_date' => $faker -> dateTime(),
                'status' => $status[$status_select],
                'customer_id' => $faker -> randomNumber(5,false)
                

            ]);
        }
    }
}
