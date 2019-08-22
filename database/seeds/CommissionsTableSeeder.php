<?php

use Illuminate\Database\Seeder;

class CommissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("commissions")->insert([
            [
                'commission_1' => 2.50,
                'commission_2' => 5.00,
                'commission_3' => 6.00,
                'commission_4' => 5.00,
                'commission_5' => 2.50,
                'commission_6' => 1.50,
                'commission_7' => 1.00,
                'commission_8' => 0.50,
                'commission_9' => 0.50,
                'commission_10' => 0.50,        
            ], 
        ]);
    }
}
