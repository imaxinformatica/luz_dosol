<?php

namespace App\Exports;


use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TransfeeraExport implements FromArray, WithHeadings
{
    protected $data;


    public function __construct($data)
    {
        $this->data = $data;
    }

    public function array(): array
    {

        return [
            $this->data,
        ];
    }

    public function headings(): array
    {

        return [
            [
                'nome',
                'cpf titular',
                'e-mail',
                'código banco',
                'agência',
                'conta',
                'díg. conta',
                'tipo de conta', //verificar
                'valor',
            ],
        ];
    }
}

