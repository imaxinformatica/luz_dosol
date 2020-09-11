<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class OrderControllerTest extends TestCase
{
    use RefreshDatabase;
    public function testAcessoPaginaCarrinho()
    {
        $this->seed('TestSeeder');
        $user = User::first();
        \Auth::guard('user')->login($user, true);

        $response = $this->get(route('user.cart.index'));

        $response->assertSuccessful();
        $response->assertViewIs('user.pages.checkout.index');
        $response->assertViewHas('user');
        $response->assertViewHas('total');
        $response->assertViewHas('itemsCart');
    }

    public function testCheckout()
    {
        $this->seed('TestSeeder');

        $this->browse(function ($browser) {
            $browser->visit('/login')
                ->type('email', 'luzdosol@gmail.com')
                ->type('password', 'luzsol2020')
                ->press('LOGIN')
                ->assertPathIs('/user/dashboard');
        });

    }
}
