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
                'commission_1' => 0.00,
                'commission_2' => 0.00,
                'commission_3' => 0.00,
                'commission_4' => 0.00,
                'commission_5' => 0.00,
                'commission_6' => 0.00,
                'commission_7' => 0.00,
                'commission_8' => 0.00,
                'commission_9' => 0.00,
                'commission_10' => 0.00,        
            ], 
        ]);
    }
}
