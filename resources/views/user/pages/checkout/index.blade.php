@extends('user.templates.default')

@section('title', 'Finalizar pedido')

@section('description', 'Descrição')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="row">
            <div class="col-sm-6">
                <h1>Finalizar pedido</h1>
            </div>
            <div class="col-sm-6">
                <button class="btn-header finishOrder">FINALIZAR PEDIDO</button>
            </div>
        </div>
    </section>

    @if(session()->has('success'))
    <section class="content-header">
        <!-- Main row -->
        <div class="row">
            <!-- Left col -->
            <section class="col-sm-12">
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    {{session('success')}}
                </div>
            </section>
        </div>
    </section>
    @endisset

    @if(session()->has('warning'))
    <section class="content-header">
        <!-- Main row -->
        <div class="row">
            <!-- Left col -->
            <section class="col-sm-12">
                <div class="alert alert-warning alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    {{session('warning')}}
                </div>
            </section>
        </div>
    </section>
    @endisset
    @if(session()->has('error'))
    <section class="content-header">
        <!-- Main row -->
        <div class="row">
            <!-- Left col -->
            <section class="col-sm-12">
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    {{session('error')}}
                </div>
            </section>
        </div>
    </section>
    @endisset

    @if ($errors->any())
    <div class="content-header">
        @foreach ($errors->all() as $error)
        <div class="row">
            <div class="col-sm-12">
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    {{ $error }}
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @endif

    <!-- Main content -->
    <section class="content">


        <!-- Main row -->
        <div class="row">
            <!-- Left col -->
            <section class="col-lg-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Lista de itens</h3>
                        <h3 class="box-title pull-right">Total:R$ {{convertMoneyUSAtoBrazil($total)}}</h3>
                    </div>
                    <div class="box-body table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Imagem</th>
                                    <th scope="col">Referência</th>
                                    <th scope="col">Nome</th>
                                    <th scope="col">Quantidade</th>
                                    <th scope="col">Preço</th>
                                    <th scope="col">Subtotal</th>
                                    <th scope="col">Ação</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($itemsCart as $item)
                                <tr>
                                    <td>
                                        <img class="image-product-checkout"
                                            src="{{asset('uploads/products/thumbnail/'. $item->file)}}"
                                            alt="Imagem do produto">
                                    </td>
                                    <td>{{$item->reference}}</td>
                                    <td>{{$item->name}}</td>
                                    <td>{{$item->pivot->qty}}</td>
                                    <td>R${{convertMoneyUSAtoBrazil($item->price)}}</td>
                                    <td>R${{convertMoneyUSAtoBrazil($item->price * $item->pivot->qty)}}</td>
                                    <td>
                                        <a href="{{route('user.cart.delete', ['cart' => $item->pivot->id])}}"
                                            title="Excluir" class="act-list act-delete">
                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="8">Nenhum item adicionado ao carrinho</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
            </section>
        </div>
        <!-- /.row (main row) -->
    </section>
    <!-- /.content -->
</div>

@stop
@section('scripts')
<script type="text/javascript">
$('.finishOrder').on('click', function() {
    var total = {{$total}};
    if (total === 0) {
        $('#modalPriceInferior').modal('show');

    } else {
        getSessionScript();
    }
});

function getSessionScript() {
    $.ajax({
        type: 'POST',
        url: "{{route('session.pagseguro')}}",
        data: {
            _token: "{{ csrf_token() }}",
        },
        beforeSend: function() {},
        success: function(data) {
            $("#finishOrder form input[name='session_id']").val(data);
            PagSeguroDirectPayment.setSessionId(data);
            $('#finishOrder').modal('show');
            getHashScript();
            getPaymentMethod();
        }
    });
}

$('#payment_method').on('change', function() {
    getPaymentMethod()
});

function getPaymentMethod() {
    let payment_method = $('#payment_method').val();
    if (payment_method == 'credit_card') {

        $.ajax({
            type: 'GET',
            url: "{{route('card.content')}}",
            beforeSend: function() {},
            success: function(data) {
                $('#card').html(data);
                $('#card').slideDown();
            }
        });
    } else {
        $('#card').slideUp();
        $('#card').html("");
    }
}

function getHashScript() {
    PagSeguroDirectPayment.onSenderHashReady(function(response) {
        if (response.status == 'error') {
            console.log(response.message);
            return false;
        }
        var hash = response.senderHash; //Hash estará disponível nesta variável.
        $("#finishOrder form input[name='sender_hash']").val(hash);
    });
}
$("#cvv").keyup(function() { //criar token
    getTokenCreditCard();
});
$('#shipping_type').on('change', function() {
    var shipping_type = $(this).val();
    var zip_code = $('input[name="zip_code"]').val();
    getShippingScript(shipping_type,zip_code);
});

function getShippingScript(shipping_type,zip_code) {
    $.ajax({
        type: 'GET',
        url: "{{route('get.shipping')}}",
        data: {
            shipping_type: shipping_type,
            zip_code: zip_code
        },  
        beforeSend: function() {
            $('#delivery_time').val('Carregando..');
            $('#shipping_price').val('Carregando..');
            $('#total').val('Carregando..');
        },
        success: function(data) {
            if (data == 'null') {
                $('#modalGeneric .modal-title').html('Peso superior ao permitido!');
                $('#modalGeneric .modal-body').html('<p>As informações referente ao seu pedido possuem divergências em relação ao permitido pelo Correios!</p>');
                $('#modalGeneric').modal('show');
            } else if(data == 'error'){
                $('#modalGeneric .modal-title').html('Erro!');
                $('#modalGeneric .modal-body').html('<p>Ops, tivemos um problema, por favor, entre em contato com um de nossos administradores.</p>');
                $('#modalGeneric').modal('show');
            }else{
                let responseDelivery = $.parseJSON(data);
                console.log(responseDelivery);
                $('#delivery_time').val(responseDelivery.delivery_time);
                $('#shipping_price').val(responseDelivery.shipping_price);
                $('#total').val(responseDelivery.new_total);
            }
        }
    });
}

$(document).on('change', '#isBilling', function() {
    let billing = $(this).val();
    if (billing == 0) {
        $.ajax({
            type: 'GET',
            url: "{{route('address.content')}}",
            beforeSend: function() {},
            success: function(data) {
                $('#address').html(data);
                $('#address').slideDown();
            }
        });
    } else {
        $('#address').slideUp();
        $('#address').html("");
    }
});

function getTokenCreditCard() {

    number_card = $("#number_card").val();
    cvv = $("#cvv").val();
    expiration_month = $("#expiration_month").val();
    expiration_year = $("#expiration_year").val();
    brand = $('#brand').val();

    PagSeguroDirectPayment.createCardToken({
        cardNumber: number_card,
        brand: brand,
        cvv: cvv,
        expirationMonth: expiration_month,
        expirationYear: expiration_year,

        success: function(response) {
            $(".token_card").val(response['card']['token']);
            console.log(response)
        },
        error: function(response) {
            console.log(response);
        }
    });
}
</script>
@endsection

@section('modals')

<!--CEP não encontrado-->
<div class="modal fade" id="modalPriceInferior">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Carrinho vazio</h4>
            </div>
            <div class="modal-body">
                <p>Adicionar pelo menos um produto ao carrinho!</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Confirmar</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!--/.CEP não encontrado-->
<div class="modal fade" tabindex="-1" role="dialog" id="finishOrder">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Finalizar Pedido</h4>
            </div>
            <form method="post" action="{{route('user.order.checkout')}}">
                {{csrf_field()}}
                <input type="hidden" name="session_id">
                <input type="hidden" name="sender_hash">
                <input type="hidden" name="price" value="{{convertMoneyUSAtoBrazil($total)}}>
                <input type="hidden" name="token_card" class="token_card">
                <div class="modal-body">

                    <div class="row">
                        <div class="col-xs-4">
                            <div class="form-group">
                                <label for="zip_code">CEP</label>
                                <input type="text" name="zip_code" class="form-control input-cep"
                                    value="{{$user->address->zip_code}}">
                            </div>
                        </div>
                        <div class="col-xs-8">
                            <div class="form-group">
                                <label for="street">Rua</label>
                                <input type="text" name="street" id="street" class="form-control"
                                    value="{{$user->address->street}}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-4">
                            <div class="form-group">
                                <label for="number">Número</label>
                                <input type="text" name="number" id="number" class="form-control"
                                    value="{{$user->address->number}}">
                            </div>
                        </div>
                        <div class="col-xs-8">
                            <div class="form-group">
                                <label for="neighborhood">Bairro</label>
                                <input type="text" name="neighborhood" id="neighborhood" class="form-control"
                                    value="{{$user->address->neighborhood}}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-4">
                            <div class="form-group">
                                <label for="complement">Complemento</label>
                                <input type="text" name="complement" id="complement" class="form-control"
                                    value="{{$user->address->complement}}">
                            </div>
                        </div>
                        <div class="col-xs-4">
                            <div class="form-group">
                                <label for="city">Cidade</label>
                                <input type="text" name="city" id="city" class="form-control"
                                    value="{{$user->address->city}}">
                            </div>
                        </div>
                        <div class="col-xs-4">
                            <div class="form-group">
                                <label for="state">Estado</label>
                                <input type="text" name="state" id="state" class="form-control"
                                    value="{{$user->address->state}}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-4">
                            <div class="form-group">
                                <label for="shipping_type">Tipo de frete</label>
                                <select name="shipping_type" id="shipping_type" class="form-control" required>
                                    <option disabled selected>Selecione..</option>
                                    <option value="04510">PAC</option>
                                    <option value="04014">Sedex</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-4">
                            <div class="form-group">
                                <label for="shipping_price">Total frete</label>
                                <div class="input-group">
                                    <span class="input-group-addon">R$</span>
                                    <input type="text" name="shipping_price" id="shipping_price" value="0,00"
                                        class="form-control input-money" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-4">
                            <div class="form-group">
                                <label for="delivery_time">Prazo de entrega</label>
                                <div class="input-group">
                                    <input type="text" name="delivery_time" id="delivery_time"
                                        class="form-control" readonly>
                                    <span class="input-group-addon">dias</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label for="total">Total</label>
                                <div class="input-group">
                                    <span class="input-group-addon">R$</span>
                                    <input type="text" name="total" id="total" value="{{convertMoneyUSAtoBrazil($total)}}"
                                        class="form-control input-money" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label for="payment_method">Forma de pagamento</label>
                                <select name="payment_method" id="payment_method" class="form-control" required>
                                    <option disabled selected>Selecione..</option>
                                    <option value="boleto">Boleto</option>
                                    <option value="credit_card">Cartão de Credito</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div id="card"></div> <!-- Coloca o conteudo do cartao-->
                </div>
                <div class="modal-footer">
                    <div class="row">
                        <div class="col-sm-12">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                            <button type="submit" class="btn btn-primary">Confirmar</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection