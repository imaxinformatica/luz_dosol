@extends('admin.templates.default')

@section('title', 'Comissões')

@section('description', 'Descrição')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="row">
            <div class="col-sm-6">
                <h1>Comissões</h1>
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
                        <h3 class="box-title">Comissões</h3>
                    </div>
                    <form method="POST" action="{{route('admin.commission.update')}}" autocomplete="off">
                        {{csrf_field()}}
                        <div class="box-body">

                            <div class="form-group row">
                                <div class="col-xs-2">
                                    <label for="commission_1">Comissão 1 <small>*</small></label>
                                    <div class="input-group">
                                        <input type="text" name="commission_1" value="{{convertMoneyUSAtoBrazil($commission->commission_1)}}" class="form-control input-money" required>
                                        <span class="input-group-addon">%</span>
                                    </div>
                                </div>
                                <div class="col-xs-2">
                                    <label for="commission_2">Comissão 2 <small>*</small></label>
                                    <div class="input-group">
                                        <input type="text" name="commission_2" value="{{convertMoneyUSAtoBrazil($commission->commission_2)}}" class="form-control input-money" required>
                                        <span class="input-group-addon">%</span>
                                    </div>
                                </div>
                                <div class="col-xs-2">
                                    <label for="commission_3">Comissão 3 <small>*</small></label>
                                    <div class="input-group">
                                        <input type="text" name="commission_3" value="{{convertMoneyUSAtoBrazil($commission->commission_3)}}" class="form-control input-money" required>
                                        <span class="input-group-addon">%</span>
                                    </div>
                                </div>
                                <div class="col-xs-2">
                                    <label for="commission_4">Comissão 4 <small>*</small></label>
                                    <div class="input-group">
                                        <input type="text" name="commission_4" value="{{convertMoneyUSAtoBrazil($commission->commission_4)}}" class="form-control input-money" required>
                                        <span class="input-group-addon">%</span>
                                    </div>
                                </div>
                                <div class="col-xs-2">
                                    <label for="commission_5">Comissão 5 <small>*</small></label>
                                    <div class="input-group">
                                        <input type="text" name="commission_5" value="{{convertMoneyUSAtoBrazil($commission->commission_5)}}" class="form-control input-money" required>
                                        <span class="input-group-addon">%</span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-xs-2">
                                    <label for="commission_6">Comissão 6 <small>*</small></label>
                                    <div class="input-group">
                                        <input type="text" name="commission_6" value="{{convertMoneyUSAtoBrazil($commission->commission_6)}}" class="form-control input-money" required>
                                        <span class="input-group-addon">%</span>
                                    </div>
                                </div>
                                <div class="col-xs-2">
                                    <label for="commission_7">Comissão 7 <small>*</small></label>
                                    <div class="input-group">
                                        <input type="text" name="commission_7" value="{{convertMoneyUSAtoBrazil($commission->commission_7)}}" class="form-control input-money" required>
                                        <span class="input-group-addon">%</span>
                                    </div>
                                </div>
                                <div class="col-xs-2">
                                    <label for="commission_8">Comissão 8 <small>*</small></label>
                                    <div class="input-group">
                                        <input type="text" name="commission_8" value="{{convertMoneyUSAtoBrazil($commission->commission_8)}}" class="form-control input-money" required>
                                        <span class="input-group-addon">%</span>
                                    </div>
                                </div>
                                <div class="col-xs-2">
                                    <label for="commission_9">Comissão 9 <small>*</small></label>
                                    <div class="input-group">
                                        <input type="text" name="commission_9" value="{{convertMoneyUSAtoBrazil($commission->commission_9)}}" class="form-control input-money" required>
                                        <span class="input-group-addon">%</span>
                                    </div>
                                </div>
                                <div class="col-xs-2">
                                    <label for="commission_10">Comissão 10 <small>*</small></label>
                                    <div class="input-group">
                                        <input type="text" name="commission_10" value="{{convertMoneyUSAtoBrazil($commission->commission_10)}}" class="form-control input-money" required>
                                        <span class="input-group-addon">%</span>
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