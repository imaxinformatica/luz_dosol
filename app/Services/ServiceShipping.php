<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;

class ServiceShipping
{
    public function generateArrayShipping($zip_code, $shipping_type)
    {
        $weight = $this->getWeight();
        $volume = $this->getVolume();
        $user = Auth::guard('user')->user();
        $cepDestino = clearSpecialCaracters(config('services.correios.cep_destino'));

        $data['nCdEmpresa'] = '';
        $data['sDsSenha'] = '';
        $data['sCepOrigem'] = clearSpecialCaracters($zip_code);
        $data['sCepDestino'] = $cepDestino;
        $data['nCdServico'] = $shipping_type;

        $data['nVlPeso'] = $weight;
        $data['nCdFormato'] = '1';

        $data['nVlComprimento'] = $volume;
        $data['nVlAltura'] = $volume;
        $data['nVlLargura'] = $volume;
        $data['nVlDiametro'] = '0';
        $data['sCdMaoPropria'] = 'n';
        $data['nVlValorDeclarado'] = convertMoneyUSAtoBrazil($user->total());
        $data['sCdAvisoRecebimento'] = 'n';

        $data['StrRetorno'] = 'xml';

        return $data;
    }

    public function getWeight()
    {
        $user = Auth::guard('user')->user();
        $items = $user->cart;
        $weight = 0;
        foreach ($items as $item) {
            $weight += ($item->weight * $item->pivot->qty);
        }
        $weight = number_format($weight, 0, '', '');
        return $weight;
    }

    public function getVolume()
    {
        $user = Auth::guard('user')->user();
        $items = $user->cart;
        $total = 0;
        foreach ($items as $item) {
            $volume = $item->width * $item->length * $item->height;
            $total +=$volume;
        }
        $total = pow ($total , 1/3 );
        $total = $total < 18 ? 18 : $total;
        $total = number_format($total, 0, '', '');
        return $total;
    }
    public function getError(): bool
    {
        $weight = $this->getWeight();
        $user = Auth::guard('user')->user();
        if($weight > 30){
            return true;
        }

        $total = $user->total();
        if($total > 10000){
            return true;
        }

        $volume = $this->getVolume();
        if($volume > 105){
            return true;
        }
        return false;
    }
}
