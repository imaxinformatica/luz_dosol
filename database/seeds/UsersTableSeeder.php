<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $array = [];
        $status = 0;
        for ($i = 1; $i < 5; $i++) {
            $user_id = $i == 1 ? null : 1;
            $status = $status == 1 ? 0 : 1;
            $array = [
                'id' => $i,
                'name' => 'Thales Serra',
                'cpf' => '418.728.468-07',
                'rg' => '36.953.314-8',
                'user_id' => $user_id,
                'cellphone' => '11977973346',
                'status' => $status,
                'email' => 'thales.serra9' . $i . '@gmail.com',
                'password' => bcrypt('010203'),
                'updated_at' => date("Y-m-d"),
                'created_at' => date("Y-m-d"),
            ];
            $dataAddress['zip_code'] = '08225-485';
            $dataAddress['street'] = 'AE Carvalho';
            $dataAddress['number'] = '620';
            $dataAddress['neighborhood'] = 'Itaquera';
            $dataAddress['city'] = 'São Paulo';
            $dataAddress['state'] = 'SP';
            $dataAddress['user_id'] = $i;

            DB::table('users')->insert([
                $array
            ]);
            DB::table('addresses')->insert([
                $dataAddress
            ]);
        }
        for ($i = 1; $i < 7; $i++) {
            $user_id = 2;
            $array = [
                'id' => $i + 4,
                'name' => 'Thales Serra',
                'cpf' => '418.728.468-07',
                'rg' => '36.953.314-8',
                'user_id' => $user_id,
                'cellphone' => '11977973346',
                'status' => 1,
                'email' => 'thales.serra1' . $i . '@gmail.com',
                'password' => bcrypt('010203'),
                'updated_at' => date("Y-m-d"),
                'created_at' => date("Y-m-d"),
            ];
            DB::table('users')->insert([
                $array
            ]);
        }
        for ($i = 1; $i < 15; $i++) {
            $user_id = 6;
            $array = [
                'id' => $i + 11,
                'name' => 'Thales Serra',
                'cpf' => '418.728.468-07',
                'rg' => '36.953.314-8',
                'user_id' => $user_id,
                'cellphone' => '11977973346',
                'status' => 1,
                'email' => 'thales.serra8' . $i . '@gmail.com',
                'password' => bcrypt('010203'),
                'updated_at' => date("Y-m-d"),
                'created_at' => date("Y-m-d"),
            ];
            DB::table('users')->insert([
                $array
            ]);
        }
    }
}
