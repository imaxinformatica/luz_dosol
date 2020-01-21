@extends('admin.templates.default')

@section('title', 'Novo Produto')

@section('description', 'Descrição')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="row">
            <div class="col-sm-6">
                <h1>Novo Produto</h1>
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
                    <form method="POST" action="{{route('admin.product.store')}}" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <div class="box-body">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <label for="reference">Referência <small>*</small></label>
                                        <input type="text" class="form-control" value="{{old('reference')}}"
                                            id="reference" name="reference" onkeyup="upperCase(this);" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <label for="name">Nome <small>*</small></label>
                                        <input type="text" class="form-control" value="{{old('name')}}" id="name"
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
                                                {{$category->id == old('category_id') ? 'selected' : '' }}>
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
                                            <input type="text" name="height" value="{{old('height')}}" class="form-control input-money"
                                                required>
                                            <span class="input-group-addon">cm</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-6">
                                    <div class="form-group">
                                        <label for="width">Largura <small>*</small></label>
                                        <div class="input-group">
                                            <input type="text" name="width" value="{{old('width')}}" class="form-control input-money"
                                                required>
                                            <span class="input-group-addon">cm</span>
                                        </div>
                                    </div>
                                </div> -->
                            <!-- </div> -->
                            <div class="row">
                                <div class="col-xs-6">
                                    <div class="form-group">
                                        <label for="volume">Volume <small>*</small></label>
                                        <div class="input-group">
                                            <input type="text" name="volume" value="{{old('volume')}}" class="form-control input-money"
                                                required>
                                            <span class="input-group-addon">cm³</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-6">
                                    <div class="form-group">
                                        <label for="weight">Peso <small>*</small></label>
                                        <div class="input-group">
                                            <input type="text" name="weight" value="{{old('weight')}}" class="form-control input-money"
                                                required>
                                            <span class="input-group-addon">kg</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <label for="description">Breve Descrição <small>*</small></label>
                                        <input type="text" class="form-control" value="{{old('description')}}"
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
                                            <input type="text" name="price" value="{{old('price')}}" class="form-control input-money"
                                                required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-6">
                                    <div class="form-group">
                                        <label for="status">Status <small>*</small></label>
                                        <select name="status" id="status" class="form-control" required>
                                            <option selected disabled hidden>Selecione..</option>
                                            <option value="1" {{old('status') == '1' ? "selected" : ""}}>Ativado
                                            </option>
                                            <option value="0" {{old('status') == '0' ? "selected" : ""}}>Desativado
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
                                        <input type="file" name="file" id="file" required>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Criar</button>
                            <button type="button" class="btn btn-secondary"
                                onclick="window.location.href='{{route('admin.category.index')}}'">Voltar</button>
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
$('#reference').on('keyup', function() {
    let letter = $(this).val();

});
</script>
@endsection