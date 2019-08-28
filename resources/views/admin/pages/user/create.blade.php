@extends('admin.templates.default')

@section('title', 'Novo Usuário')

@section('description', 'Descrição')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="row">
            <div class="col-sm-6">
                <h1>Novo Usuário</h1>
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
                    <form method="POST" action="{{route('admin.user.store')}}">
                        {{csrf_field()}}
                        <div class="box-body">
                            <div class="row">
                                <div class="col-xs-12 col-sm-6">
                                    <div class="form-group">
                                        <label>Nome <small>*</small></label>
                                        <input type="text" class="form-control" value="{{old('name')}}" name="name"
                                            required>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6">
                                    <div class="form-group">
                                        <label>E-mail <small>*</small></label>
                                        <input type="email" class="form-control" value="{{old('email')}}" name="email"
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
                                            <option value="1" {{old('status') == '1' ? "selected" : ""}}>Ativado
                                            </option>
                                            <option value="0" {{old('status') == '0' ? "selected" : ""}}>Desativado
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xs-6">
                                    <div class="form-group">
                                        <label>Senha <small>*</small></label>
                                        <input type="password" class="form-control" name="password" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-6">
                                    <div class="form-group">
                                        <label for="cpf">CPF <small>*</small></label>
                                        <input type="text" class="form-control input-cpf" value="{{old('cpf')}}"
                                            name="cpf" required>
                                    </div>
                                </div>
                                <div class="col-xs-6">
                                    <div class="form-group">
                                        <label for="rg">RG <small>*</small></label>
                                        <input type="text" class="form-control" value="{{old('rg')}}" name="rg"
                                            required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-6">
                                    <div class="form-group">
                                        <label for="cellphone">Telefone Celular <small>*</small></label>
                                        <input type="text" class="form-control input-phone" value="{{old('cellphone')}}"
                                            name="cellphone" required>
                                    </div>
                                </div>
                                <div class="col-xs-6">
                                    <div class="form-group">
                                        <label for="phone">Telefone</label>
                                        <input type="text" class="form-control input-phone" value="{{old('phone')}}"
                                            name="phone">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-4">
                                    <div class="form-group">
                                        <label for="zip_code">CEP <small>*</small></label>
                                        <input type="text" class="form-control input-cep" value="{{old('zip_code')}}"
                                            name="zip_code" required>
                                    </div>
                                </div>
                                <div class="col-xs-8">
                                    <div class="form-group">
                                        <label for="street">Logradouro <small>*</small></label>
                                        <input type="text" class="form-control" value="{{old('street')}}" name="street"
                                            required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xs-4">
                                    <div class="form-group">
                                        <label for="number">Número <small>*</small></label>
                                        <input type="text" class="form-control" value="{{old('number')}}" name="number"
                                            required>
                                    </div>
                                </div>
                                <div class="col-xs-8">
                                    <div class="form-group">
                                        <label for="complement">Complemento</label>
                                        <input type="text" class="form-control" value="{{old('complement')}}"
                                            name="complement">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xs-12 col-sm-6">
                                    <div class="form-group">
                                        <label for="neighborhood">Bairro<small>*</small></label>
                                        <input type="text" class="form-control" value="{{old('neighborhood')}}"
                                            name="neighborhood" required>
                                    </div>
                                </div>
                                <div class="col-sm-4 col-xs-6">
                                    <div class="form-group">
                                        <label for="city">Cidade<small>*</small></label>
                                        <input type="text" class="form-control" value="{{old('city')}}" name="city"
                                            required>
                                    </div>
                                </div>
                                <div class="col-sm-2 col-xs-6">
                                    <div class="form-group">
                                        <label for="state">Estado<small>*</small></label>
                                        <select name="state" id="state" class="form-control" required>
                                            <option selected disabled hidden>Selecione..</option>
                                            @foreach($states as $state)
                                            <option value="{{$state->initials}}">{{$state->initials}}</option>
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
                                                {{$bank->bank_code == old('bank_code') ? "selected" : ""}}>
                                                {{$bank->bank_code." - ". $bank->bank_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xs-4">
                                    <div class="form-group">
                                        <label for="agency">Agência <small>*</small></label>
                                        <input type="text" class="form-control" value="{{old('agency')}}" name="agency"
                                            required>
                                    </div>
                                </div>

                                <div class="col-xs-4">
                                    <div class="form-group">
                                        <label for="account">Conta (s/ dígito) <small>*</small></label>
                                        <input type="text" class="form-control" value="{{old('account')}}"
                                            name="account" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xs-2">
                                    <div class="form-group">
                                        <label for="account_type">Dígito conta <small>*</small></label>
                                        <input type="text" class="form-control" value="{{old('account_type')}}"
                                            name="account_type" required>
                                    </div>
                                </div>
                                <div class="col-xs-5">
                                    <div class="form-group">
                                        <label for="name_holder">Nome Titular <small>*</small></label>
                                        <input type="text" class="form-control" value="{{old('name_holder')}}"
                                            name="name_holder" required>
                                    </div>
                                </div>
                                <div class="col-xs-5">
                                    <div class="form-group">
                                        <label for="cpf_holder">CPF Titular <small>*</small></label>
                                        <input type="text" class="form-control input-cpf" value="{{old('cpf_holder')}}"
                                            name="cpf_holder" required>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Criar</button>
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