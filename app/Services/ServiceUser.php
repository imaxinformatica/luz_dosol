<?php
namespace App\Services;

class ServiceUser{

    public function generateDatauser(Array $data): array
    {
        $dataUser['name'] = $data['name']; 
        $dataUser['email'] = $data['email']; 
        $dataUser['status'] = $data['status']; 
        $dataUser['password'] = bcrypt($data['password']); 
        $dataUser['cpf'] = $data['cpf']; 
        $dataUser['rg'] = $data['rg']; 
        $dataUser['cellphone'] = $data['cellphone']; 
        $dataUser['phone'] = $data['phone']; 

        return $dataUser;
    }

    public function generateDataAddress(Array $data): array
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
    
}