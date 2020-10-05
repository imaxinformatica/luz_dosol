<?php

namespace Tests\Feature;

use App\Http\Controllers\User\OrderController;
use App\User;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Request;
use Tests\MigrateFreshSeedOnce;
use Tests\TestCase;

class OrderControllerTest extends TestCase
{
    use WithoutMiddleware;
    use MigrateFreshSeedOnce;

    public function testAdicionarUmItemAoCarrinho()
    {
        $user = User::first();
        \Auth::guard('user')->login($user, true);

        $response = $this->post('user/carrinho/incluir', [
            'product_id' => 123,
            'qty' => 10,
        ]);
        $this->assertDatabaseHas('carts', [
            'product_id' => 123,
            'user_id' => $user->id,
            'qty' => 10,
        ]);
    }
    public function testAcessandoAPaginaDePedido()
    {
        $user = User::first();
        \Auth::guard('user')->login($user, true);

        $response = $this->get(route('user.cart.index'));
        $response->assertSuccessful();
        $response->assertViewIs('user.pages.checkout.index');
        $response->assertViewHas('user');
        $response->assertViewHas('total');
        $response->assertViewHas('itemsCart');
    }

    public function testPedidoComValorMinimoAbaixo()
    {
        $user = User::first();
        \Auth::guard('user')->login($user, true);

        $response = $this->post('user/pedido/checkout', [
            "session_id" => "59adb022b06f4c319f9dbb4faceea0a7",
            "sender_hash" => null,
            "price" => "100,00",
            "token_card" => null,
            "zip_code" => "13155-444",
            "street" => "0000",
            "number" => "0",
            "neighborhood" => "0000",
            "complement" => "000",
            "city" => "000",
            "state" => "RR",
            "shipping_type" => "04014",
            "shipping_price" => "38,29",
            "delivery_time" => "9",
            "total" => "138,29",
            "payment_method" => "boleto",
        ]);
        $response->assertSessionHas('warning', 'O primeiro pedido do mês precisa ser no mínimo de R$200,00');
    }
    public function testPedidoComValorMinimoAcima()
    {
        // Assert
        $user = User::first();
        \Auth::guard('user')->login($user, true);

        $this->post('user/carrinho/incluir', [
            'product_id' => 123,
            'qty' => 20,
        ]);
        $orderController = new OrderController();
        $req = new Request();
        $response = $this->post('user/pedido/checkout', [
            "session_id" => "59adb022b06f4c319f9dbb4faceea0a7",
            "sender_hash" => null,
            "price" => "200,00",
            "token_card" => null,
            "zip_code" => "13155-444",
            "street" => "0000",
            "number" => "0",
            "neighborhood" => "0000",
            "complement" => "000",
            "city" => "000",
            "state" => "RR",
            "shipping_type" => "04014",
            "shipping_price" => "38,29",
            "delivery_time" => "9",
            "total" => "238,29",
            "payment_method" => "boleto",
        ]);

        // $response->assertSessionHas('success', 'Pedido finalizado');
        // $this->assertEquals(1,$user->status);
        // $this->assertDatabaseHas('bonuses', [
        //     'user_id' => $user->id,
        //     'price' => 34,
        //     'level_bonus' => 1,
        // ]);
    }

}
