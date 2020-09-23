<?php

namespace App\Http\Controllers\Test;

use App\Http\Controllers\Controller;
use App\Http\Controllers\User\OrderController;
use App\Http\Requests\CheckoutRequest;
use App\Order;
use App\Services\BonusService;
use App\Services\CartService;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BonusTestController extends Controller
{
    public function testFirstOrderMonth(OrderController $orderCon)
    {
        // Autentica o Usuário
        $user = User::first();
        \Auth::guard('user')->login($user, true);

        //Adiciona o item ao carrinho
        $dataCart = $this->addItemCart($user);
        // Array Pedido
        $arrayPagSeguro = $this->makeArrayPagSeguro();
        // Prepara requisição checkout
        $requestCheckout = $this->makeRequestCheckout();
        // Faz o Checkout
        $response = $orderCon->checkout($requestCheckout, $arrayPagSeguro, true);
        $orderCode[0] = $arrayPagSeguro['code'];
        // Mostra primeiro pedido
        echo "<h1>Primeiro Pedido</h1>";
        $orders = \App\Order::get();
        foreach ($orders as $order) {
            $this->showOrderUser($order);
        }

        // atualiza o item do carrinho
        $dataCart['qty'] = 10;
        CartService::store($dataCart);

        // atualização checkout
        $requestCheckout["price"] = "100,00";
        $requestCheckout["total"] = "138,20";

        $arrayPagSeguro['status'] = 1;
        $arrayPagSeguro['code'] = rand(10000, 999999999);
        $arrayPagSeguro['grossAmount'] = "138.20";

        $orderCode[1] = $arrayPagSeguro['code'];

        $orderCon->checkout($requestCheckout, $arrayPagSeguro, true);

        echo "<h1>Tentativa do segundo Pedido sem estar aprovado</h1>";

        $orders = \App\Order::get();
        foreach ($orders as $order) {
            $this->showOrderUser($order);
        }
        $request = new Request();
        $arrayXML = [
            'code' => $orderCode[0],
            'status' => 3,
        ];
        $xml = (object) $arrayXML;

        $orderCon->callback($request, true, $xml);
        $orderCon->checkout($requestCheckout, $arrayPagSeguro, true);

        echo "<h1>Após ter sido aprovado</h1>";

        $orders = \App\Order::get();
        foreach ($orders as $order) {
            $this->showOrderUser($order);
        }
    }

    public function bonification()
    {
        $user = User::first();
        for ($i = 0; $i < 2; $i++) {
            foreach ($user->users as $user) {
                // Autentica o Usuário

                $this->generateOrderProcess($user);
                foreach ($user->users as $childUser) {
                    // Autentica o Usuário
                    $this->generateOrderProcess($childUser);
                }
                $this->showUser($user);
            }
        }
        $this->showUser(User::first());
    }

    public function commission()
    {
        $user = User::first();
        foreach ($user->users as $key => $user) {
            $this->loopUsers($user);
            // $this->generateOrderProcess($user);
        }
    }

    public function graduation()
    {
        $user = User::first();
        $users = $this->listaUsuarios($user, 10);
        echo '<ul>';
        echo "<li>";
        echo '' . $user->getNameGraduation() . ' - ' . $user->name . ' - ' . count($user->users) . ' cadastros diretos';
        echo "</li>";
        $this->showRede($users);
        echo '</ul>';

    }
    public function bonus(BonusService $sv)
    {
        $user = User::first();
        foreach ($user->users as $key => $childUser) {
            $this->loopUsers($childUser);
            $this->generateOrderProcess($childUser);
        }
        $sv->bonus();

        echo "<p>Usuario: {$user->name}<br>";
        echo "Bonificacao: {$user->getBonus('9', '2020')}</p><br>";
        echo "<hr>Usuários Nível 1: </br>";
        $item = '';
        foreach ($user->users as $user) {
            echo "Nome: {$user->name}<br>";
            echo "Status: {$user->status}<br>";
            foreach ($user->users as $user) {
                $item .= "--Nome: {$user->name}<br>";
                $item .= "--Status: {$user->status}<br>";
            }
        }
        echo "<hr>Usuários Nível 2: </br>";
        echo $item;
    }
    private function showRede($users)
    {
        echo '<ul>';
        foreach ($users as $user) {
            echo "<li>";
            echo 'Graduacao' . $user->getNameGraduation() . ' - Nome: ' . $user->name . ' - ' . count($user->filhos) . ' cadastros diretos' . ' - Pedidos: '. $user->orders->count() . ' - Total Pedidos: '. $user->orders->sum('subtotal');

            if (count($user->filhos) > 0) {
                $this->showRede($user->filhos);
            }
            echo "</li>";
        }
        echo '</ul>';
    }

    private function showOrderUser($order)
    {
        echo "Nº Pedido: $order->id";
        echo "<br>Subtotal: $order->subtotal";
        echo "<br>Frete: $order->shipping";
        echo "<br>Total: $order->total";
        echo "<br>Usuário: {$order->user->name}";
        echo "<br>Status: {$order->getStatus()}";
        echo "<br><hr>";
    }

    private function showUser($user)
    {
        echo "<h2>Usuario: {$user->name}<br>";
        echo "Bonificacao: {$user->getBonus('9', '2020')}</h2>";
        echo "<h5>Usuários Nível 1: </h5>";
        foreach ($user->users as $user) {
            echo "---Usuario: {$user->name} - (Pedidos: " . $user->orders->count() . ")<br>";

        }
        echo ("<hr>");
    }
    private function listaUsuarios($user, $limite)
    {
        $lista = [];
        // Busca usuários cadastrados pelo usuários logado
        if ($user->users->count() > 0) {
            $lista = $user->users;

            foreach ($lista as $chave => $user) {
                $lista[$chave]['filhos'] = [];
                if ($limite > 0) {
                    $lista[$chave]['filhos'] = $this->listaUsuarios($user, $limite - 1);
                }
            }
        }
        return $lista;
    }

    private function loopUsers($user)
    {
        echo "<p>Usuário: {$user->name}</p>";
        echo "<p>Comissão: {$user->getCommission('09', '2020')}</p>";
        $users = $this->listaUsuarios($user, 10);
        $this->showRede($users);
        foreach ($user->users as $user) {
            $this->loopUsers($user);
            // $this->generateOrderProcess($user);
        }
        // $this->generateOrderProcess($user);
    }

    private function generateOrderProcess($user)
    {
        $orderCon = new OrderController();
        \Auth::guard('user')->login($user, true);

        //Adiciona o item ao carrinho
        $dataCart = $this->addItemCart($user);

        // Array Pedido
        $arrayPagSeguro = $this->makeArrayPagSeguro();

        // Prepara requisição checkout
        $requestCheckout = $this->makeRequestCheckout();
        // Faz o Checkout
        $orderCon->checkout($requestCheckout, $arrayPagSeguro, true);

        $request = new Request();
        $arrayXML = [
            'code' => $arrayPagSeguro["code"],
            'status' => 3,
        ];
        $xml = (object) $arrayXML;

        $orderCon->callback($request, true, $xml);
    }

    private function makeRequestCheckout()
    {
        $data = new CheckoutRequest();

        $data["sender_hash"] = null;
        $data["price"] = "500,00";
        $data["token_card"] = null;
        $data["zip_code"] = "08225-485";
        $data["street"] = "0000";
        $data["number"] = "0";
        $data["neighborhood"] = "0000";
        $data["complement"] = "000";
        $data["city"] = "000";
        $data["state"] = "RR";
        $data["shipping_type"] = "04014";
        $data["shipping_price"] = "38,20";
        $data["delivery_time"] = "9";
        $data["total"] = "538,20";
        $data["payment_method"] = "boleto";
        return $data;
    }

    private function makeArrayPagSeguro()
    {
        $data['shipping']['cost'] = "38.20";
        $data['paymentLink'] = 'teste';
        $data['status'] = 1;
        $data['code'] = rand(10000, 999999999);
        $data['grossAmount'] = "538.20";
        return $data;
    }

    private function addItemCart($user)
    {
        $dataCart = [
            "product_id" => 123,
            "qty" => 50,
            "user_id" => $user->id,
            "price" => 10.0,
        ];
        CartService::store($dataCart);
        return $dataCart;
    }
}
