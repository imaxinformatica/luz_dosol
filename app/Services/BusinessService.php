<?php

namespace App\Services;

use App\ActiveUser;
use App\Models\Payment;
use App\Services\GraduationService;
use App\User;

class BusinessService
{
    protected $month;
    protected $year;
    protected $bonusService;
    protected $graduationService;

    public function __construct(GraduationService $graduationService)
    {
        $date = date('m-Y', strtotime('-5 day'));
        list($month, $year) = explode('-', $date);

        $this->month = $month;
        $this->year = $year;
        $this->graduationService = $graduationService;

    }

    public function resetMonth()
    {
        $this->setMaxGraduation();
        $this->setPayment();
        User::where('status', 1)
            ->update(['status' => 0]);
    }

    public function setPayment()
    {
        $users = User::where('status', 1)->get();
        foreach ($users as $user) {

            $payment = Payment::where('month', $this->month)
                ->where('year', $this->year)
                ->where('user_id', $user->id)
                ->first();

            $total = $user->getTotalBonus($this->month, $this->year);
            if (!$payment && $total > 0) {
                Payment::create([
                    'month' => $this->month,
                    'year' => $this->year,
                    'user_id' => $user->id,
                    'total' => $total,
                ]);
            }
        }
    }

    public function setMaxGraduation()
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
