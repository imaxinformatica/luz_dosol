@extends('user.templates.default')

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
                <button class="btn-header newInvitation">Gerar Convite</button>
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
                        <h3 class="box-title">Rede Nível 1</h3>
                        <div class="box-tools pull-right">
                            <button type="button" data-box="1" class="btn btn-box-tool btn-add-widget btn-open-box">
                                <i class="fa fa-plus" aria-hidden="true"></i>
                            </button>
                        </div>
                    </div>
                    <div class="box-body table-responsive display-none " id="boxId-1">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>E-mail</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php($total1 = 0)
                                @php($active1 = 0)
                                @php($desactive1 = 0)

                                @foreach($users as $user)
                                <tr>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->status()}}</td>
                                </tr>
                                @php($total1++ )
                                @php($active1 += $user->status == 1 ? 1 : 0)
                                @php($desactive1 += $user->status == 0 ? 1 : 0)
                                @endforeach
                            </tbody>

                        </table>
                    </div>
                    <!-- /.box-body -->

                    <div class="box-body">
                        <div class="col-xs-4">
                            <table class="table table-bordered table-striped">
                                <tbody>
                                    <tr>
                                        <td>Total: {{$total1}}</td>
                                    </tr>
                                    <tr>
                                        <td>Ativados: {{$active1}}</td>
                                    </tr>
                                    <tr>
                                        <td>Desativados: {{$desactive1}}</td>
                                    </tr>
                                </tbody>

                            </table>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
            </section>
        </div>
        <!-- /.row (main row) -->

        <div class="row">
            <!-- Left col -->
            <section class="col-lg-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Rede Nível 2</h3>
                        <div class="box-tools pull-right">
                            <button type="button" data-box="2" class="btn btn-box-tool btn-add-widget btn-open-box">
                                <i class="fa fa-plus" aria-hidden="true"></i>
                            </button>
                        </div>
                    </div>
                    <div class="box-body table-responsive display-none " id="boxId-2">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>E-mail</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>

                                @php($total2 = 0)
                                @php($active2 = 0)
                                @php($desactive2 = 0)

                                @foreach($users as $user)
                                @foreach($user->users as $user)

                                <tr>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->status()}}</td>
                                </tr>

                                @php($total2++ )
                                @php($active2 += $user->status == 1 ? 1 : 0)
                                @php($desactive2 += $user->status == 0 ? 1 : 0)
                                @endforeach
                                @endforeach
                            </tbody>

                        </table>
                    </div>

                    <div class="box-body">
                        <div class="col-xs-4">
                            <table class="table table-bordered table-striped">
                                <tbody>
                                    <tr>
                                        <td>Total: {{$total2}}</td>
                                    </tr>
                                    <tr>
                                        <td>Ativados: {{$active2}}</td>
                                    </tr>
                                    <tr>
                                        <td>Desativados: {{$desactive2}}</td>
                                    </tr>
                                </tbody>

                            </table>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <!-- /.box-body -->
                </div>
            </section>
        </div>
        <!-- /.row (main row) -->

        <div class="row">
            <!-- Left col -->
            <section class="col-lg-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Rede Nível 3</h3>
                        <div class="box-tools pull-right">
                            <button type="button" data-box="3" class="btn btn-box-tool btn-add-widget btn-open-box">
                                <i class="fa fa-plus" aria-hidden="true"></i>
                            </button>
                        </div>
                    </div>
                    <div class="box-body table-responsive display-none " id="boxId-3">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>E-mail</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>

                                @php($total3 = 0)
                                @php($active3 = 0)
                                @php($desactive3 = 0)    

                                @foreach($users as $user)
                                @foreach($user->users as $user)
                                @foreach($user->users as $user)
                                <tr>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->status()}}</td>

                                    @php($total3++ )
                                    @php($active3 += $user->status == 1 ? 1 : 0)
                                    @php($desactive3 += $user->status == 0 ? 1 : 0)
                                </tr>
                                @endforeach
                                @endforeach
                                @endforeach
                            </tbody>

                        </table>
                    </div>
                    <!-- /.box-body -->

                    <div class="box-body">
                        <div class="col-xs-4">
                            <table class="table table-bordered table-striped">
                                <tbody>
                                    <tr>
                                        <td>Total: {{$total3}}</td>
                                    </tr>
                                    <tr>
                                        <td>Ativados: {{$active3}}</td>
                                    </tr>
                                    <tr>
                                        <td>Desativados: {{$desactive3}}</td>
                                    </tr>
                                </tbody>

                            </table>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
            </section>
        </div>
        <!-- /.row (main row) -->

        <div class="row">
            <!-- Left col -->
            <section class="col-lg-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Rede Nível 4</h3>
                        <div class="box-tools pull-right">
                            <button type="button" data-box="4" class="btn btn-box-tool btn-add-widget btn-open-box">
                                <i class="fa fa-plus" aria-hidden="true"></i>
                            </button>
                        </div>
                    </div>
                    <div class="box-body table-responsive display-none " id="boxId-4">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>E-mail</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php($total4 = 0)
                                @php($active4 = 0)
                                @php($desactive4 = 0)    

                                @foreach($users as $user)
                                @foreach($user->users as $user)
                                @foreach($user->users as $user)
                                @foreach($user->users as $user)
                                <tr>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->status()}}</td>
                                </tr>

                                @php($total4++ )
                                @php($active4 += $user->status == 1 ? 1 : 0)
                                @php($desactive4 += $user->status == 0 ? 1 : 0)

                                @endforeach
                                @endforeach
                                @endforeach
                                @endforeach
                            </tbody>

                        </table>
                    </div>

                    <div class="box-body">
                        <div class="col-xs-4">
                            <table class="table table-bordered table-striped">
                                <tbody>
                                    <tr>
                                        <td>Total: {{$total4}}</td>
                                    </tr>
                                    <tr>
                                        <td>Ativados: {{$active4}}</td>
                                    </tr>
                                    <tr>
                                        <td>Desativados: {{$desactive4}}</td>
                                    </tr>
                                </tbody>

                            </table>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
            </section>
        </div>
        <!-- /.row (main row) -->

        <div class="row">
            <!-- Left col -->
            <section class="col-lg-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Rede Nível 5</h3>
                        <div class="box-tools pull-right">
                            <button type="button" data-box="5" class="btn btn-box-tool btn-add-widget btn-open-box">
                                <i class="fa fa-plus" aria-hidden="true"></i>
                            </button>
                        </div>
                    </div>
                    <div class="box-body table-responsive display-none " id="boxId-5">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>E-mail</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php($total5 = 0)
                                @php($active5 = 0)
                                @php($desactive5 = 0)    

                                @foreach($users as $user)
                                @foreach($user->users as $user)
                                @foreach($user->users as $user)
                                @foreach($user->users as $user)
                                @foreach($user->users as $user)
                                <tr>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->status()}}</td>
                                </tr>

                                @php($total5++ )
                                @php($active5 += $user->status == 1 ? 1 : 0)
                                @php($desactive5 += $user->status == 0 ? 1 : 0)

                                @endforeach
                                @endforeach
                                @endforeach
                                @endforeach
                                @endforeach
                            </tbody>

                        </table>
                    </div>

                    <div class="box-body">
                        <div class="col-xs-4">
                            <table class="table table-bordered table-striped">
                                <tbody>
                                    <tr>
                                        <td>Total: {{$total5}}</td>
                                    </tr>
                                    <tr>
                                        <td>Ativados: {{$active5}}</td>
                                    </tr>
                                    <tr>
                                        <td>Desativados: {{$desactive5}}</td>
                                    </tr>
                                </tbody>

                            </table>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
            </section>
        </div>
        <!-- /.row (main row) -->

        <div class="row">
            <!-- Left col -->
            <section class="col-lg-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Rede Nível 6</h3>
                        <div class="box-tools pull-right">
                            <button type="button" data-box="6" class="btn btn-box-tool btn-add-widget btn-open-box">
                                <i class="fa fa-plus" aria-hidden="true"></i>
                            </button>
                        </div>
                    </div>
                    <div class="box-body table-responsive display-none " id="boxId-6">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>E-mail</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php($total6 = 0)
                                @php($active6 = 0)
                                @php($desactive6 = 0)

                                @foreach($users as $user)
                                @foreach($user->users as $user)
                                @foreach($user->users as $user)
                                @foreach($user->users as $user)
                                @foreach($user->users as $user)
                                @foreach($user->users as $user)
                                <tr>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->status()}}</td>
                                </tr>

                                @php($total6++ )
                                @php($active6 += $user->status == 1 ? 1 : 0)
                                @php($desactive6 += $user->status == 0 ? 1 : 0)

                                @endforeach
                                @endforeach
                                @endforeach
                                @endforeach
                                @endforeach
                                @endforeach
                            </tbody>

                        </table>
                    </div>
                    <!-- /.box-body -->

                    <div class="box-body">
                        <div class="col-xs-4">
                            <table class="table table-bordered table-striped">
                                <tbody>
                                    <tr>
                                        <td>Total: {{$total6}}</td>
                                    </tr>
                                    <tr>
                                        <td>Ativados: {{$active6}}</td>
                                    </tr>
                                    <tr>
                                        <td>Desativados: {{$desactive6}}</td>
                                    </tr>
                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <!-- /.row (main row) -->

        <div class="row">
            <!-- Left col -->
            <section class="col-lg-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Rede Nível 7</h3>
                        <div class="box-tools pull-right">
                            <button type="button" data-box="7" class="btn btn-box-tool btn-add-widget btn-open-box">
                                <i class="fa fa-plus" aria-hidden="true"></i>
                            </button>
                        </div>
                    </div>

                    <div class="box-body table-responsive display-none " id="boxId-7">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>E-mail</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php($total7 = 0)
                                @php($active7 = 0)
                                @php($desactive7 = 0)

                                @foreach($users as $user)
                                @foreach($user->users as $user)
                                @foreach($user->users as $user)
                                @foreach($user->users as $user)
                                @foreach($user->users as $user)
                                @foreach($user->users as $user)
                                @foreach($user->users as $user)
                                <tr>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->status()}}</td>
                                </tr>

                                @php($total7++ )
                                @php($active7 += $user->status == 1 ? 1 : 0)
                                @php($desactive7 += $user->status == 0 ? 1 : 0)

                                @endforeach
                                @endforeach
                                @endforeach
                                @endforeach
                                @endforeach
                                @endforeach
                                @endforeach
                            </tbody>

                        </table>
                    </div>
                    <div class="box-body">
                        <div class="col-xs-4">
                            <table class="table table-bordered table-striped">
                                <tbody>
                                    <tr>
                                        <td>Total: {{$total7}}</td>
                                    </tr>
                                    <tr>
                                        <td>Ativados: {{$active7}}</td>
                                    </tr>
                                    <tr>
                                        <td>Desativados: {{$desactive7}}</td>
                                    </tr>
                                </tbody>

                            </table>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
            </section>
        </div>
        <!-- /.row (main row) -->

        <div class="row">
            <!-- Left col -->
            <section class="col-lg-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Rede Nível 8</h3>
                        <div class="box-tools pull-right">
                            <button type="button" data-box="8" class="btn btn-box-tool btn-add-widget btn-open-box">
                                <i class="fa fa-plus" aria-hidden="true"></i>
                            </button>
                        </div>
                    </div>
                    <div class="box-body table-responsive display-none " id="boxId-8">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>E-mail</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php($total8 = 0)
                                @php($active8 = 0)
                                @php($desactive8 = 0)

                                @foreach($users as $user)
                                @foreach($user->users as $user)
                                @foreach($user->users as $user)
                                @foreach($user->users as $user)
                                @foreach($user->users as $user)
                                @foreach($user->users as $user)
                                @foreach($user->users as $user)
                                @foreach($user->users as $user)
                                <tr>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->status()}}</td>
                                </tr>

                                @php($total8++ )
                                @php($active8 += $user->status == 1 ? 1 : 0)
                                @php($desactive8 += $user->status == 0 ? 1 : 0)

                                @endforeach
                                @endforeach
                                @endforeach
                                @endforeach
                                @endforeach
                                @endforeach
                                @endforeach
                                @endforeach
                            </tbody>

                        </table>
                    </div>

                    <div class="box-body">
                        <div class="col-xs-4">
                            <table class="table table-bordered table-striped">
                                <tbody>
                                    <tr>
                                        <td>Total: {{$total8}}</td>
                                    </tr>
                                    <tr>
                                        <td>Ativados: {{$active8}}</td>
                                    </tr>
                                    <tr>
                                        <td>Desativados: {{$desactive8}}</td>
                                    </tr>
                                </tbody>

                            </table>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
            </section>
        </div>
        <!-- /.row (main row) -->

        <div class="row">
            <!-- Left col -->
            <section class="col-lg-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Rede Nível 9</h3>
                        <div class="box-tools pull-right">
                            <button type="button" data-box="9" class="btn btn-box-tool btn-add-widget btn-open-box">
                                <i class="fa fa-plus" aria-hidden="true"></i>
                            </button>
                        </div>
                    </div>

                    <div class="box-body table-responsive display-none " id="boxId-9">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>E-mail</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php($total9 = 0)
                                @php($active9 = 0)
                                @php($desactive9 = 0)

                                @foreach($users as $user)
                                @foreach($user->users as $user)
                                @foreach($user->users as $user)
                                @foreach($user->users as $user)
                                @foreach($user->users as $user)
                                @foreach($user->users as $user)
                                @foreach($user->users as $user)
                                @foreach($user->users as $user)
                                @foreach($user->users as $user)
                                <tr>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->status()}}</td>
                                </tr>

                                @php($total9++ )
                                @php($active9 += $user->status == 1 ? 1 : 0)
                                @php($desactive9 += $user->status == 0 ? 1 : 0)

                                @endforeach
                                @endforeach
                                @endforeach
                                @endforeach
                                @endforeach
                                @endforeach
                                @endforeach
                                @endforeach
                                @endforeach

                            </tbody>

                        </table>
                    </div>

                    <div class="box-body">
                        <div class="col-xs-4">
                            <table class="table table-bordered table-striped">
                                <tbody>
                                    <tr>
                                        <td>Total: {{$total9}}</td>
                                    </tr>
                                    <tr>
                                        <td>Ativados: {{$active9}}</td>
                                    </tr>
                                    <tr>
                                        <td>Desativados: {{$desactive9}}</td>
                                    </tr>
                                </tbody>

                            </table>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
            </section>
        </div>
        <!-- /.row (main row) -->

        <div class="row">
            <!-- Left col -->
            <section class="col-lg-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Rede Nível 10</h3>
                        <div class="box-tools pull-right">
                            <button type="button" data-box="10" class="btn btn-box-tool btn-add-widget btn-open-box">
                                <i class="fa fa-plus" aria-hidden="true"></i>
                            </button>
                        </div>
                    </div>
                    <div class="box-body table-responsive display-none " id="boxId-10">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>E-mail</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php($total10 = 0)
                                @php($active10 = 0)
                                @php($desactive10 = 0)

                                @foreach($users as $user)
                                @foreach($user->users as $user)
                                @foreach($user->users as $user)
                                @foreach($user->users as $user)
                                @foreach($user->users as $user)
                                @foreach($user->users as $user)
                                @foreach($user->users as $user)
                                @foreach($user->users as $user)
                                @foreach($user->users as $user)
                                @foreach($user->users as $user)
                                <tr>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->status()}}</td>
                                </tr>

                                @php($total10++ )
                                @php($active10 += $user->status == 1 ? 1 : 0)
                                @php($desactive10 += $user->status == 0 ? 1 : 0)

                                @endforeach
                                @endforeach
                                @endforeach
                                @endforeach
                                @endforeach
                                @endforeach
                                @endforeach
                                @endforeach
                                @endforeach
                                @endforeach
                            </tbody>

                        </table>
                    </div>
                    <div class="box-body">
                        <div class="col-xs-4">
                            <table class="table table-bordered table-striped">
                                <tbody>
                                    <tr>
                                        <td>Total: {{$total10}}</td>
                                    </tr>
                                    <tr>
                                        <td>Ativados: {{$active10}}</td>
                                    </tr>
                                    <tr>
                                        <td>Desativados: {{$desactive10}}</td>
                                    </tr>
                                </tbody>

                            </table>
                        </div>
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
$('.newInvitation').on('click', function() {
    $('#newInvitation').modal('show');
});

$('.btn-open-box').on('click', function() {
    box = $(this).data('box');
    $('#boxId-' + box).slideToggle('slow');
});
</script>
@endsection

@section('modals')
<!--Gerar Convite-->
<div class="modal fade" tabindex="-1" role="dialog" id="newInvitation">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Gerar Convite</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xs-4">
                        <p><b>Gerar Convite:</b></p>
                    </div>
                    <div class="col-xs-8">
                        <div class="input-group">
                            <input type="text" value="{{url('user/cadastro')}}/{{auth()->guard('user')->user()->id}}"
                                class="form-control" readonly>
                            <span class="input-group-addon generate-invitation" onclick="copyClipboard();"
                                id="copyClipboard" data-container="body" data-toggle="popover" data-placement="top"
                                data-content="Link Copiado.">
                                <i class="fa fa-files-o" aria-hidden=""></i>
                            </span>
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <div class="row">
                    <div class="col-sm-12">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Fechar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.Gerar Convite -->

@endsection