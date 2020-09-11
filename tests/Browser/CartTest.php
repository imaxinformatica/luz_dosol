<?php

namespace Tests\Browser;

use App\User;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class CartTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testAddItemToCart()
    {
        $this->browse(function ($first, $second) {
            $first->loginAs(User::find(1))
                ->visit('user/produtos');
            $first->assertPathIsNot('user/login');
        });
    }
}
