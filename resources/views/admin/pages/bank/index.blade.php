@extends('admin.templates.default')

@section('title', 'Bancos')

@section('description', 'Descrição')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="row">
            <div class="col-sm-6">
                <h1>Bancos</h1>
            </div>
            <div class="col-sm-6">
                <button class="btn-header addBank">Novo</button>
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
                        <h3 class="box-title">Lista de Bancos</h3>
                    </div>
                    <div class="box-body table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Nome do Banco</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($banks as $bank)
                                <tr>
                                    <td>{{$bank->bank_code}}</td>
                                    <td>{{$bank->bank_name}}</td>
                                    <td>
                                        <a href="#" title="Editar" class="act-list act-edit editBank"
                                            data-bank_code="{{$bank->bank_code}}" data-bank_name="{{$bank->bank_name}}">
                                            <i class="fa fa-pencil-square" aria-hidden="true"></i>
                                        </a>
                                        <a href="{{route('admin.bank.delete', ['bank' => $bank])}}" title="Excluir" class="act-list act-delete">
                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6">Ainda nenhum Banco foi cadastrado</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
            </section>
        </div>
        <!-- /.row (main row) -->
    </section>
    <!-- /.content -->
</div>

@stop

@section('scripts')
<script type="text/javascript">
$('.addBank').on('click', function(e) {
    e.preventDefault();
    $('#addBank').modal('show');
});
$('.editBank').on('click', function(e) {
    e.preventDefault();
    let bank_code = $(this).data('bank_code');
    let bank_name = $(this).data('bank_name');
    $('#editBank form input[name="bank_code"]').val(bank_code);
    $('#editBank form input[name="bank_name"]').val(bank_name);
    $('#editBank').modal('show');
});
</script>
@endsection

@section('modals')
<div class="modal fade" id="addBank">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Adicionar Banco</h4>
            </div>
            <form method="post" action="{{route('admin.bank.store')}}">
                {{csrf_field()}}
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="bank_code">Código do Banco</label>
                                <input type="text" name="bank_code" id="bank_code" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="form-group">
                                <label for="bank_name">Nome do Banco</label>
                                <input type="text" name="bank_name" id="bank_name" class="form-control" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Confirmar</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="editBank">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Editar Banco</h4>
            </div>
            <form method="post" action="{{route('admin.bank.update')}}">
                {{csrf_field()}}
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="bank_code">Código do Banco</label>
                                <input type="text" name="bank_code" id="bank_code" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="form-group">
                                <label for="bank_name">Nome do Banco</label>
                                <input type="text" name="bank_name" id="bank_name" class="form-control" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Confirmar</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
@endsection