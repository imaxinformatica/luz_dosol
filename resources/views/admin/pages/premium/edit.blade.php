@extends('admin.templates.default')

@section('title', 'Editar Prêmio')

@section('description', 'Descrição')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="row">
            <div class="col-sm-6">
                <h1>Editar Prêmio</h1>
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
                    <form method="POST" action="{{route('admin.premium.update')}}" enctype="multipart/form-data">
                        {{csrf_field()}}
                        <input type="hidden" name="premium_id" value="{{$premium->id}}">

                        <div class="box-body">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <label for="name">Nome <small>*</small></label>
                                        <input type="text" class="form-control" value="{{$premium->name}}" id="name"
                                            name="name" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="form-group">
                                        <label for="graduation">Graduação <small>*</small></label>
                                        <select name="graduation" class="form-control" id="graduation">
                                            <option disabled selected>Selecione..</option>
                                            <option value="platinum" {{$premium->graduation == 'platinum' ? "selected" : ""}}>Platina</option>
                                            <option value="diamond" {{$premium->graduation == 'diamond' ? "selected" : ""}}>Diamente</option>
                                            <option value="master" {{$premium->graduation == 'master' ? "selected" : ""}}>Mestre</option>
                                            <option value="emperor" {{$premium->graduation == 'emperor' ? "selected" : ""}}>Imperador/Imperatriz</option>
                                            <option value="prince" {{$premium->graduation == 'prince' ? "selected" : ""}}>Príncipe/Princesa</option>
                                            <option value="king" {{$premium->graduation == 'king' ? "selected" : ""}}>Rei/Rainha</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="form-group">

                                        <input type="file" name="file" id="file">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Editar</button>
                            <button type="button" class="btn btn-secondary"
                                onclick="window.location.href='{{route('admin.premium.index')}}'">Voltar</button>
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