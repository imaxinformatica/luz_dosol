@extends('user.templates.default')

@section('title', 'Configurações')

@section('description', 'Descrição')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="row">
            <div class="col-sm-6">
                <h1>Configurações</h1>
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
            <section class="col-lg-10">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Dados</h3>
                    </div>
                    <form method="POST" action="{{route('user.configuration.update')}}">
                        {{csrf_field()}}
                        <div class="box-body">
                            <div class="row">
                                <div class="col-xs-12 col-sm-6">
                                    <div class="form-group">
                                        <label>Nome <small>*</small></label>
                                        <input type="text" class="form-control" value="{{$user->name}}" name="name"
                                            required>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6">
                                    <div class="form-group">
                                        <label>E-mail <small>*</small></label>
                                        <input type="email" class="form-control" value="{{$user->email}}" name="email"
                                            required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xs-6">
                                    <div class="form-group">
                                        <label for="cpf">CPF <small>*</small></label>
                                        <input type="text" class="form-control input-cpf" value="{{$user->cpf}}"
                                            name="cpf" required>
                                    </div>
                                </div>
                                <div class="col-xs-6">
                                    <div class="form-group">
                                        <label for="rg">RG <small>*</small></label>
                                        <input type="text" class="form-control" value="{{$user->rg}}" name="rg" maxlength="15"
                                            required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-6">
                                    <div class="form-group">
                                        <label for="cellphone">Telefone Celular <small>*</small></label>
                                        <input type="text" class="form-control input-phone" value="{{$user->cellphone}}"
                                            name="cellphone" required>
                                    </div>
                                </div>
                                <div class="col-xs-6">
                                    <div class="form-group">
                                        <label for="phone">Telefone</label>
                                        <input type="text" class="form-control input-phone" value="{{$user->phone}}"
                                            name="phone">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-4">
                                    <div class="form-group">
                                        <label for="zip_code">CEP <small>*</small></label>
                                        <input type="text" class="form-control input-cep"
                                            value="{{$user->address->zip_code}}" name="zip_code" required>
                                    </div>
                                </div>
                                <div class="col-xs-8">
                                    <div class="form-group">
                                        <label for="street">Logradouro <small>*</small></label>
                                        <input type="text" class="form-control" value="{{$user->address->street}}"
                                            name="street" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xs-4">
                                    <div class="form-group">
                                        <label for="number">Número <small>*</small></label>
                                        <input type="text" class="form-control" value="{{$user->address->number}}"
                                            name="number" required>
                                    </div>
                                </div>
                                <div class="col-xs-8">
                                    <div class="form-group">
                                        <label for="complement">Complemento</label>
                                        <input type="text" class="form-control" value="{{$user->address->complement}}"
                                            name="complement">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xs-12 col-sm-6">
                                    <div class="form-group">
                                        <label for="neighborhood">Bairro<small>*</small></label>
                                        <input type="text" class="form-control" value="{{$user->address->neighborhood}}"
                                            name="neighborhood" required>
                                    </div>
                                </div>
                                <div class="col-sm-4 col-xs-6">
                                    <div class="form-group">
                                        <label for="city">Cidade<small>*</small></label>
                                        <input type="text" class="form-control" value="{{$user->address->city}}"
                                            name="city" required>
                                    </div>
                                </div>
                                <div class="col-sm-2 col-xs-6">
                                    <div class="form-group">
                                        <label for="state">Estado<small>*</small></label>
                                        <select name="state" id="state" class="form-control" required>
                                            <option selected disabled hidden>Selecione..</option>
                                            @foreach($states as $state)
                                            <option value="{{$state->initials}}"
                                                {{$user->address->state == $state->initials ? "selected" : ""}}>
                                                {{$state->initials}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Editar</button>
                        </div>
                    </form>
                </div>
            </section>
        </div>
    </section>
</div>

@stop