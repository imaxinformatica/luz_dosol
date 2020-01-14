<?php

namespace Tests\Unit;

use App\Services\ServiceUser;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use RefreshDatabase;
    public function testVerificaUsuarioEstaCriado()
    {
        $data['name'] = 'Thales Serra';
        $data['cpf'] = '418.728.46807';
        $data['rg'] = '36.953.314-8';
        $data['cellphone'] = '(11) 97797-3346';
        $data['email'] = 'thales.serra123456@gmail.com';
        $data['password'] = bcrypt('010203');
        $data['status'] = 1;

        $dataAddress['zip_code'] = '08225485';
        $dataAddress['street'] = 'AE Carvalho';
        $dataAddress['number'] = '620';
        $dataAddress['neighborhood'] = 'Itaquera';
        $dataAddress['city'] = 'São Paulo';
        $dataAddress['state'] = 'SP';

        $dataBank['bank_code'] = '1234';
        $dataBank['agency'] = '1234';
        $dataBank['account'] = '1234';
        $dataBank['account_type'] = '1234';
        $dataBank['cpf_holder'] = '1234';
        $dataBank['name_holder'] = 'Thales Serra';
        $dataBank['type_account'] = '1';

        ServiceUser::createUser($data, $dataAddress, $dataBank);


        $this->assertDatabaseHas('users', $data);
        $this->assertDatabaseHas('addresses', $dataAddress);
        $this->assertDatabaseHas('databanks', $dataBank);
    }
}
