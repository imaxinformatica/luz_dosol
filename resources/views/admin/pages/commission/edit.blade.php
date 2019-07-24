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
                    <form method="POST" action="#" autocomplete="off">
                        {{csrf_field()}}
                        <div class="box-body">

                            <div class="form-group row">
                                <div class="col-xs-2">
                                    <label>Comissão 1 <small>*</small></label>
                                    <div class="input-group">
                                        <input type="text" name="commission" class="form-control input-money" required>
                                        <span class="input-group-addon">%</span>
                                    </div>
                                </div>
                                <div class="col-xs-2">
                                    <label>Comissão 2 <small>*</small></label>
                                    <div class="input-group">
                                        <input type="text" name="commission" class="form-control input-money" required>
                                        <span class="input-group-addon">%</span>
                                    </div>
                                </div>
                                <div class="col-xs-2">
                                    <label>Comissão 3 <small>*</small></label>
                                    <div class="input-group">
                                        <input type="text" name="commission" class="form-control input-money" required>
                                        <span class="input-group-addon">%</span>
                                    </div>
                                </div>
                                <div class="col-xs-2">
                                    <label>Comissão 4 <small>*</small></label>
                                    <div class="input-group">
                                        <input type="text" name="commission" class="form-control input-money" required>
                                        <span class="input-group-addon">%</span>
                                    </div>
                                </div>
                                <div class="col-xs-2">
                                    <label>Comissão 5 <small>*</small></label>
                                    <div class="input-group">
                                        <input type="text" name="commission" class="form-control input-money" required>
                                        <span class="input-group-addon">%</span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-xs-2">
                                    <label>Comissão 6 <small>*</small></label>
                                    <div class="input-group">
                                        <input type="text" name="commission" class="form-control input-money" required>
                                        <span class="input-group-addon">%</span>
                                    </div>
                                </div>
                                <div class="col-xs-2">
                                    <label>Comissão 7 <small>*</small></label>
                                    <div class="input-group">
                                        <input type="text" name="commission" class="form-control input-money" required>
                                        <span class="input-group-addon">%</span>
                                    </div>
                                </div>
                                <div class="col-xs-2">
                                    <label>Comissão 8 <small>*</small></label>
                                    <div class="input-group">
                                        <input type="text" name="commission" class="form-control input-money" required>
                                        <span class="input-group-addon">%</span>
                                    </div>
                                </div>
                                <div class="col-xs-2">
                                    <label>Comissão 9 <small>*</small></label>
                                    <div class="input-group">
                                        <input type="text" name="commission" class="form-control input-money" required>
                                        <span class="input-group-addon">%</span>
                                    </div>
                                </div>
                                <div class="col-xs-2">
                                    <label>Comissão 10 <small>*</small></label>
                                    <div class="input-group">
                                        <input type="text" name="commission" class="form-control input-money" required>
                                        <span class="input-group-addon">%</span>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="box-footer">
                            <button type="button" class="btn btn-primary">Editar</button>
                        </div>
                    </form>
                </div>
            </section>
        </div>
    </section>
</div>

@stop