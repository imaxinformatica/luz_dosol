<?php

use Illuminate\Database\Seeder;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("admins")->insert([
            [
                "name"          => "Thales",
                "email"         => "thales@imaxinformatica.com.br",
                "password"      => bcrypt("Thales100%"),
            ], 
            [
                "name"          => "Lucas",
                "email"         => "lucas@imaxinformatica.com.br",
                "password"      => bcrypt(".Welcome09"),
            ], 
            [
                "name"          => "Alan Ribeiro",
                "email"         => "alan.ribeiro@luzdosolmmn.com.br",
                "password"      => bcrypt("lds@895201"),
            ],
            [
                "name"          => "Guilherme Neto",
                "email"         => "guilherme.neto@luzdosolmmn.com.br",
                "password"      => bcrypt("lds@999225"),
            ], 
            [
                "name"          => "Matheus Biasotto",
                "email"         => "matheus.biasotto@luzdosolmmn.com.br",
                "password"      => bcrypt("lds@782338"),
            ]
        ]);
    }
}