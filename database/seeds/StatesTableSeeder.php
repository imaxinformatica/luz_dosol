<?php

use Illuminate\Database\Seeder;

class StatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("states")->insert([
            [
                "name"       => "Rondônia",
                "initials"      => "RO",
            ], [
                "name"       => "Acre",
                "initials"      => "AC",
            ], [
                "name"       => "Amazonas",
                "initials"      => "AM",
            ], [
                "name"       => "Roraima",
                "initials"      => "RR",
            ], [
                "name"       => "Pará",
                "initials"      => "PA",
            ], [
                "name"       => "Amapá",
                "initials"      => "AP",
            ], [
                "name"       => "Tocantins",
                "initials"      => "TO",
            ], [
                "name"       => "Maranhão",
                "initials"      => "MA",
            ], [
                "name"       => "Piauí",
                "initials"      => "PI",
            ], [
                "name"       => "Ceará",
                "initials"      => "CE",
            ], [
                "name"       => "Rio Grande do Norte",
                "initials"      => "RN",
            ], [
                "name"       => "Paraíba",
                "initials"      => "PB",
            ], [
                "name"       => "Pernambuco",
                "initials"      => "PE",
            ], [
                "name"       => "Alagoas",
                "initials"      => "AL",
            ], [
                "name"       => "Sergipe",
                "initials"      => "SE",
            ], [
                "name"       => "Bahia",
                "initials"      => "BA",
            ], [
                "name"       => "Minas Gerais",
                "initials"      => "MG",
            ], [
                "name"       => "Espírito Santo",
                "initials"      => "ES",
            ], [
                "name"       => "Rio de Janeiro",
                "initials"      => "RJ",
            ], [
                "name"       => "São Paulo",
                "initials"      => "SP",
            ], [
                "name"       => "Paraná",
                "initials"      => "PR",
            ], [
                "name"       => "Santa Catarina",
                "initials"      => "SC",
            ], [
                "name"       => "Rio Grande do Sul",
                "initials"      => "RS",
            ], [
                "name"       => "Mato Grosso do Sul",
                "initials"      => "MS",
            ], [
                "name"       => "Mato Grosso",
                "initials"      => "MT",
            ], [
                "name"       => "Goiás",
                "initials"      => "GO",
            ], [
                "name"       => "Distrito Federal",
                "initials"      => "DF",
            ],
        ]);
    }
}
