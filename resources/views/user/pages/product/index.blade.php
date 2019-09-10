@extends('user.templates.default')

@section('title', 'Realizar pedido')

@section('description', 'Descrição')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="row">
            <div class="col-sm-6">
                <h1>Realizar pedido</h1>
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
        <div class="row">
            <div class="col-sm-9">
                <div class="row">
                    <?php
                        $numOfCols = 3;
                        $rowCount = 0;
                        $bootstrapColWidth = 12 / $numOfCols;
					?>
                    @foreach($products as $product)
                    <div class="col-sm-<?= $bootstrapColWidth; ?>">
                        <div class="box-product">
                            <div class="info-box product-box">
                                <img src="{{ asset('uploads/products/original/'. $product->file)}}">
                                <div class="product-body">
                                    <h3>{{$product->name}}</h3>
                                    <h4>R${{convertMoneyUSAtoBrazil($product->price)}}</h4>
                                </div>
                                <div class="product-footer">
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <button class="more-info" data-id="{{$product->id}}" ><i class="fa fa-info"
                                                    aria-hidden="true"></i></button>
                                            <button class="add-cart" data-product_id="{{$product->id}}">ADD AO
                                                CARRINHO</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="box-description display-none" id="box-description-{{$product->id}}">
                                    <span class="close-box" data-id="{{$product->id}}"><i class="fa fa-times-circle" aria-hidden="true"></i></span>
                                    <h4>{{$product->description}}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                        $rowCount++;
                        if($rowCount % $numOfCols == 0) echo '</div><div class="row">';
					?>
                    @endforeach
                </div>
            </div>
            <div class="col-sm-3">
                <h1>Carrinho</h1>
                <table class="table">
                    <tbody>
                        @forelse($itemscart as $item)
                        <tr>
                            <td>
                                <img class="image-product-cart"
                                    src="{{asset('uploads/products/thumbnail/'. $item->file)}}" alt="Imagem do produto">
                            </td>
                            <td>
                                <span class="cart-preview-title">{{$item->name}}</span><br>
                                <b>Ref.:</b> {{$item->reference}}<br>
                                <b>Qtd.:</b> {{$item->pivot->qty}}<br>

                            </td>
                            <td>
                                <a href="{{route('user.cart.delete', ['cart' => $item->pivot->id])}}" title="Excluir"
                                    class="act-list act-delete">
                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td>Nenhum item adicionado ao carrinho</td>
                        </tr>
                        @endforelse
                    </tbody>
                    <tfoot>
                        <button type="button" class="btn btn-primary" onclick="window.location.href='{{route('user.cart.index')}}'">Finalizar Pedido</button>
                    </tfoot>
                </table>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>

@stop
@section('scripts')
<script type="text/javascript">
$('.more-info').on('click', function() {
    let id = $(this).data('id');
    $('#box-description-'+id).removeClass('display-none');
});

$('.close-box').on('click', function() {
    let id = $(this).data('id');
    $('#box-description-'+id).addClass('display-none');
});

$('.add-cart').on('click', function(e) {
    let product_id = $(this).data('product_id');
    $('#itemModal form input[name="product_id"]').val(product_id);
    $('#itemModal').modal('show')
});

$('.add-number-to-qty').click(function() {
    var qty = $(this).siblings('input[name="qty"]').val();
    qty = parseInt(qty);
    qty++;

    $(this).siblings('input[name="qty"]').val(qty);

});

$('.delete-number-to-qty').click(function() {
    var qty = $(this).siblings('input[name="qty"]').val();
    qty = parseInt(qty);
    if (qty > 0) {
        qty--;
    }

    $(this).siblings('input[name="qty"]').val(qty);

});
</script>
@endsection

@section('modals')
<div class="modal fade" id="itemModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Adicionar ao Carrinho</h4>
            </div>
            <form action="{{route('user.cart.include')}}" method="POST">
                {{csrf_field()}}
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <input type="hidden" name="product_id">
                                <div class="col-qty qty">
                                    <label>Quantidade</label>
                                    <input type="number" name="qty" class="input-qty" value="1" maxlength="6">
                                    <button type="button" class="add-number-to-qty"><i class="fa fa-chevron-up"
                                            aria-hidden="true"></i></button>
                                    <button type="button" class="delete-number-to-qty"><i class="fa fa-chevron-down"
                                            aria-hidden="true"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary" id="confirm">Confirmar</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

@endsection