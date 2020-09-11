<?php

namespace Tests\Unit;

use App\User;
use Tests\TestCase;
use App\Services\CartService;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BonusTest extends TestCase
{
    public function testExample()
    {
        factory(\App\User::class, 1)->create([
            'user_id' => null,
        ]);

        $itemCart = [
            'product_id'=> "123",
            "qty" => "10",
            "user_id" => "1",
            "price" => 22
        ];
        CartService::include($itemCart);
        $this->assertDatabaseHas('users', [
            'id' => 1,
        ]);
        $this->assertDatabaseHas('carts', [
            'product_id' => 123,
            'qty' => 10,
        ]);
    }


}
