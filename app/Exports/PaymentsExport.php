<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PaymentsExport implements FromArray, WithHeadings
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
                'código',
                'nome',
                'valor',
                'código banco',
                'agência',
                'conta',
                'díg. conta',
                'cpf titular',
                'nome titular',
            ],
        ];
    }
}
