@extends('admin.templates.default')

@section('title', 'Início')

@section('description', 'Descrição')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="row">
            <div class="col-sm-6">
                <h1>Início</h1>
            </div>
        </div>
    </section>

    @isset($_GET['alert'])
    <section class="content-header">
        <!-- Main row -->
        <div class="row">
            <!-- Left col -->
            <section class="col-sm-12">
                <div class="alert alert-{{$_GET['type-alert']}} alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    {{$_GET['alert']}}
                </div>
            </section>
        </div>
    </section>
    @endisset

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-lg-4 col-xs-4">
                <!-- small box -->
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3>{{$users->count()}}</h3>

                        <p>Usuários</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                    <a href="{{route('admin.user.index')}}" class="small-box-footer">Mais informações <i
                            class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-4 col-xs-4">
                <!-- small box -->
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3>{{$products->count()}}</h3>

                        <p>Produtos Cadastrados</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                    <a href="{{route('admin.product.index')}}" class="small-box-footer">Mais informações <i
                            class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-4 col-xs-4">
                <!-- small box -->
                <div class="small-box bg-yellow">
                    <div class="inner">
                        <h3>{{$orders->count()}}</h3>

                        <p>Pedidos</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                    <a href="{{route('admin.transaction.index')}}" class="small-box-footer">Mais informações <i
                            class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
        </div>

        <!-- Main row -->
        <div class="row">
            <!-- Left col -->
            <section class="col-lg-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Compras recentes</h3>
                    </div>
                    <div class="box-body">
                        <table id="tabela-com-filtro" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Pedido</th>
                                    <th scope="col">Total</th>
                                    <th scope="col">Usuário</th>
                                    <th scope="col">Ação</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($orders as $transaction)
                                <tr>
                                    <td>#{{str_pad($transaction->id, 5, 0, STR_PAD_LEFT )}}</td>
                                    <td>R${{convertMoneyUSAtoBrazil($transaction->total)}}</td>
                                    <td>{{$transaction->user->name}}</td>
                                    <td>
                                        <a href="{{ route('admin.transaction.show', ['transaction' => $transaction])}}"
                                            title="Editar" class="act-list">
                                            <i class="fa fa-eye" aria-hidden="true"></i>
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7y">Nenhum resultado encontrado</td>
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