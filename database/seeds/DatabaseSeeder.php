<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AdminTableSeeder::class);
        $this->call(PageTableSeeder::class);
        $this->call(StatesTableSeeder::class);
        $this->call(CyclesTableSeeder::class);
        $this->call(BanksTableSeeder::class);
        $this->call(CommissionsTableSeeder::class);

        $this->call(UsersTableSeeder::class);
        $this->call(ProductTablesSeeder::class);
    }
}
