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
        $this->call(TestSeeder::class);
        $this->call(CommissionsTableSeeder::class);
        // factory(\App\User::class, 1)->create([
        //     'user_id' => null,
        // ]);
        // factory(\App\User::class, 9)->create();
        // factory(\App\Address::class, 1)->create();
        // factory(\App\Databank::class, 1)->create();

    }
}
