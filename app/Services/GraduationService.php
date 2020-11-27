<?php

namespace App\Services;

use App\User;

class GraduationService
{
    private $bonusTotal;
    private $activeUsers;

    private static $count;

    public function __construct()
    {
        $this->bonusTotal = [
            0 => 0,
            1 => 30,
            2 => 105,
            3 => 850,
            4 => 3500,
            5 => 7000,
            6 => 20000,
            7 => 45000,
            8 => 120000,
            9 => 280000,
        ];
        $this->activeUsers = [
            0 => 0,
            1 => 2,
            2 => 2,
            3 => 2,
            4 => 2,
            5 => 3,
            6 => 3,
            7 => 4,
            8 => 4,
            9 => 5,
        ];
    }
    public function getGraduation(User $user)
    {
        $date = setDate(date('m-Y', strtotime('-1 day')));
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

        while (!$this->validate($userActiveNetwork, $bonus, $count)) {
            $count--;
        }

        if ($count <= 2) {
            return $count;
        }

        $hasGraduated = 0;
        $hasGold = 0;
        if ($user->users->count() > 0) {
            foreach ($user->users as $key => $child) {
                if ($limit > 0) {
                    $graduated = $this->loopGraduation($child, $date, $limit - 1);
                    if ($graduated > 2) {
                        $hasGold++;
                    }
                    if ($graduated > 0) {
                        $hasGraduated++;
                    }
                }
            }

            if ($hasGraduated == 0) {
                return $count - 1;
            }
            if ($hasGraduated >= 3) {
                if ($hasGold >= 1) {

                    if ($hasGraduated >= 4) {
                        if ($hasGold >= 2) {
                            return $count;
                        }
                        $count--;
                    }
                    return $count;
                }
                return $count - 1;
            }

        }
    }

    protected function validate($userActiveNetwork, $bonus, $count)
    {
        return ($userActiveNetwork >= $this->activeUsers[$count] && $bonus >= $this->bonusTotal[$count]);
    }
    
    
}
