<?php

namespace App\Services;

use App\Models\Payment;

class ReportService
{

    public function generate($date)
    {
        $payments = Payment::where('month', $date[0])
            ->where('year', $date[1])
            ->orderBy('total', 'desc')
            ->get();

        $array = [];
        foreach ($payments as $key => $payment) {
            if ($payment->total == 0) {
                continue;
            }
            $dataBank = $payment->user->dataBank;

            $pix = $payment->user->pixKeys()->first();
            $pixKey = $pix ? $pix->key : 'Não Possui';
            $typePix = $pix ? $pix->type : 'Não Possui';
            $data['código'] = $payment->user->id;
            $data['nome'] = $payment->user->name;
            $data['valor'] = ($payment->total);

            $data['código banco'] = "$dataBank->bank_code";
            $data['agência'] = "$dataBank->agency";
            $data['conta'] = "$dataBank->account";
            $data['díg. conta'] = "$dataBank->account_type";
            $data['cpf titular'] = "$dataBank->cpf_holder";
            $data['nome titular'] = "$dataBank->name_holder";
            $data['chave pix'] = "$pixKey";
            // $data['tipo de chave'] = $typePix;
            // $data['graduação'] = $payment->user->graduation_name;
            $array[$key] = $data;
        }
        return $array;
    }

    public function transfeera($date)
    {
        $payments = Payment::where('month', $date[0])
            ->where('year', $date[1])
            ->orderBy('total', 'desc')
            ->get();
        $array = [];
        foreach ($payments as $key => $payment) {
            if ($payment->total == 0) {
                continue;
            }
            $dataBank = $payment->user->dataBank;

            $pix = $payment->user->pixKeys()->first();
            $pixKey = $pix ? $pix->key : 'Não Possui';
            $typePix = $pix ? $pix->type : 'Não Possui';
            $agency = str_pad($dataBank->agency, 4, 0, STR_PAD_LEFT);
            $bank_code = str_pad($dataBank->bank_code, 3, 0, STR_PAD_LEFT);

            $data['nome'] = $payment->user->name;
            $data['cpf titular'] = "$dataBank->cpf_holder";
            $data['e-mail'] = $payment->user->email;
            $data['código banco'] = "$bank_code";
            $data['agência'] = "$agency";
            $data['conta'] = "$dataBank->account";
            $data['díg. conta'] = "$dataBank->account_type";
            $data['tipo de conta'] = "$dataBank->type_account";
            $data['valor'] = convertMoneyUSAtoBrazil($payment->total);

            $array[$key] = $data;
        }

        return $array;
    }
}
