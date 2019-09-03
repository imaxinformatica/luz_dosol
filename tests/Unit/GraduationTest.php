<?php

namespace Tests\Unit;

use App\Bonus;
use App\Services\ServiceGraduation;
use App\Services\ServiceUser;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use DB;

class GraduationTest extends TestCase
{
    use RefreshDatabase;

    public function testVerificaSeOUsuarioEhGold()
    {
        $user = $this->criaUsuario();
        Bonus::create([
            'user_id' => 1,
            'price' => 2000,
            'level_bonus' => 1
        ]);
        
        Bonus::create([
            'user_id' => 2,
            'price' => 2000,
            'level_bonus' => 1
        ]);
        Bonus::create([
            'user_id' => 3,
            'price' => 2000,
            'level_bonus' => 1
        ]);
        Bonus::create([
            'user_id' => 8,
            'price' => 2000,
            'level_bonus' => 1
        ]);
        $svGraduation = new ServiceGraduation;


        $activeUsers = $user->users()->where('status', 1)->count();
        $date = date('m-Y', strtotime('-1 day'));
        list($month, $year) = explode('-', $date);
        $bonusTotal = ($user->getCommission($month, $year) + $user->getBonus($month, $year));

        $graduationBronze = $svGraduation->getBronzeGraduation($activeUsers, $bonusTotal);
        $graduationSilver = $svGraduation->getSilverGraduation($activeUsers, $bonusTotal);
        $graduationGold = $svGraduation->getGoldGraduation($user, $activeUsers, $bonusTotal);

        $date = date('m-Y', strtotime('-1 day'));
        list($month, $year) = explode('-', $date);
        $bonus = $user->getBonus($month, $year);

        $this->assertEquals(2000, $bonus);

        $this->assertTrue($graduationBronze, 'Verifica Se a graduacao é bronze');
        $this->assertTrue($graduationSilver, 'Verifica Se a graduacao é prata');
        $this->assertTrue($graduationGold, 'Verifica Se a graduacao é ouro');
    }

    public function criaUsuario()
    {
        $svUser = new ServiceUser;
        $data['name'] = 'Thales Serra';
        $data['cpf'] = '418.728.46807';
        $data['rg'] = '36.953.314-8';
        $data['cellphone'] = '(11) 97797-3346';
        $data['email'] = 'thales.serra50@gmail.com';
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

        $user = $svUser->createUser($data, $dataAddress, $dataBank);
        $user_id = [1,1,2,2,3,3,1,8,8,8];
        for ($i = 0; $i < 10; $i++) {
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
        return $user;
    }
}
