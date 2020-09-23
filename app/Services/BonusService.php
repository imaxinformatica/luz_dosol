<?php
namespace App\Services;

use App\Bonus;
use App\ExtraBonus;
use App\User;

class BonusService
{
    private $level;
    private $extraUser;
    private $priceBonus;

    private static $count = 1;

    public function __construct()
    {
        $this->level = [
            "1" => 1.5,
            "2" => 1.5,
            "3" => 1.5,
            "4" => 1,
            "5" => 1,
            "6" => 1,
            "7" => 0.5,
            "8" => 0.5,
        ];
        $this->extraUser = [
            "1" => 3,
            "2" => 6,
            "3" => 14,
            "4" => 40,
            "5" => 120,
        ];
        $this->priceBonus = [
            "1" => 10,
            "2" => 20,
            "3" => 40,
            "4" => 120,
            "5" => 360,
        ];
    }

    protected function totalExtraUser($userActive, $user, $date)
    {
        $totalExtraBonus = $user->extraBonus()
            ->whereMonth('updated_at', $date[0])
            ->whereYear('updated_at', $date[1])
            ->where('level_bonus', self::$count)
            ->count();
        return $userActive - $this->extraUser[self::$count] - $totalExtraBonus;
    }
    protected function loopBonus($user, array $date, $graduation)
    {
        $userActiveNetwork = $user->users->where('status', 1)->count();
        $bonus = $user->bonus()
            ->whereMonth('updated_at', $date[0])
            ->whereYear('updated_at', $date[1])
            ->get();
        if ($userActiveNetwork >= $this->extraUser[self::$count]) {
            $extraUser = $this->totalExtraUser($userActiveNetwork, $user, $date);
            $this->extraBonus($extraUser, self::$count, $graduation, $user);
            if (count($bonus->where('level_bonus', self::$count)) === 0) {
                Bonus::create([
                    'user_id' => $user->id,
                    'price' => $this->priceBonus[self::$count],
                    'level_bonus' => self::$count,
                ]);
            }
        }

        self::$count++;
        $networkUser = [$user->id];
        for ($i = 0; $i < 4; $i++) {
            $networkUser = User::whereIn('user_id', $networkUser)
                ->pluck('id')
                ->toArray();

            $childNetWorkUser = User::whereIn('user_id', $networkUser)
                ->where('status', 1)
                ->count();

            if ($childNetWorkUser >= $this->extraUser[self::$count]) {
                $extraUser = $this->totalExtraUser($childNetWorkUser, $user, $date);
                $this->extraBonus($extraUser, self::$count, $graduation, $user);
                if (count($bonus->where('level_bonus', self::$count)) === 0) {
                    Bonus::create([
                        'user_id' => $user->id,
                        'price' => $this->priceBonus[self::$count],
                        'level_bonus' => self::$count,
                    ]);
                }
            }
            self::$count++;
        }
        self::$count = 1;

    }
    public function bonus()
    {
        $date = setDate(date('m-Y', strtotime('0 day')));
        $today = setDate(date('m-Y'));
        if ($date == $today) {
            updateStatusUser(User::get(), $today);
        }
        $users = User::where('status', 1)->get();

        foreach ($users as $user) {
            $graduation = $user->getGraduation();
            $this->loopBonus($user, $date, $graduation);
            $realExtraBonus = $user->extraBonus()
                ->whereMonth('updated_at', $date[0])
                ->whereYear('updated_at', $date[1])
                ->get();
            $this->updateExtraBonus($realExtraBonus, $graduation);
        }
        echo 'Bônus Atualizados';
    }
    public function extraBonus($extraUser, $levelBonus, $graduation, $user)
    {
        if (!$graduation) {
            return;
        }
        for ($i = 0; $i < $extraUser; $i++) {
            ExtraBonus::create([
                'user_id' => $user->id,
                'price' => $this->level[$graduation],
                'level_bonus' => $levelBonus,
            ]);
        }
    }

    public function updateExtraBonus($extraBonus, $graduation)
    {
        if (!$graduation) {
            return;
        }

        foreach ($extraBonus as $extra) {
            $extra->update(['price' => $this->level[$graduation]]);
        }
    }
}
