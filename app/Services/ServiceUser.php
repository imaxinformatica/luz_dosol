<?php
namespace App\Services;

class ServiceUser
{

    public function generateDatauser(array $data): array
    {
        $dataUser['name'] = $data['name'];
        $dataUser['email'] = $data['email'];
        $dataUser['cpf'] = $data['cpf'];
        $dataUser['rg'] = $data['rg'];
        $dataUser['cellphone'] = $data['cellphone'];
        $dataUser['phone'] = $data['phone'];
        if(isset($data['password'])){

            $dataUser['password'] = bcrypt($data['password']);
        }
        if(isset($data['status'])){

            $dataUser['status'] = $data['status'];
        }
        return $dataUser;
    }

    public function generateDataAddress(array $data): array
    {
        $dataAddress['zip_code'] = $data['zip_code'];
        $dataAddress['street'] = $data['street'];
        $dataAddress['number'] = $data['number'];
        $dataAddress['complement'] = $data['complement'];
        $dataAddress['neighborhood'] = $data['neighborhood'];
        $dataAddress['city'] = $data['city'];
        $dataAddress['state'] = $data['state'];
        return $dataAddress;
    }

    public function generateDataBank(array $data): array
    {
        $dataBank['bank_code'] = $data['bank_code'];
        $dataBank['agency'] = $data['agency'];
        $dataBank['account'] = $data['account'];
        $dataBank['account_type'] = $data['account_type'];
        $dataBank['cpf_holder'] = $data['cpf_holder'];
        $dataBank['name_holder'] = $data['name_holder'];
        
        return $dataBank;
    }

}
