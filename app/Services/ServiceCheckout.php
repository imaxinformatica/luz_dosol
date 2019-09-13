<?php

namespace App\Services;

use App\ActiveUser;
use App\User;

class ServiceCheckout
{

    public function activeUser(User $user)
    {
        $date = date('Y-m-d');
        ActiveUser::create([
            'user_id' => $user->id,
            'date_active' => $date
        ]);
        $user->status = 1;
        $user->save();
    }

    public function dataMain(array $data)
    {
        $phone = numberPhone($data['user']->cellphone);

        $mainData['paymentMode'] = 'default';
        $mainData['currency'] = 'BRL';
        $mainData['receiverEmail'] = 'informaticaimax@gmail.com';
        $mainData['senderHash'] = $data['sender_hash'];
        $mainData['senderName'] = $data['user']->name;
        $mainData['senderCPF'] = limpaCPF_CNPJ($data['user']->cpf);
        $mainData['senderAreaCode'] = $phone['dd'];
        $mainData['senderPhone'] = $phone['num'];
        $mainData['senderEmail'] = "c68878754963475503724@sandbox.pagseguro.com.br"; //$data['user']->email;
        $mainData['notificationURL'] = route('callback.pagseguro');

        return $mainData;
    }

    public function dataCard(array $data)
    {
        $phone = numberPhone($data['user']->cellphone);
        $total = convertMoneyBraziltoUSA($data['price']) + $data['shipping_price'];
        $dataCard['paymentMethod'] = 'creditCard';
        $dataCard['creditCardToken'] = $data['token_card'];
        $dataCard['installmentQuantity'] = 1;
        $dataCard['installmentValue'] = number_format($total, 2, '.', '');
        $dataCard['creditCardHolderName'] = $data['holder_name'];
        $dataCard['creditCardHolderCPF'] = limpaCPF_CNPJ($data['cpf_holder']);
        $dataCard['creditCardHolderBirthDate'] = $data['birthdate'];
        $dataCard['creditCardHolderAreaCode'] = $phone['dd'];
        $dataCard['creditCardHolderPhone'] = $phone['num'];
        $dataCard['billingAddressStreet'] = $data['isBilling'] == 0 ? $data['street_billing'] : $data['street'];
        $dataCard['billingAddressNumber'] = $data['isBilling'] == 0 ? $data['number_billing'] : $data['number'];
        $dataCard['billingAddressDistrict'] = $data['isBilling'] == 0 ? $data['neighborhood_billing'] : $data['neighborhood'];
        $dataCard['billingAddressCity'] = $data['isBilling'] == 0 ? $data['city_billing'] : $data['city'];
        $dataCard['billingAddressState'] = $data['isBilling'] == 0 ? $data['state_billing'] : $data['state'];
        $dataCard['billingAddressCountry'] = 'BRA';
        $dataCard['billingAddressPostalCode'] = $data['isBilling'] == 0 ? str_replace('-', '', $data['zip_code_billing']) : str_replace('-', '', $data['zip_code']);
        if ($data['complement']) {
            $dataCard['billingAddressComplement'] = $data['complement'];
        }

        return $dataCard;
    }

    public function dataItems($user)
    {
        foreach ($user->cart as $key => $product) {
            $dataItem['itemId' . ($key + 1)] = $product->reference;
            $dataItem['itemDescription' . ($key + 1)] = $product->name;
            $dataItem['itemAmount' . ($key + 1)] = number_format($product->price, 2, '.', '');
            $dataItem['itemQuantity' . ($key + 1)] = $product->pivot->qty;
        }
        return $dataItem;
    }

    public function getShipping(array $data): array
    {
        $dataShipping['shippingAddressRequired'] = 'true';
        $dataShipping['shippingAddressStreet'] = $data['street'];
        $dataShipping['shippingAddressNumber'] = $data['number'];
        if ($data['complement']) {
            $dataShipping['shippingAddressComplement'] = $data['complement'];
        }
        $dataShipping['shippingAddressDistrict'] = $data['neighborhood'];
        $dataShipping['shippingAddressCity'] = $data['city'];
        $dataShipping['shippingAddressState'] = $data['state'];
        $dataShipping['shippingAddressCountry'] = 'BRA';
        $dataShipping['shippingAddressPostalCode'] = str_replace('-', '', $data['zip_code']);

        $dataShipping['shippingType'] = $data['shipping_type'];
        $dataShipping['shippingCost'] = $data['shipping_price'];

        return $dataShipping;
    }
}
