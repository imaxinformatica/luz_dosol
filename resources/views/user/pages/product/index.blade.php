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
            <section class="col-lg-12">
                <div class="box">
                    <form id="filterForm" method="GET" autocomplete="off">
                        <div class="box-header">
                            <h3 class="box-title">Filtrar resultados</h3>
                            <div class="box-tools">
                                <?php

                                $paginate = $products;

                                $link_limit = 7;

                                $filters = '&name=' . request('name');
                                $filters .= '&reference=' . request('reference');
                                $filters .= '&category_id=' . request('category_id');
                                ?>

                                @if($paginate->lastPage() > 1)
                                <ul class="pagination pagination-sm no-margin pull-right">
                                    <li class="{{ ($paginate->currentPage() == 1) ? ' disabled' : '' }}">
                                        <a href="{{ $paginate->url(1) . $filters}}">«</a>
                                    </li>
                                    @for($i = 1; $i <= $paginate->lastPage(); $i++)
                                        <?php
                                        $half_total_links = floor($link_limit / 2);
                                        $from = $paginate->currentPage() - $half_total_links;
                                        $to = $paginate->currentPage() + $half_total_links;
                                        if ($paginate->currentPage() < $half_total_links) {
                                            $to += $half_total_links - $paginate->currentPage();
                                        }
                                        if ($paginate->lastPage() - $paginate->currentPage() < $half_total_links) {
                                            $from -= $half_total_links - ($paginate->lastPage() - $paginate->currentPage()) - 1;
                                        }
                                        ?>
                                        @if ($from < $i && $i < $to) <li
                                            class="{{ ($paginate->currentPage() == $i) ? ' active' : '' }}">
                                            <a href="{{ $paginate->url($i) . $filters}}">{{ $i }}</a>
                                            </li>
                                            @endif
                                            @endfor
                                            <li
                                                class="{{ ($paginate->currentPage() == $paginate->lastPage()) ? ' disabled' : '' }}">
                                                <a href="{{ $paginate->url($paginate->lastPage()) . $filters}}">»</a>
                                            </li>
                                </ul>
                                @endif
                            </div>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-sm-4">
                                    <label>Referência</label>
                                    <input type="text" class="form-control" value="{{request('reference')}}"
                                        name="reference">
                                </div>
                                <div class="col-sm-4">
                                    <label>Nome</label>
                                    <input type="text" class="form-control" value="{{request('name')}}" name="name">
                                </div>
                                <div class="col-sm-4">
                                    <label for="category_id">Categoria</label>
                                    <select name="category_id" id="category_id" class="form-control">
                                        <option disabled selected>Selecione..</option>
                                        @foreach($categories as $category)
                                        <option value="{{$category->id}}"
                                            {{$category->id == request('category_id') ? 'selected': ''}}>
                                            {{$category->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Filtrar</button>
                            <button type="button" class="btn btn-default clear-filters">Limpar</button>
                        </div>
                    </form>
                </div>
            </section>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="row">
                    <?php
                        $numOfCols = 4;
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
                                            <button class="more-info" data-id="{{$product->id}}"><i class="fa fa-info"
                                                    aria-hidden="true"></i></button>
                                            <button class="add-cart" data-product_id="{{$product->id}}">ADD AO
                                                CARRINHO</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="box-description display-none" id="box-description-{{$product->id}}">
                                    <span class="close-box" data-id="{{$product->id}}"><i class="fa fa-times-circle"
                                            aria-hidden="true"></i></span>
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
        </div>
        <div class="row">
            <section class="col-lg-12">
                <form id="filterForm" method="GET" autocomplete="off">
                    <div class="box-tools">
                        <?php

                                $paginate = $products;

                                $link_limit = 7;

                                $filters = '&name=' . request('name');
                                $filters .= '&reference=' . request('reference');
                                $filters .= '&category_id=' . request('category_id');
                                ?>

                        @if($paginate->lastPage() > 1)
                        <ul class="pagination pagination-sm no-margin pull-right">
                            <li class="{{ ($paginate->currentPage() == 1) ? ' disabled' : '' }}">
                                <a href="{{ $paginate->url(1) . $filters}}">«</a>
                            </li>
                            @for($i = 1; $i <= $paginate->lastPage(); $i++)
                                <?php
                                        $half_total_links = floor($link_limit / 2);
                                        $from = $paginate->currentPage() - $half_total_links;
                                        $to = $paginate->currentPage() + $half_total_links;
                                        if ($paginate->currentPage() < $half_total_links) {
                                            $to += $half_total_links - $paginate->currentPage();
                                        }
                                        if ($paginate->lastPage() - $paginate->currentPage() < $half_total_links) {
                                            $from -= $half_total_links - ($paginate->lastPage() - $paginate->currentPage()) - 1;
                                        }
                                        ?>
                                @if ($from < $i && $i < $to) <li
                                    class="{{ ($paginate->currentPage() == $i) ? ' active' : '' }}">
                                    <a href="{{ $paginate->url($i) . $filters}}">{{ $i }}</a>
                                    </li>
                                    @endif
                                    @endfor
                                    <li
                                        class="{{ ($paginate->currentPage() == $paginate->lastPage()) ? ' disabled' : '' }}">
                                        <a href="{{ $paginate->url($paginate->lastPage()) . $filters}}">»</a>
                                    </li>
                        </ul>
                        @endif
                    </div>
                </form>
            </section>
        </div>
    </section>
    <!-- /.content -->
</div>

@stop
@section('scripts')
<script type="text/javascript">
$('.more-info').on('click', function() {
    let id = $(this).data('id');
    $('#box-description-' + id).removeClass('display-none');
});

$('.close-box').on('click', function() {
    let id = $(this).data('id');
    $('#box-description-' + id).addClass('display-none');
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
    <div class="modal-dialog modal-sm">
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