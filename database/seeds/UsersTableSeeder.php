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
        for ($i=1; $i < 5; $i++) { 
            $user_id = $i == 1 ? null : 1;
            $status = $status == 1 ? 0 : 1;
            $array =[
                'id' => $i,
                'name' => 'Thales Serra',
                'cpf' => '418.728.468-07',
                'rg' => '36.953.314-8',
                'user_id' => $user_id,
                'cellphone' => '11977973346',
                'status' => $status,
                'email' => 'thales.serra9'.$i.'@gmail.com',
                'password' => bcrypt('010203'),
                'updated_at' => date("Y-m-d"),
                'created_at' => date("Y-m-d"),
            ]; 
            DB::table('users')->insert([
                    $array
            ]);
        }
        for ($i=1; $i < 7; $i++) { 
            $user_id = 2;
            $array =[
                'id' => $i+4,
                'name' => 'Thales Serra',
                'cpf' => '418.728.468-07',
                'rg' => '36.953.314-8',
                'user_id' => $user_id,
                'cellphone' => '11977973346',
                'status' => 1,
                'email' => 'thales.serra1'.$i.'@gmail.com',
                'password' => bcrypt('010203'),
                'updated_at' => date("Y-m-d"),
                'created_at' => date("Y-m-d"),
            ]; 
            DB::table('users')->insert([
                    $array
            ]);
        }
        for ($i=1; $i < 15; $i++) { 
            $user_id = 6;
            $array =[
                'id' => $i+11,
                'name' => 'Thales Serra',
                'cpf' => '418.728.468-07',
                'rg' => '36.953.314-8',
                'user_id' => $user_id,
                'cellphone' => '11977973346',
                'status' => 1,
                'email' => 'thales.serra8'.$i.'@gmail.com',
                'password' => bcrypt('010203'),
                'updated_at' => date("Y-m-d"),
                'created_at' => date("Y-m-d"),
            ]; 
            DB::table('users')->insert([
                    $array
            ]);
        }
        // DB::table('users')->insert([
        //     [
        //         'id' => 1,
        //         'name' => 'Thales Serra',
        //         'cpf' => '418.728.468-07',
        //         'rg' => '36.953.314-8',
        //         'cellphone' => '11977973346',
        //         'email' => 'thales.serra97@gmail.com',
        //         'password' => bcrypt('010203'),
        //     ],
            // [    'id' => 2,
            //     'name' => 'Thales Serra',
            //     'cpf' => '418.728.468-07',
            //     'rg' => '36.953.314-8',
            //     'cellphone' => '11977973346',
            //     'email' => 'thales.serra85@gmail.com',
            //     'password' => bcrypt('010203'),
            // ],[
            //     'id' => 3,
            //     'name' => 'Thales Serra',
            //     'cpf' => '418.728.468-07',
            //     'rg' => '36.953.314-8',
            //     'cellphone' => '11977973346',
            //     'email' => 'thales.serra92@gmail.com',
            //     'password' => bcrypt('010203'),
            // ],[
            //     'id' => 4,
            //     'name' => 'Thales Serra',
            //     'cpf' => '418.728.468-07',
            //     'rg' => '36.953.314-8',
            //     'cellphone' => '11977973346',
            //     'email' => 'thales.serra93@gmail.com',
            //     'password' => bcrypt('010203'),
            // ],[
            //     'id' => 5,
            //     'name' => 'Thales Serra',
            //     'cpf' => '418.728.468-07',
            //     'rg' => '36.953.314-8',
            //     'cellphone' => '11977973346',
            //     'email' => 'thales.serra94@gmail.com',
            //     'password' => bcrypt('010203'),
            // ],[
            //     'id' => 6,
            //     'name' => 'Thales Serra',
            //     'cpf' => '418.728.468-07',
            //     'rg' => '36.953.314-8',
            //     'cellphone' => '11977973346',
            //     'email' => 'thales.serra95@gmail.com',
            //     'password' => bcrypt('010203'),
            // ],[
            //     'id' => 7,
            //     'name' => 'Thales Serra',
            //     'cpf' => '418.728.468-07',
            //     'rg' => '36.953.314-8',
            //     'cellphone' => '11977973346',
            //     'email' => 'thales.serra90@gmail.com',
            //     'password' => bcrypt('010203'),
            // ],

        // ]);

        // DB::table('databanks')->insert([
        //     [
        //         'user_id' => 1,
        //         'bank_code' => 1,
        //         'agency' => 1234,
        //         'account' => 123456,
        //         'account_type' => 1,
        //         'cpf_holder' => '418.728.468-07',
        //         'name_holder' => 'Thales Serra',
        //     ],[
        //         'user_id' => 2,
        //         'bank_code' => 1,
        //         'agency' => 1234,
        //         'account' => 123456,
        //         'account_type' => 1,
        //         'cpf_holder' => '418.728.468-07',
        //         'name_holder' => 'Thales Serra',
        //     ],[
        //         'user_id' => 3,
        //         'bank_code' => 1,
        //         'agency' => 1234,
        //         'account' => 123456,
        //         'account_type' => 1,
        //         'cpf_holder' => '418.728.468-07',
        //         'name_holder' => 'Thales Serra',
        //     ],[
        //         'user_id' => 4,
        //         'bank_code' => 1,
        //         'agency' => 1234,
        //         'account' => 123456,
        //         'account_type' => 1,
        //         'cpf_holder' => '418.728.468-07',
        //         'name_holder' => 'Thales Serra',
        //     ],[
        //         'user_id' => 5,
        //         'bank_code' => 1,
        //         'agency' => 1234,
        //         'account' => 123456,
        //         'account_type' => 1,
        //         'cpf_holder' => '418.728.468-07',
        //         'name_holder' => 'Thales Serra',
        //     ],[
        //         'user_id' => 6,
        //         'bank_code' => 1,
        //         'agency' => 1234,
        //         'account' => 123456,
        //         'account_type' => 1,
        //         'cpf_holder' => '418.728.468-07',
        //         'name_holder' => 'Thales Serra',
        //     ],[
        //         'user_id' => 7,
        //         'bank_code' => 1,
        //         'agency' => 1234,
        //         'account' => 123456,
        //         'account_type' => 1,
        //         'cpf_holder' => '418.728.468-07',
        //         'name_holder' => 'Thales Serra',
        //     ],
        // ]);

        // DB::table('addresses')->insert([
        //     [
        //         'zip_code' => '08225-485',
        //         'street' => 'Av itaquera',
        //         'number' => '620',
        //         'neighborhood' => 'Itaquera',
        //         'city' => 'São Paulo',
        //         'state' => 'São Paulo',
        //         'user_id' => 1,
        //     ],[
        //         'zip_code' => '08225-485',
        //         'street' => 'Av itaquera',
        //         'number' => '620',
        //         'neighborhood' => 'Itaquera',
        //         'city' => 'São Paulo',
        //         'state' => 'São Paulo',
        //         'user_id' => 2,
        //     ],[
        //         'zip_code' => '08225-485',
        //         'street' => 'Av itaquera',
        //         'number' => '620',
        //         'neighborhood' => 'Itaquera',
        //         'city' => 'São Paulo',
        //         'state' => 'São Paulo',
        //         'user_id' => 3,
        //     ],[
        //         'zip_code' => '08225-485',
        //         'street' => 'Av itaquera',
        //         'number' => '620',
        //         'neighborhood' => 'Itaquera',
        //         'city' => 'São Paulo',
        //         'state' => 'São Paulo',
        //         'user_id' => 4,
        //     ],[
        //         'zip_code' => '08225-485',
        //         'street' => 'Av itaquera',
        //         'number' => '620',
        //         'neighborhood' => 'Itaquera',
        //         'city' => 'São Paulo',
        //         'state' => 'São Paulo',
        //         'user_id' => 5,
        //     ],[
        //         'zip_code' => '08225-485',
        //         'street' => 'Av itaquera',
        //         'number' => '620',
        //         'neighborhood' => 'Itaquera',
        //         'city' => 'São Paulo',
        //         'state' => 'São Paulo',
        //         'user_id' => 6,
        //     ],[
        //         'zip_code' => '08225-485',
        //         'street' => 'Av itaquera',
        //         'number' => '620',
        //         'neighborhood' => 'Itaquera',
        //         'city' => 'São Paulo',
        //         'state' => 'São Paulo',
        //         'user_id' => 7,
        //     ],

        // ]);
    }
}
