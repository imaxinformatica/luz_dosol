<?php

namespace Tests\Unit;

use App\Cart;
use App\Services\CartService;
use App\User;
use Tests\TestCase;
use Tests\MigrateFreshSeedOnce;

class CartTest extends TestCase
{
    use MigrateFreshSeedOnce;
    public function testIncluirItemCarrinho()
    {
        $this->createItemCart();

        $this->assertDatabaseHas('carts', [
            'product_id' => 123,
            'user_id' => 1,
            'qty' => 5,
        ]);
    }

    // public function testAtualizaQuantidadeItemCarrinho()
    // {
    //     $this->createItemCart();

    //     $this->updateQtdItemCart();

    //     $this->assertDatabaseHas('carts', [
    //         'product_id' => 123,
    //         'user_id' => 1,
    //         'qty' => 7,
    //     ]);
    // }

    public function testRemoveItemCarrinho()
    {
        $this->createItemCart();
        $this->removeItemCart();

        $this->assertDatabaseMissing('carts', [
            'product_id' => 123,
            'user_id' => 1,
            'qty' => 5,
        ]);
    }

    public function createItemCart()
    {
        $itemCart = [
            "product_id" => "123",
            "qty" => "5",
            "user_id" => "1",
            "price" => 22,
        ];
        CartService::store($itemCart);
    }

    public function updateQtdItemCart()
    {
        $this->addUser();
        $user = User::find(1);
        $data = [
            "product_id" => "123",
            "value" => "7",
        ];
        CartService::update($user, $data);
    }

    public function removeItemCart()
    {
        $cart = Cart::first();
        CartService::delete($cart);
    }

    public function addUser()
    {
        factory(\App\User::class, 1)->create([
            'user_id' => null,
        ]);
    }

}
