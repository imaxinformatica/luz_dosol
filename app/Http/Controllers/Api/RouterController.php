<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\BonusService;
use App\Services\BusinessService;
use App\Services\GraduationService;
use App\User;

class RouterController extends Controller
{
    protected $businessService;
    
    public function __construct(
        GraduationService $graduationService,
        BusinessService $businessService,
        BonusService $bonusService
    ) {
        $this->businessService = $businessService;
        $this->graduationService = $graduationService;
        $this->bonusService = $bonusService;
    }

    public function resetMonth()
    {
        $this->businessService->resetMonth();

        echo "Usuários Resetados";
    }

    public function setBonus()
    {
        $this->bonusService->bonus();
    }

    public function graduation()
    {
        $users = User::where('status', 1)->get();
        $graduations = [];
        foreach ($users as $user) {
            $graduation = $this->graduationService->getGraduation($user);
            array_push($graduations, $graduation);
        }
        dd($graduations);
    }
}
