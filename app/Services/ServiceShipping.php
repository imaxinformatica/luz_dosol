<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;

class ServiceShipping
{
    public static function generateArrayShipping($zip_code, $shipping_type, $repeatCalculatePrice)
    {
        $user = Auth::guard('user')->user();

        $weight = ServiceShipping::getWeight();
        $volumeTotal = ServiceShipping::getVolume();
        $total = $user->total() / $repeatCalculatePrice;

        $cepDestino = clearSpecialCaracters(config('services.correios.cep_destino'));
        $data['nCdEmpresa'] = '';
        $data['sDsSenha'] = '';
        $data['sCepOrigem'] = clearSpecialCaracters($zip_code);
        $data['sCepDestino'] = $cepDestino;
        $data['nCdServico'] = $shipping_type;

        $data['nVlPeso'] = $weight / $repeatCalculatePrice;
        $data['nCdFormato'] = '1';

        $data['nVlComprimento'] = '50';
        $data['nVlAltura'] = '32';
        $data['nVlLargura'] = '33';
        $data['nVlDiametro'] = '0';
        $data['sCdMaoPropria'] = 'n';
        $data['nVlValorDeclarado'] = number_format($total, 0, '', '');
        $data['sCdAvisoRecebimento'] = 'n';

        $data['StrRetorno'] = 'xml';

        return $data;
    }

    public static function getWeight()
    {   
        $user = Auth::guard('user')->user();
        $items = $user->cart;
        $weight = 0;
        foreach ($items as $item) {
            $weight += ($item->weight * $item->pivot->qty);
        }
        $weight = number_format($weight, 0, '', '');

        return ($weight);
    }

    public static function getVolume()
    {
        $user = Auth::guard('user')->user();
        $items = $user->cart;

        $volumeTotal = 0;
        foreach ($items as $item) {
            $volume = $item->volume * $item->pivot->qty;
            $volumeTotal += $volume;
        }
        return $volumeTotal;
    }
    public static function getError(int $repeatCalculatePrice): bool
    {
        $user = Auth::guard('user')->user();

        $weight = ServiceShipping::getWeight();
        $weight /= $repeatCalculatePrice;
        if ($weight > 30) {
            return true;
        }

        $total = $user->total();
        if ($total > 10000) {
            return true;
        }
        return false;
    }

    public static function repeatCalculatePrice()
    {
        $weight = ServiceShipping::getWeight();

        $volumeTotal = ServiceShipping::getVolume();
        $volumeBox = 52800;
        $count = 1;
        while ($volumeTotal > $volumeBox || $weight > 30) {
            $volumeTotal -= $volumeBox;
            $weight /= 2;
            $count++;
        }
        return $count;
        
    }
}
