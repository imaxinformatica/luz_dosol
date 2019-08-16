@extends('admin.templates.default')

@section('title', 'Novo Banner')

@section('description', 'Descrição')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="row">
            <div class="col-sm-6">
                <h1>Novo Banner</h1>
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
                    <form id="dataOrder" method="POST" action="{{ route('admin.banner.store')}}"
                        enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="box-body">
                        <div class="form-group row">
                                <div class="col-xs-12">
                                    <label for="status">Status <small>*</small> </label>
                                    <select class="form-control" name="status" id="status" required>
                                        <option value="" disabled hidden selected>Selecione..</option>
                                        <option value="0" @if(old('status')=='0' ) selected @endif>Desativado</option>
                                        <option value="1" @if(old('status')=='1' ) selected @endif>Ativado</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-xs-12">
                                    <label for="description">Descrição curta <small>*</small> </label>
                                    <input type="text" name="description" class="form-control" id="description"
                                        value="{{old('description')}}" required>
                                </div>
                            </div>
                            <div class="form-group row link">
                                <div class="col-xs-12">
                                    <label for="link">Link</label>
                                    <input type="text" name="link" class="form-control" id="link"
                                        value="{{old('link')}}">
                                </div>
                            </div>
                            <div class="form-group row target">
                                <div class="col-xs-12">
                                    <label for="target">Abertura</label>
                                    <select class="form-control" name="target" id="target">
                                        <option value="" disabled hidden selected>Selecione..</option>
                                        <option value="0" @if(old('target')=='0' ) selected @endif>Mesma aba</option>
                                        <option value="1" @if(old('target')=='1' ) selected @endif>Nova aba</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-xs-12">
                                    <label for="file">Imagem <small>*</small></label>
                                    <p><small>São aceitos os formatos JPEG, JPG, PNG, BMP</small></p>
                                    <input type="file" name="file" id="file" required>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Adicionar</button>
                        </div>
                    </form>
                </div>
            </section>
        </div>
    </section>
</div>

@stop