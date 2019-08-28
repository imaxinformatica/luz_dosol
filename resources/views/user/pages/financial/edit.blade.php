@extends('user.templates.default')

@section('title', 'Dados financeiros')

@section('description', 'Descrição')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="row">
            <div class="col-sm-6">
                <h1>Dados financeiros</h1>
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
                        <h3 class="box-title">Dados bancários</h3>
                    </div>
                    <form method="POST" action="{{route('user.financial.update')}}">
                        {{csrf_field()}}
                        <input type="hidden" name="databank_id" value="{{$dataBank->id}}">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-xs-4">
                                    <div class="form-group">
                                        <label for="bank_code">Código Banco <small>*</small></label>
                                        <select name="bank_code" id="bank_code" class="form-control select2" required>
                                            <option disabled hidden selected>Selecione...</option>
                                            @foreach($banks as $bank)
                                            <option value="{{$bank->bank_code}}"
                                                {{$bank->bank_code == $dataBank->bank_code ? "selected" : ""}}>
                                                {{$bank->bank_code." - ". $bank->bank_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xs-4">
                                    <div class="form-group">
                                        <label for="agency">Agência <small>*</small></label>
                                        <input type="text" class="form-control" value="{{$dataBank->agency}}"
                                            name="agency" required>
                                    </div>
                                </div>

                                <div class="col-xs-4">
                                    <div class="form-group">
                                        <label for="account">Conta (s/ dígito) <small>*</small></label>
                                        <input type="text" class="form-control" value="{{$dataBank->account}}"
                                            name="account" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xs-2">
                                    <div class="form-group">
                                        <label for="account_type">Dígito conta <small>*</small></label>
                                        <input type="text" class="form-control" value="{{$dataBank->account_type}}"
                                            name="account_type" required>
                                    </div>
                                </div>
                                <div class="col-xs-5">
                                    <div class="form-group">
                                        <label for="name_holder">Nome Titular <small>*</small></label>
                                        <input type="text" class="form-control" value="{{$dataBank->name_holder}}"
                                            name="name_holder" required>
                                    </div>
                                </div>
                                <div class="col-xs-5">
                                    <div class="form-group">
                                        <label for="cpf_holder">CPF Titular <small>*</small></label>
                                        <input type="text" class="form-control input-cpf"
                                            value="{{$dataBank->cpf_holder}}" name="cpf_holder" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Atualizar</button>
                        </div>
                    </form>
                </div>
            </section>
        </div>
    </section>
</div>

@stop
@section('scripts')
<script type="text/javascript">

</script>
@endsection