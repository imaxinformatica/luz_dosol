@extends('user.templates.default')

@section('title', 'Meus pedido')

@section('description', 'Descrição')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="row">
            <div class="col-sm-6">
                <h1>Meus pedido</h1>
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
                    </div>
                    <div class="box-body table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Pedido</th>
                                    <th scope="col">Total produtos</th>
                                    <th scope="col">Frete</th>
                                    <th scope="col">Total</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Ação</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($orders as $order)
                                <tr>
                                    <td>#{{str_pad($order->id, 5, 0, STR_PAD_LEFT )}}</td>
                                    <td>R${{convertMoneyUSAtoBrazil($order->subtotal)}}</td>
                                    <td>R${{convertMoneyUSAtoBrazil($order->shipping)}}</td>
                                    <td>R${{convertMoneyUSAtoBrazil($order->total)}}</td>
                                    <td>{{$order->status}}</td>
                                    <td>
                                        <a href="{{ route('user.order.show', ['order' => $order])}}" title="Editar"
                                            class="act-list">
                                            <i class="fa fa-eye" aria-hidden="true"></i>
                                        </a>
                                        @if($order->payment_method == 'boleto')
                                        <a href="{{$order->payment_link}}" target="_blank"  title="Visualizar Boleto"
                                            class="act-list">
                                            <i class="fa fa-link" aria-hidden="true"></i>
                                        </a>
                                        @endif
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