<?php

namespace App\Services;

use App\User;

class ServiceGraduation
{
    public function getMaxGraduation()
    {
        $users = User::where('status', 1)->get();

        foreach ($users as $user) {
            $typeGraduation = $user->typeOfGraduation($user->getGraduation());
            if ($user->graduation()->count() > 0) {
                if ($typeGraduation > $user->graduation->max_graduation) {
                    $user->graduation()->update([
                        'max_graduation' => $typeGraduation,
                    ]);
                }
            } else {
                $user->graduation()->create([
                    'max_graduation' => $typeGraduation,
                ]);
            }
        }
    }

    public function getBronzeGraduation($activeUsers, $bonusTotal): bool
    {
        if ($bonusTotal >= 30 && $activeUsers >= 2) {
            return true;
        }
        return false;
    }

    public function getSilverGraduation($activeUsers, $bonusTotal): bool
    {
        if ($bonusTotal >= 105 && $activeUsers >= 2) {
            return true;
        }
        return false;
    }

    public function getGoldGraduation(User $u, $activeUsers, $bonusTotal): bool
    {

        // Verifica se o usuario tem duas pesssoas no nivel 2 ativas e ao minimo um bonus de 850
        if ($activeUsers >= 2 && $bonusTotal >= 850) {
            // caso possua, ele fara um foreach em todos os usuarios da sua rede
            $networkUser = $u->users()->get();

            /**
             * @var userGraduated = numero de usuários graduados (precisa de no minimo 3)
             */
            $userGraduated = 0;

            foreach ($networkUser as $user) {
                // Se ja possuir os tres usuarios graduados, sai do loop e retorna true
                if ($userGraduated >= 3) {
                    break;
                }
                /**
                 * verifica se o osuario do loop no nivel 1 é graduado. 
                 * Se sim, incrementa a @var userGraduated.
                 * Caso Contrário verifica a rede nivel 2 desse usuario
                 *  */
                // Level 1
                if ($user->getGraduation()) {
                    $userGraduated++;
                } else {
                    /**
                     * verifica se o osuario do loop no nivel 2 é graduado. 
                     * Se sim, incrementa a @var userGraduated e sai do loop
                     * Caso Contrário verifica a rede nivel 3 desse usuario
                     * e repete o fluxo ate o nivel 10
                     *  */
                    // Level 2
                    
                    $usersLevel2 = $user->users()->get();

                    foreach ($usersLevel2 as $userLevel2) {
                        if ($userLevel2->getGraduation()) {
                            $userGraduated++;
                            break;
                        } else {
                            // Level 3
                            $usersLevel3 = $userLevel2->users()->get();
                            foreach ($usersLevel3 as $userLevel3) {
                                if ($userLevel3->getGraduation()) {
                                    $userGraduated++;
                                    break;
                                } else {
                                    // Level 4
                                    $usersLevel4 = $userLevel3->users()->get();
                                    foreach ($usersLevel4 as $userLevel4) {
                                        if ($userLevel4->getGraduation()) {
                                            $userGraduated++;
                                            break;
                                        }
                                        else {
                                        // Level 5
                                        $usersLevel5 = $userLevel4->users()->get();
                                        foreach ($usersLevel5 as $userLevel5) {
                                            if ($userLevel5->getGraduation()) {
                                                $userGraduated++;
                                                break;
                                            } else {
                                                // Level 6
                                                $usersLevel6 = $userLevel5->users()->get();
                                                foreach ($usersLevel6 as $userLevel6) {
                                                    if ($userLevel6->getGraduation()) {
                                                        $userGraduated++;
                                                        break;
                                                    } else {
                                                        // Level 7
                                                        $usersLevel7 = $userLevel6->users()->get();
                                                        foreach ($usersLevel7 as $userLevel7) {
                                                            if ($userLevel7->getGraduation()) {
                                                                $userGraduated++;
                                                                break;
                                                            } else {
                                                                // Level 8
                                                                $usersLevel8 = $userLevel7->users()->get();
                                                                foreach ($usersLevel8 as $userLevel8) {
                                                                    if ($userLevel8->getGraduation()) {
                                                                        $userGraduated++;
                                                                        break;
                                                                    } else {
                                                                        // Level 9
                                                                        $usersLevel9 = $userLevel8->users()->get();
                                                                        foreach ($usersLevel9 as $userLevel9) {
                                                                            if ($userLevel9->getGraduation()) {
                                                                                $userGraduated++;
                                                                                break;
                                                                            } else {
                                                                                // Level 10
                                                                                $usersLevel10 = $userLevel9->users()->get();
                                                                                foreach ($usersLevel10 as $userLevel10) {
                                                                                    if ($userLevel10->getGraduation()) {
                                                                                        $userGraduated++;
                                                                                        break;
                                                                                    }
                                                                                } //.!.Level 10
                                                                            }
                                                                        } //.!.Level 9
                                                                    }
                                                                } //.!.Level 8
                                                            }
                                                        } //.!.Level 7
                                                    }
                                                } //.!.Level 6
                                            }
                                        } //.!.Level 5
                                        }
                                    } //.!.Level 4
                                }
                            } //.!.Level 3
                        }
                    } //.!.Level 2

                }
            } //.!.Level 1
            return ($userGraduated >= 3) ? true : false;
        } else {
            return false;
        }
    }
}
