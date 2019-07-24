@extends('admin.templates.default')

@section('title', 'Usuários')

@section('description', 'Descrição')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="row">
            <div class="col-sm-6">
                <h1>Usuários</h1>
            </div>
            <div class="col-sm-6">
                <button class="btn-header" onclick="window.location.href='{{route('admin.banner.create')}}'">Novo</button>
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
                        <h3 class="box-title">Lista de banners</h3>
                    </div>
                    <div class="box-body table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Arquivo</th>
                                    <th>Local</th>
                                    <th>Descrição</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($banners as $banner)
                                <tr>
                                    <td>
                                        @if($banner->type == '1')
                                        <img src="{{ asset('uploads/banners/thumbnail')}}/{{$banner->file}}"
                                            class="banner-image">
                                        @else
                                        <video controls src="{{ asset('uploads/banners/original')}}/{{$banner->file}}"
                                            class="banner-image"></video>
                                        @endif
                                    </td>
                                    <td>
                                        @switch($banner->location)
                                        @case(0)
                                        Banner principal
                                        @break

                                        @case(1)
                                        Banner 1
                                        @break

                                        @case(2)
                                        Banner 2
                                        @break

                                        @case(3)
                                        Banner 3
                                        @break

                                        @case(4)
                                        Banner 4
                                        @break

                                        @default
                                        Não definido
                                        @endswitch
                                    </td>
                                    <td>{{$banner->description}}</td>
                                    <td>
                                        @if($banner->status == 0)
                                        <a href="{{ route('admin.banner.change.status', ['id' => $banner->id])}}"
                                            title="Ativar" class="btn-act-list btn-banner-inactive">
                                            Ativar
                                        </a>
                                        @else
                                        <a href="{{ route('admin.banner.change.status', ['id' => $banner->id])}}"
                                            title="Desativar" class="btn-act-list btn-banner-active">
                                            Desativar
                                        </a>
                                        @endif
                                        <a href="{{ route('admin.banner.edit', ['id' => $banner->id])}}" title="Editar"
                                            class="act-list act-edit">
                                            <i class="fa fa-pencil-square" aria-hidden="true"></i>
                                        </a>
                                        <a href="{{ route('admin.banner.delete', ['id' => $banner->id])}}"
                                            title="Excluir" class="act-list act-delete">
                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4">Nenhum banner cadastrado até o momento</td>
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