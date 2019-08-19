<?php

use Illuminate\Database\Seeder;

class CyclesTableRequest extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("cycles")->insert([
            [
                'price' => 200.00,
            ], 
        ]);
    }
}
