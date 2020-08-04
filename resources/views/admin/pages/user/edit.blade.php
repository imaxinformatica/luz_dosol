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
            <section class="col-lg-10">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Dados</h3>
                    </div>
                    <form method="POST" action="{{route('admin.user.update', ['user' => $user])}}">
                        {{csrf_field()}}
                        <input type="hidden" name="user_id" value="">
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
                                        <label>Status <small>*</small></label>
                                        <select name="status" id="status" class="form-control">
                                            <option selected disabled hidden>Selecione..</option>
                                            <option value="1" {{$user->status == '1' ? "selected" : ""}}>Ativado
                                            </option>
                                            <option value="0" {{$user->status == '0' ? "selected" : ""}}>Desativado
                                            </option>
                                        </select>
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
                                        <input type="text" class="form-control" value="{{$user->rg}}" name="rg"
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
                                        <input type="text" class="form-control input-cep" id="cep"
                                            value="{{$user->address->zip_code}}" name="zip_code" required>
                                    </div>
                                </div>
                                <div class="col-xs-8">
                                    <div class="form-group">
                                        <label for="street">Logradouro <small>*</small></label>
                                        <input type="text" class="form-control" id="street" value="{{$user->address->street}}"
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
                                        <input type="text" class="form-control" id="neighborhood" value="{{$user->address->neighborhood}}"
                                            name="neighborhood" required>
                                    </div>
                                </div>
                                <div class="col-sm-4 col-xs-6">
                                    <div class="form-group">
                                        <label for="city">Cidade<small>*</small></label>
                                        <input type="text" class="form-control" id="city" value="{{$user->address->city}}"
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

                            <div class="row">
                                <div class="col-xs-4">
                                    <div class="form-group">
                                        <label for="bank_code">Código Banco <small>*</small></label>
                                        <select name="bank_code" id="bank_code" class="form-control select2" required>
                                            <option disabled hidden selected>Selecione...</option>
                                            @foreach($banks as $bank)
                                            <option value="{{$bank->bank_code}}"
                                                {{$bank->bank_code == $user->databank->bank_code ? "selected" : ""}}>
                                                {{$bank->bank_code." - ". $bank->bank_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xs-4">
                                    <div class="form-group">
                                        <label for="agency">Agência <small>*</small></label>
                                        <input type="text" class="form-control" value="{{$user->databank->agency}}" name="agency"
                                            required>
                                    </div>
                                </div>

                                <div class="col-xs-4">
                                    <div class="form-group">
                                        <label for="account">Conta (s/ dígito) <small>*</small></label>
                                        <input type="text" class="form-control" value="{{$user->databank->account}}"
                                            name="account" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-2 col-xs-6">
                                    <div class="form-group">
                                        <label for="account_type">Dígito conta <small>*</small></label>
                                        <input type="text" class="form-control" value="{{$user->databank->account_type}}"
                                            name="account_type" required>
                                    </div>
                                </div>
                                <div class="col-sm-4 col-xs-6">
                                    <div class="form-group">
                                        <label for="name_holder">Nome Titular <small>*</small></label>
                                        <input type="text" class="form-control" value="{{$user->databank->name_holder}}"
                                            name="name_holder" required>
                                    </div>
                                </div>
                                <div class="col-sm-3 col-xs-6">
                                    <div class="form-group">
                                        <label for="type_account">Tipo de Conta <small>*</small></label>
                                        <select name="type_account" id="type_account" required class="form-control">
                                            <option disabled hidden selected>Selecione...</option>
                                            <option {{$user->databank->type_account == 1 ? "selected" : "" }} value="1">Conta corrente</option>
                                            <option {{$user->databank->type_account == 2 ? "selected" : "" }} value="2">Conta poupança</option>
                                            <option {{$user->databank->type_account == 3 ? "selected" : "" }} value="3">Conta conjunta</option>
                                            <option {{$user->databank->type_account == 4 ? "selected" : "" }} value="4">Poupança conjunta</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xs-6 col-sm-3">
                                    <div class="form-group">
                                        <label for="cpf_holder">CPF Titular <small>*</small></label>
                                        <input type="text" class="form-control input-cpf" value="{{$user->databank->cpf_holder}}"
                                            name="cpf_holder" required>
                                    </div>
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