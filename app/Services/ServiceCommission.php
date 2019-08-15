<?php
namespace App\Services;

class ServiceCommission
{
    public function validateDataService(Array $data): array
    {
        foreach ($data as $key => $commission) {
            $data[$key] = convertMoneyBraziltoUSA($commission);
        }
        return $data;
    }
}