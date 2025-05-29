<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory;


class LoanApprovalsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create();
        $status = ['Approved','Rejected','Ongoing'];

        for ($i = 0; $i <= 1000; $i++) {
            $select_status = rand(0,2);
            DB::table('loan_approvals') -> insert([
                'approval_date' => $faker -> dateTime(),
                'status' => $status[$select_status],
                'employee_id' => $faker -> randomNumber(5,false), 
                'loan_id' => $faker -> randomNumber(5,false),

            ]);

    } 
}
}
