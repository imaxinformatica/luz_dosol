<?php

namespace App\Services;

use App\User;

class GraduationService
{
    protected $bonusTotal;
    protected $activeUsers;
    protected $qualified;
    protected $gold;
    protected $platinum;
    protected $diamond;
    protected $master;
    protected $emperor;

    protected static $count;

    public function __construct()
    {
        $this->bonusTotal = [
            0 => 0, //Não graduado
            1 => 30, //Bronze
            2 => 105, // Prata
            3 => 850, // Ouro
            4 => 3500, // Platina
            5 => 7000, // Diamante
            6 => 20000, //Mestre
            7 => 45000, // Imperador/Imperatriz
            8 => 120000, //Príncipe / Princesa
            9 => 280000, //Rei / Rainha
        ];
        $this->activeUsers = [
            0 => 0,  //Não graduado
            1 => 2,  //Bronze
            2 => 2,  // Prata
            3 => 2,  // Ouro
            4 => 2,  // Platina
            5 => 3,  // Diamante
            6 => 3,  //Mestre
            7 => 4,  // Imperador/Imperatriz
            8 => 4,  //Príncipe / Princesa
            9 => 5,  //Rei / Rainha
        ];
        $this->qualified = [
            2 => 0,  // Não Qualificado
            3 => 3,  // Ouro
            4 => 3,  // Platina
            5 => 4,  // Diamante
            6 => 4,  //Mestre
            7 => 5,  // Imperador/Imperatriz
            8 => 5,  //Príncipe / Princesa
            9 => 8,  //Rei / Rainha
        ];
        $this->gold = [
            3 => 0,  // Ouro
            4 => 1,  // Platina
            5 => 2,  // Diamante
        ];
        $this->platinum = [
            5 => 0,  // Diamante
            6 => 2,  // Mestre
            7 => 2,  // Imperador/Imperatriz
        ];
        $this->diamond = [
            5 => 0,  // Diamante
            6 => 1,  // Mestre
            7 => 2,  // Imperador/Imperatriz
            8 => 2,  // Príncipe / Princesa
            9 => 2,  // Mestre
        ];
        $this->master = [
            6 => 0,  // Mestre
            7 => 1,  // Imperador/Imperatriz
            8 => 3,  // Príncipe / Princesa
            9 => 4,  // Rei / Rainha
        ];
        $this->emperor = [
            8 => 0,  // Príncipe / Princesa
            9 => 2,  // Rei / Rainha
        ];
    }

    public function getGraduation(User $user)
    {
        $date = setDate(date('m-Y', strtotime('-30 day')));
        return $this->loopGraduation($user, $date, 10);
    }

    public function loopGraduation($user, $date, $limit)
    {
        $count = 9;
        $bonus = $user->getTotalBonus($date[0], $date[1]);
        $userActiveNetwork = $user
            ->users
            ->where('status', 1)
            ->count();

        // Validações Iniciais
        while (!$this->validate($userActiveNetwork, $bonus, $count)) {
            $count--;
        }

        if ($count <= 2) {
            return $count;
        }
        // Validações De Qualificação - Até Gold
        $totalQualified = $this->isQualified($user, $date, $limit);
        while (!$this->validateQualified($totalQualified, $count)) {
            $count--;
        }
        if ($count <= 2) {
            return $count;
        }

        // Validações de Graduado Ouro
        $totalGold = $this->isGold($user, $date, $limit);

        while (!$this->validateGold($totalGold, $count)) {
            $count--;
        }

        if ($count <= 3) {
            return $count;
        }

        // Validações de Graduado Platina
        $totalPlatinum = $this->isPlatinum($user, $date, $limit);

        while (!$this->validatePlatinum($totalPlatinum, $count)) {
            $count--;
        }

        if ($count <= 4) {
            return $count;
        }

        // Validações de Graduado Diamante
        $totalDiamond = $this->isDiamond($user, $date, $limit);

        while (!$this->validateDiamond($totalDiamond, $count)) {
            $count--;
        }
        if ($count <= 5) {
            return $count;
        }
        // Validações de Graduado Mestre
        $totalMaster = $this->isMaster($user, $date, $limit);

        while (!$this->validateMaster($totalMaster, $count)) {
            $count--;
        }
        if ($count <= 6) {
            return $count;
        }
        // Validações de Graduado Imperador
        $totalEmperor = $this->isEmperor($user, $date, $limit);

        while (!$this->validateEmperor($totalEmperor, $count)) {
            $count--;
        }
        return $count;

    }

    protected function isQualified(User $user, array $date, $limit): int
    {
        $isQualified = 0;
        foreach ($user->users as $user) {
            $graduation = $this->loopGraduation($user, $date, $limit);
            if ($graduation > 0) {
                $isQualified++;
            }
        }
        return $isQualified;
    }
    protected function isGold(User $user, array $date, $limit): int
    {
        $isGold = 0;
        foreach ($user->users as $user) {
            $graduation = $this->loopGraduation($user, $date, $limit);
            if ($graduation >= 3) {
                $isGold++;
            }
        }
        return $isGold;
    }
    protected function isPlatinum(User $user, array $date, $limit): int
    {
        $isPlatinum = 0;
        foreach ($user->users as $user) {
            $graduation = $this->loopGraduation($user, $date, $limit);
            if ($graduation >= 4) {
                $isPlatinum++;
            }
        }
        return $isPlatinum;
    }
    protected function isDiamond(User $user, array $date, $limit): int
    {
        $isDiamond = 0;
        foreach ($user->users as $user) {
            $graduation = $this->loopGraduation($user, $date, $limit);
            if ($graduation >= 5) {
                $isDiamond++;
            }
        }
        return $isDiamond;
    }
    protected function isMaster(User $user, array $date, $limit): int
    {
        $isMaster = 0;
        foreach ($user->users as $user) {
            $graduation = $this->loopGraduation($user, $date, $limit);
            if ($graduation >= 6) {
                $isMaster++;
            }
        }
        return $isMaster;
    }
    protected function isEmperor(User $user, array $date, $limit): int
    {
        $isEmperor = 0;
        foreach ($user->users as $user) {
            $graduation = $this->loopGraduation($user, $date, $limit);
            if ($graduation >= 7) {
                $isEmperor++;
            }
        }
        return $isEmperor;
    }

    protected function validate($userActiveNetwork, $bonus, $count)
    {
        return ($userActiveNetwork >= $this->activeUsers[$count] && $bonus >= $this->bonusTotal[$count]);
    }
    protected function validateQualified($totalQualified, $count)
    {
        return ($totalQualified >= $this->qualified[$count]);
    }
    protected function validateGold($totalGold, $count)
    {
        return ($totalGold >= $this->gold[$count]);
    }
    protected function validatePlatinum($totalPlatinum, $count)
    {
        return ($totalPlatinum >= $this->platinum[$count]);
    }
    protected function validateDiamond($totalDiamond, $count)
    {
        return ($totalDiamond >= $this->diamond[$count]);
    }
    protected function validateMaster($totalMaster, $count)
    {
        return ($totalMaster >= $this->master[$count]);
    }
    protected function validateEmperor($totalEmperor, $count)
    {
        return ($totalEmperor >= $this->emperor[$count]);
    }
}
