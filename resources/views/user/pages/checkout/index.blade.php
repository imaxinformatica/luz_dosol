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
    getSessionScript();
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
            // $("#finishOrder form input[name='session_id']").val(data);
            PagSeguroDirectPayment.setSessionId(data);
            console.log(data);
            getPaymentMethodScript();
            $('#finishOrder').modal('show');
        }
    });
}

function getPaymentMethodScript() {
    PagSeguroDirectPayment.getPaymentMethods({
        success: function(data) {
            var response = $.parseJSON(data);
            console.log(response);
        },
        error: function(data) {
	    // Callback para chamadas que falharam.
	},
	complete: function(data) {
	    // Callback para todas chamadas.
	}
    });
}
</script>
@endsection

@section('modals')
<div class="modal fade" tabindex="-1" role="dialog" id="finishOrder">
    <div class="modal-dialog" role="document">
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
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xs-8" style="padding-top:5px;">
                            <p>Tem certeza que deseja finalizar pedido?</p>
                        </div>
                        <div class="col-xs-4">
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">R$</span>
                                    <input type="text" name="price" value="{{convertMoneyUSAtoBrazil($total)}}"
                                        class="form-control input-money" readonly>
                                </div>
                            </div>
                        </div>
                    </div>

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