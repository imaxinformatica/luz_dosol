<?php
namespace App\Services;

class ServiceCommission
{
    public function validateDataService(array $data): array
    {
        foreach ($data as $key => $commission) {
            $data[$key] = convertMoneyBraziltoUSA($commission);
        }
        return $data;
    }
}