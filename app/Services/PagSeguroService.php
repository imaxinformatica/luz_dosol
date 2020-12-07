<?php

namespace App\Services;

use App\Services\ServiceCheckout;

class PagSeguroService
{
    private $queryParamsPagSeguro;
    private $checkoutService;

    public function __construct()
    {
        $checkoutService = new ServiceCheckout();
        $this->queryParamsPagSeguro['email'] = config('services.pagseguro.pagseguro_email');
        $this->queryParamsPagSeguro['token'] = config('services.pagseguro.pagseguro_token');
        $this->queryParamsPagSeguro = http_build_query($this->queryParamsPagSeguro);
        $this->checkoutService = $checkoutService;
    }

    public function sendOrder(array $data, $user)
    {
        $data['user'] = $user;
        $dataPayment = $data['payment_method'] == 'boleto' ? ['paymentMethod' => 'boleto'] : $this->checkoutService->dataCard($data);
        $payload = array_merge(
            $this->checkoutService->dataMain($data),
            $dataPayment,
            $this->checkoutService->dataItems($user),
            $this->checkoutService->getShipping($data)
        );
        try {
            $resp = $this->configureCURL($payload);
        } catch (\Throwable $th) {
            return $th->getMessage();
        }

        $xml = simplexml_load_string($resp);

        return json_decode(json_encode($xml), true);
    }

    public function configureCURL($payload)
    {
        $curl = curl_init();

        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded; charset=ISO-8859-1'));
        curl_setopt($curl, CURLOPT_URL, "https://ws.sandbox.pagseguro.uol.com.br/v2/transactions?{$this->queryParamsPagSeguro}");
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($payload));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $resp = curl_exec($curl);

        curl_close($curl);

        return $resp;
    }
}
