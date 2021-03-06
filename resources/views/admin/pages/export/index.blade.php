@extends('admin.templates.default')

@section('title', 'Exportar Pagamentos')

@section('description', 'Descrição')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="row">
            <div class="col-sm-6">
                <h1>Exportar Pagamentos</h1>
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
                        <h3 class="box-title">Exportar Pagamentos a serem realizados</h3>
                    </div>
                    <form method="POST" action="{{route('admin.export.generate')}}" autocomplete="off">
                        {{csrf_field()}}
                        <div class="box-body">
                            <div class="form-group row">

                                <div class="col-xs-6">
                                    <label for="cycle">Selecione o ciclo <small>*</small></label>
                                    <select name="cycle" id="cycle" class="form-control" required>
                                        @foreach($dates as $date)
                                        <option value="{{$date}}" {{end($dates) ? 'selected' : ""}}>{{$date}}</option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>

                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Exportar</button>
                        </div>
                    </form>
                </div>
            </section>
            <section class="col-lg-6">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Exportar dados Transfeera</h3>
                    </div>
                    <form method="POST" action="{{route('admin.export.transfeera')}}" autocomplete="off">
                        {{csrf_field()}}
                        <div class="box-body">
                            <div class="form-group row">

                                <div class="col-xs-6">
                                    <label for="cycle">Selecione o ciclo <small>*</small></label>
                                    <select name="cycle" id="cycle" class="form-control" required>
                                        @foreach($dates as $date)
                                        <option value="{{$date}}" {{end($dates) ? 'selected' : ""}}>{{$date}}</option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>

                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Exportar</button>
                        </div>
                    </form>
                </div>
            </section>
        </div>
    </section>
</div>

@stop