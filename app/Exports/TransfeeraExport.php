<?php

namespace App\Exports;


use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class TransfeeraExport implements FromArray, WithHeadings, ShouldAutoSize
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
                'Nome',
                'CPF Titular',
                'E-mail',
                'Código Banco',
                'Agência',
                'Conta',
                'Díg. Conta',
                'Tipo de Conta', 
                'Valor',
            ],
        ];
    }
}

