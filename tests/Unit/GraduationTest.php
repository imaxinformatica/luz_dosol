<?php

namespace Tests\Unit;

use App\Bonus;
use App\Services\ServiceGraduation;
use App\Services\ServiceUser;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class GraduationTest extends TestCase
{
    use RefreshDatabase;

    public function testVerificaSeOUsuarioEhGraduado()
    {

        $this->criaUsuario();
        $this->generateBonus();

        $userEmperor = User::find(1);

        $userMaster = User::find(2);

        $userDiamond1 = User::find(3);
        $userDiamond2 = User::find(4);
        $userDiamond3 = User::find(9);

        $userPlatinum1 = User::find(5);
        $userPlatinum2 = User::find(6);
        $userPlatinum3 = User::find(7);
        $userPlatinum4 = User::find(8);

        $userGold1 = User::find(25);
        $userGold2 = User::find(28);
        $userGold3 = User::find(31);
        $userGold4 = User::find(33);
        $userGold5 = User::find(11);
        $userGold6 = User::find(13);
        $userGold7 = User::find(15);
        $userGold8 = User::find(17);
        $userGold9 = User::find(19);
        $userGold10 = User::find(22);

        $graduationUserEmperor = $userEmperor->getGraduation();
        $graduationUserMaster = $userMaster->getGraduation();
        $graduationUserDiamond1 = $userDiamond1->getGraduation();
        $graduationUserDiamond2 = $userDiamond2->getGraduation();
        $graduationUserDiamond3 = $userDiamond3->getGraduation();
        $graduationUserPlatinum1 = $userPlatinum1->getGraduation();
        $graduationUserPlatinum2 = $userPlatinum2->getGraduation();
        $graduationUserPlatinum3 = $userPlatinum3->getGraduation();
        $graduationUserPlatinum4 = $userPlatinum4->getGraduation();
        $graduationUserGold1 = $userGold1->getGraduation();
        $graduationUserGold2 = $userGold2->getGraduation();
        $graduationUserGold3 = $userGold3->getGraduation();
        $graduationUserGold4 = $userGold4->getGraduation();
        $graduationUserGold5 = $userGold5->getGraduation();
        $graduationUserGold6 = $userGold6->getGraduation();
        $graduationUserGold7 = $userGold7->getGraduation();
        $graduationUserGold8 = $userGold8->getGraduation();
        $graduationUserGold9 = $userGold9->getGraduation();
        $graduationUserGold10 = $userGold10->getGraduation();



        $this->assertEquals(7,$graduationUserEmperor);
        $this->assertEquals(6,$graduationUserMaster);

        $this->assertEquals(5,$graduationUserDiamond1);
        $this->assertEquals(5,$graduationUserDiamond2);
        $this->assertEquals(5,$graduationUserDiamond3);

        $this->assertEquals(4,$graduationUserPlatinum1);
        $this->assertEquals(4,$graduationUserPlatinum2);
        $this->assertEquals(4,$graduationUserPlatinum3);
        $this->assertEquals(4,$graduationUserPlatinum4);

        $this->assertEquals(3, $graduationUserGold1);
        $this->assertEquals(3, $graduationUserGold2);
        $this->assertEquals(3, $graduationUserGold3);
        $this->assertEquals(3, $graduationUserGold4);
        $this->assertEquals(3, $graduationUserGold5);
        $this->assertEquals(3, $graduationUserGold6);
        $this->assertEquals(3, $graduationUserGold7);
        $this->assertEquals(3, $graduationUserGold8);
        $this->assertEquals(3, $graduationUserGold9);
        $this->assertEquals(3, $graduationUserGold10);
    }

    public function criaUsuario()
    {
        $svUser = new ServiceUser;
        $data['name'] = 'Thales Serra';
        $data['cpf'] = '418.728.46807';
        $data['rg'] = '36.953.314-8';
        $data['cellphone'] = '(11) 97797-3346';
        $data['email'] = 'thales.serra50000@gmail.com';
        $data['password'] = bcrypt('010203');
        $data['status'] = 1;
        $data['user_id'] = null;

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

        $svUser->createUser($data, $dataAddress, $dataBank);
        $user_id = [
            1, 1, 1, 1, 1, 2, 2, 2, 3, 3, 3, 3, 4, 4, 4, 4, 5, 5, 5, 6, 6, 6, 7, 7, 7, 8, 8, 8, 9, 9, 9, 9, 11, 11, 13, 13, 15, 15, 17, 17, 19, 19, 22, 22, 23, 23, 21, 21, 20, 20, 18, 18, 16, 16, 14, 14, 12, 12, 10, 10, 29, 29, 27, 27, 26, 26, 24, 24, 25, 25, 28, 28, 31, 31, 33, 33, 70, 70, 71, 71, 72, 72, 73, 73, 30, 30, 32, 32, 34, 34, 35, 35, 36, 36, 37, 37, 74, 74, 75, 75, 76, 76, 77, 77, 38, 38, 39, 39, 40, 40, 41, 41, 42, 42, 43, 43, 44, 44, 45, 45, 25, 28, 31, 33, 11, 13, 15, 17, 19, 22, 131, 131, 130, 130, 129, 129, 128, 128, 127, 127, 126, 126, 125, 125, 124, 124, 122, 122, 2, 150, 150, 123, 123
        ];
        for ($i = 0; $i < 153; $i++) {
            $data['name'] = 'Thales Serra';
            $data['cpf'] = '418.728.46807';
            $data['rg'] = '36.953.314-8';
            $data['cellphone'] = '(11) 97797-3346';
            $data['email'] = 'thales.serra' . $i . '@gmail.com';
            $data['password'] = bcrypt('010203');
            $data['status'] = 1;
            $data['user_id'] = $user_id[$i];

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
            $svUser->createUser($data, $dataAddress, $dataBank);
        }
    }

    public function generateBonus()
    {
        $arrayBronze = [
            10, 12, 14, 16, 18, 20, 21, 23, 45, 44,
            43, 42, 41, 40, 39, 38, 37, 36, 35, 34,
            32, 30, 29, 27, 26, 24, 70, 71, 72, 73,
            74, 75, 76, 77, 122, 123, 124, 125, 126,
            127, 128, 129, 130, 131,150
        ];
        $arrayGold = [11, 13, 15, 17, 19, 22, 25, 28, 31, 33];
        $arrayPlatinum = [5, 6, 7, 8];
        $arrayDiamond = [3, 4, 9];
        $arrayMaster = [2];
        Bonus::create([
            'user_id' => 1,
            'price' => 46000,
            'level_bonus' => 1
        ]);
        for ($i = 0; $i < count($arrayBronze); $i++) {
            Bonus::create([
                'user_id' => $arrayBronze[$i],
                'price' => 40,
                'level_bonus' => 1
            ]);
        }

        for ($i = 0; $i < count($arrayGold); $i++) {
            Bonus::create([
                'user_id' => $arrayGold[$i],
                'price' => 850,
                'level_bonus' => 1
            ]);
        }

        for ($i = 0; $i < count($arrayPlatinum); $i++) {
            Bonus::create([
                'user_id' => $arrayPlatinum[$i],
                'price' => 3600,
                'level_bonus' => 1
            ]);
        }

        for ($i = 0; $i < count($arrayDiamond); $i++) {
            Bonus::create([
                'user_id' => $arrayDiamond[$i],
                'price' => 7100,
                'level_bonus' => 1
            ]);
        }

        for ($i = 0; $i < count($arrayMaster); $i++) {
            Bonus::create([
                'user_id' => $arrayMaster[$i],
                'price' => 21000,
                'level_bonus' => 1
            ]);
        }
    }
}
