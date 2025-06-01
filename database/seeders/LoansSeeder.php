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
        $rates =  [
            1.0, 1.5, 2.0, 2.5, 3.0,
            3.5, 4.0, 4.5, 5.0, 5.5,
            6.0, 6.5, 7.0, 7.5, 8.0,
            8.5, 9.0, 9.5, 10.0, 10.5,
            11.0, 11.5, 12.0
                    ];
            
        
        for($i = 0; $i <= 1000; $i++){
            $loan_select = rand( 0,3);
            $status_select = rand(0,1);
            $rate_select = rand(0,count($rates));
            DB::table('loans') -> insert([
                'loan_type' => $loan_types[$loan_select],
                'principal_amount' => $faker -> randomNumber('8',false),
                'interest_rate' =>  $rate_select,
                'start_date' => $faker -> dateTime(),
                'end_date' => $faker -> dateTime(),
                'status' => $status[$status_select],
                'customer_id' => $faker -> randomNumber(5,false)
                

            ]);
        }
    }
}
