@extends('admin.templates.default')

@section('title', 'Editar Usuário')

@section('description', 'Descrição')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="row">
            <div class="col-sm-6">
                <h1>Editar Usuário</h1>
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
            <section class="col-lg-6">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Dados</h3>
                    </div>
                    <form method="POST" action="{{route('admin.user.update', ['user' => $user])}}">
                        {{csrf_field()}}
                        <input type="hidden" name="user_id" value="">
                        <div class="box-body">
                            <div class="form-group row">
                                <div class="col-xs-12">
                                    <label>Nome <small>*</small></label>
                                    <input type="text" class="form-control" value="{{$user->name}}" name="name"
                                        required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-xs-12">
                                    <label>E-mail <small>*</small></label>
                                    <input type="email" class="form-control" value="{{$user->email}}" name="email"
                                        required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-xs-6">
                                    <label>CPF <small>*</small></label>
                                    <input type="text" class="form-control input-cpf" value="{{$user->cpf}}" name="cpf"
                                        required>
                                </div>
                                <div class="col-xs-6">
                                    <label>Status <small>*</small></label>
                                    <select name="status" id="status" class="form-control">
                                        <option selected disabled hidden>Selecione..</option>
                                        <option value="1" {{$user->status == '1' ? "selected" : ""}}>Ativado</option>
                                        <option value="0" {{$user->status == '0' ? "selected" : ""}}>Desativado</option>
                                    </select>
                                </div>
                            </div>

                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Editar</button>
                            <button type="button" class="btn btn-secondary"
                                onclick="window.location.href='{{route('admin.user.index')}}'">Voltar</button>
                        </div>
                    </form>
                </div>
            </section>
        </div>
    </section>
</div>

@stop