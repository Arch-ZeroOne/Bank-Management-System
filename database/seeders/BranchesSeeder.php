<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory;
use Illuminate\Support\Facades\DB;

class BranchesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create();
        $states = ['America','Korea','Philippines','Japan'];

        for($i = 0; $i <=1000; $i++){
            $select_state = rand(0,3);
            DB::table('branches') -> insert([
                'branch_name' => $faker -> word(),
                'address' => $faker -> address(),
                'city' => $faker -> city(),
                'state' => $states[$select_state],
                'zip_code' => $faker -> randomNumber(4,true),
            ]);
        }
    }
}
