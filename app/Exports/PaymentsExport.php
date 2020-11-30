<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class PaymentsExport implements FromArray, WithHeadings, ShouldAutoSize
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
                'Código',
                'Nome',
                'Valor',
                'Código banco',
                'Agência',
                'Conta',
                'Díg. Conta',
                'CPF titular',
                'Nome titular',
                'Chave PIX',
            ],
        ];
    }
}
