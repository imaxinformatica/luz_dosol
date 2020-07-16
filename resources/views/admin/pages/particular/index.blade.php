@extends('admin.templates.default')

@section('title', 'Fretes Particulares')

@section('description', 'Descrição')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="row">
            <div class="col-sm-6">
                <h1>Fretes Particulares</h1>
            </div>
            <div class="col-sm-6">
                <button class="btn-header"
                    onclick="window.location.href='{{route('admin.particular.create')}}'">Novo</button>
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
        <!-- Main row -->
        <div class="row">
            <!-- Left col -->
            <section class="col-lg-8">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Lista de Fretes Particulares</h3>
                        <div class="box-tools">
                            <?php

                                $paginate = $particulares;

                                $link_limit = 7;

                                $filters = '&zip_code='.request('zip_code');
                                $filters .= '&city='.request('city');
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
                    <div class="box-body table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>CEP Inicial</th>
                                    <th>CEP Final</th>
                                    <th>Valor</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($particulares as $particular)
                                <tr>
                                    <td>{{$particular->cep_initial}}</td>
                                    <td>{{$particular->cep_final}}</td>
                                    <td>{{convertMoneyUsaToBrazil($particular->price)}}</td>
                                    <td>

                                        <a href="{{ route('admin.particular.edit', ['particular' => $particular])}}"
                                            title="Editar" class="act-list">
                                            <i class="fa fa-pencil-square" aria-hidden="true"></i>
                                        </a>
                                        <a href="{{ route('admin.particular.delete', ['particular' => $particular])}}"
                                            title="Excluir" class="act-list act-delete">
                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6">Nenhum dado cadastrado</td>
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