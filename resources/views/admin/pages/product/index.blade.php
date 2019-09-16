@extends('admin.templates.default')

@section('title', 'Produtos')

@section('description', 'Descrição')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="row">
            <div class="col-sm-6">
                <h1>Produtos</h1>
            </div>
            <div class="col-sm-6">
                <button class="btn-header"
                    onclick="window.location.href='{{route('admin.product.create')}}'">Novo</button>
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

        <!-- Main row -->
        <div class="row">
            <!-- Left col -->
            <section class="col-lg-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Lista de produtos</h3>
                    </div>
                    <div class="box-body table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Imagem</th>
                                    <th>Referênca</th>
                                    <th>Nome</th>
                                    <th>Preço</th>
                                    <th>Status</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($products as $product)
                                <tr>
                                    <td>
                                        <img src="{{ asset('uploads/products/thumbnail')}}/{{$product->file}}"
                                            class="product-image">
                                    </td>
                                    <td>{{$product->reference}}</td>
                                    <td>{{$product->name}}</td>
                                    <td>R$ {{convertMoneyUSAtoBrazil($product->price)}}</td>
                                    <td>{{$product->status()}}</td>
                                    <td>

                                        <a href="{{ route('admin.product.status', ['product' => $product])}}"
                                            title="Editar" class="act-list">
                                            @if($product->status == 0)
                                            <i class="fa fa-toggle-off" aria-hidden="true"></i>
                                            @else
                                            <i class="fa fa-toggle-on" aria-hidden="true"></i>
                                            @endif
                                        </a>
                                        <a href="{{ route('admin.product.edit', ['product' => $product])}}"
                                            title="Editar" class="act-list">
                                            <i class="fa fa-pencil-square" aria-hidden="true"></i>
                                        </a>
                                        <a href="{{ route('admin.product.delete', ['product' => $product])}}"
                                            title="Excluir" class="act-list act-delete">
                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6">Ainda nenhum pedido foi realizado</td>
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