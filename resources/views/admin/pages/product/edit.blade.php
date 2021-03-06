@extends('admin.templates.default')

@section('title', 'Editar Produto')

@section('description', 'Descrição')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="row">
            <div class="col-sm-6">
                <h1>Editar Produto</h1>
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
                    <form method="POST" action="{{route('admin.product.update', ['product' => $product])}}"
                        enctype="multipart/form-data">
                        {{csrf_field()}}
                        <input type="hidden" name="product_id" value="">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <label for="reference">Referência <small>*</small></label>
                                        <input type="text" class="form-control" max="35" value="{{$product->reference}}"
                                            onkeyup="upperCase(this);" id="reference" name="reference" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <label for="name">Nome <small>*</small></label>
                                        <input type="text" class="form-control" value="{{$product->name}}" id="name"
                                            name="name" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <label for="category_id">Categoria <small>*</small></label>
                                        <select name="category_id" id="category_id" class="form-control">
                                            <option disabled selected>Selecione..</option>
                                            @foreach($categories as $category)
                                            <option value="{{$category->id}}"
                                                {{$category->id == $product->category_id ? 'selected' : '' }}>
                                                {{$category->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="row">
                                <div class="col-xs-6">
                                    <div class="form-group">
                                        <label for="height">Altura <small>*</small></label>
                                        <div class="input-group">
                                            <input type="text" name="height" value="{{convertMoneyUSAtoBrazil($product->height)}}"
                                                class="form-control input-money" required>
                                            <span class="input-group-addon">cm</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-6">
                                    <div class="form-group">
                                        <label for="width">Largura <small>*</small></label>
                                        <div class="input-group">
                                            <input type="text" name="width" value="{{convertMoneyUSAtoBrazil($product->width)}}"
                                                class="form-control input-money" required>
                                            <span class="input-group-addon">cm</span>
                                        </div>
                                    </div>
                                </div>
                            </div> -->
                            <div class="row">
                                <div class="col-xs-6">
                                    <div class="form-group">
                                        <label for="volume">Volume <small>*</small></label>
                                        <div class="input-group">
                                            <input type="text" name="volume" value="{{convertMoneyUSAtoBrazil($product->volume)}}"
                                                class="form-control input-money" required>
                                            <span class="input-group-addon">cm³</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-6">
                                    <div class="form-group">
                                        <label for="weight">Peso <small>*</small></label>
                                        <div class="input-group">
                                            <input type="text" name="weight" value="{{convertMoneyUSAtoBrazil($product->weight)}}"
                                                class="form-control input-money" required>
                                            <span class="input-group-addon">kg</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <label for="description">Descrição <small>*</small></label>
                                        <input type="text" class="form-control" value="{{$product->description}}"
                                            id="description" name="description" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xs-6">
                                    <div class="form-group">
                                        <label for="price">Preço <small>*</small></label>
                                        <div class="input-group">
                                            <span class="input-group-addon">R$</span>
                                            <input type="text" name="price"
                                                value="{{convertMoneyUSAtoBrazil($product->price)}}"
                                                class="form-control input-money" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-6">
                                    <div class="form-group">
                                        <label for="status">Status <small>*</small></label>
                                        <select name="status" id="status" class="form-control" required>
                                            <option selected disabled hidden>Selecione..</option>
                                            <option value="1" {{$product->status == '1' ? "selected" : ""}}>Ativado
                                            </option>
                                            <option value="0" {{$product->status == '0' ? "selected" : ""}}>Desativado
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <label for="file">Imagem <small>*</small></label>
                                        <p><small>São aceitos os formatos JPEG, JPG, PNG, BMP</small></p>
                                        <input type="file" name="file" id="file">
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Editar</button>
                            <button type="button" class="btn btn-secondary"
                                onclick="window.location.href='{{route('admin.product.index')}}'">Voltar</button>
                        </div>
                    </form>
                </div>
            </section>
        </div>
    </section>
</div>

@stop