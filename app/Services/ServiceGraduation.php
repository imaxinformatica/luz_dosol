<?php
namespace App\Services;

use User;

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

}
