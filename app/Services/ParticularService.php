<?php

namespace App\Services;

use App\ParticularShip;

class ParticularService
{
    public static function create(array $data)
    {
        $data['price'] = \convertMoneyBraziltoUSA($data['price']);
        return ParticularShip::create($data);
    }

    public static function update(array $data, ParticularShip $particular)
    {
        $data['price'] = \convertMoneyBraziltoUSA($data['price']);
        $particular->fill($data);
        $particular->save();
    }

    public static function delete(ParticularShip $particular)
    {
        $particular->delete();
    }
}