<?php

namespace App\Services;

use App\User;
use App\ActiveUser;
use App\Services\GraduationService;

class BusinessService
{
    protected $month;
    protected $year;
    protected $bonusService;
    protected $graduationService;
    public function __construct(GraduationService $graduationService)
    {
        $date = date('m-Y', strtotime('-1 day'));
        list($month, $year) = explode('-', $date);

        $this->month = $month;
        $this->year = $year;
        $this->graduationService = $graduationService;
        
    }

    public function resetMonth()
    {
        $this->registerMaxGraduation();
        // User::where('status', 1)
        //     ->update(['status' => 0]);

    }
    public function registerMaxGraduation()
    {
        $idActiveUsers = ActiveUser::whereMonth('date_active', $this->month)
            ->whereYear('date_active', $this->year)
            ->pluck('user_id')
            ->toArray();
            
            $users = User::whereIn('id', $idActiveUsers)->get();

        foreach ($users as $user) {
            $maxGraduation = $this->graduationService->getGraduation($user);
            $this->setGraduation($maxGraduation, $user);
        }
    }

    public function setGraduation($maxGraduation, $user)
    {
        if (!$user->graduation) {
            $user->graduation()->create([
                'max_graduation' => $maxGraduation,
            ]);
            return;
        }
        if ($maxGraduation > $user->graduation->max_graduation) {
            $user->graduation->update([
                'max_graduation' => $maxGraduation,
            ]);
        }
        return;
    }
}
