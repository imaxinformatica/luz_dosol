<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;

class ServiceShipping
{

    public static function generateArrayShipping($zip_code, $shipping_type, $repeatCalculatePrice, $box)
    {
        $user = Auth::guard('user')->user();

        $weight = ServiceShipping::getWeight();
        $volumeTotal = ServiceShipping::getVolume();
        $volumeRealBox = $repeatCalculatePrice * $box['volume'];
        if (
            ($box['repeatBox']['big'] == 0 && $box['repeatBox']['small'] == 1) || ($box['repeatBox']['big'] == 1 && $box['repeatBox']['small'] == 0)
        ) {
            $percentageBox = 100;
        }else{
            $percentageBox = ($volumeRealBox * 100) / $volumeTotal;
        }

        $weightBox = ($weight * $percentageBox) / 100;
        $weightPerBox = $weightBox / $repeatCalculatePrice;

        $total = $user->total();
        $totalBox = ($total * $percentageBox) / 100;
        $totalPerBox = $totalBox / $repeatCalculatePrice;

        $cepDestino = clearSpecialCaracters(config('services.correios.cep_destino'));
        $data['nCdEmpresa'] = config('services.correios.empresa');
        $data['sDsSenha'] = config('services.correios.senha');
        $data['sCepOrigem'] = clearSpecialCaracters($zip_code);
        $data['sCepDestino'] = $cepDestino;
        $data['nCdServico'] = $shipping_type;

        $data['nVlPeso'] = $weightPerBox;
        $data['nCdFormato'] = '1';

        $data['nVlComprimento'] = $box['length'];
        $data['nVlAltura'] = $box['height'];
        $data['nVlLargura'] = $box['width'];
        $data['nVlDiametro'] = '0';
        $data['sCdMaoPropria'] = 'n';
        $data['nVlValorDeclarado'] = number_format($totalPerBox, 0, '', '');
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
    public static function getError(array $repeatBox): bool
    {
        $user = Auth::guard('user')->user();

        $weight = ServiceShipping::getWeight();

        $weight /= $repeatBox['big'];
        if ($weight > 30) {
            return true;
        }

        $total = $user->total();
        if ($total > 10000) {
            return true;
        }
        return false;
    }

    public static function repeatCalculatePrice(): array
    {
        $repeatBox = [
            'big' => 0,
            'small' => 0,
        ];

        $volumeTotal = ServiceShipping::getVolume();
        $volumeBigBox = 52800;
        $volumeSmallBox = 36960;

        if ($volumeTotal > $volumeSmallBox) {
            if ($volumeTotal > $volumeBigBox) {
                $repeatBox['big'] = intval($volumeTotal / $volumeBigBox);
            } else {
                $repeatBox['small']++;
            }
            $newTotal = $repeatBox['big'] * $volumeBigBox;
            $total = $volumeTotal - $newTotal;
            $total > $volumeSmallBox ? $repeatBox['big']++ : $repeatBox['small']++;
        } else {
            $repeatBox['small']++;
        }

        return $repeatBox;

    }

    public static function getShippingPrice($data)
    {
        $data = http_build_query($data);
        $url = "http://ws.correios.com.br/calculador/CalcPrecoPrazo.aspx";
        // cURL
        $curl = curl_init($url . '?' . $data);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($curl);
        curl_close($curl);
        //!end cUrl
        $xml = simplexml_load_string($result);
        $json = json_encode($xml);
        $json = json_decode($json, true);
        if (isset($json['cServico']['Erro']) && $json['cServico']['Erro'] != 0) {
            throw new \Exception('Problema em buscar os dados');
        }
        return $json;
    }
}
