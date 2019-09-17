<?php

use Illuminate\Database\Seeder;

class ProductTablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $array = [];
        for ($i = 0; $i < 10; $i++) {
            $array['reference'] = 'RF' . $i;
            $array['name'] = 'Produto ' . $i;
            $array['description'] = 'Descrição ' . $i;
            $array['price'] = 10.00;
            $array['status'] = 1;
            $array['weight'] = 15;
            $array['height'] = 12;
            $array['width'] = 12;
            $array['length'] = 12;
            $array['category_id'] = 1;
            $array['file'] = "Suco2019082115664126970531695001566412697.jpeg";
            DB::table('products')->insert([
                $array
            ]);
        }
        DB::table('categories')->insert([
            [
                'name' => 'Sucos',
                'slug' => 'sucos'
            ]
        ]);
    }
}
