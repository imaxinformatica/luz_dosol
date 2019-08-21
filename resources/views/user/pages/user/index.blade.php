@extends('user.templates.default')

@section('title', 'Usuários')

@section('description', 'Descrição')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="row">
            <div class="col-sm-6">
                <h1>Usuários</h1>
            </div>
            <div class="col-sm-6">
                <button class="btn-header newInvitation">Gerar Convite</button>
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
    @if(session()->has('warning'))
    <section class="content-header">
        <!-- Main row -->
        <div class="row">
            <!-- Left col -->
            <section class="col-sm-12">
                <div class="alert alert-warning alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    {{session('warning')}}
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
            <section class="col-lg-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Rede Nível 1</h3>
                        <div class="box-tools pull-right">
                            <button type="button" data-box="1" class="btn btn-box-tool btn-add-widget btn-open-box">
                                <i class="fa fa-plus" aria-hidden="true"></i>
                            </button>
                        </div>
                    </div>
                    <div class="box-body table-responsive display-none " id="boxId-1">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>E-mail</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                            
                                    @foreach($users as $user)
                                <tr>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->status()}}</td>
                                </tr>
                                    @endforeach
                            </tbody>

                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
            </section>
        </div>
        <!-- /.row (main row) -->

        <div class="row">
            <!-- Left col -->
            <section class="col-lg-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Rede Nível 2</h3>
                        <div class="box-tools pull-right">
                            <button type="button" data-box="2" class="btn btn-box-tool btn-add-widget btn-open-box">
                                <i class="fa fa-plus" aria-hidden="true"></i>
                            </button>
                        </div>
                    </div>
                    <div class="box-body table-responsive display-none " id="boxId-2">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>E-mail</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                            
                                    @foreach($users as $user)
                                    @foreach($user->users as $user)

                                <tr>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->status()}}</td>
                                </tr>
                                    @endforeach
                                    @endforeach
                            </tbody>

                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
            </section>
        </div>
        <!-- /.row (main row) -->

        <div class="row">
            <!-- Left col -->
            <section class="col-lg-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Rede Nível 3</h3>
                        <div class="box-tools pull-right">
                            <button type="button" data-box="3" class="btn btn-box-tool btn-add-widget btn-open-box">
                                <i class="fa fa-plus" aria-hidden="true"></i>
                            </button>
                        </div>
                    </div>
                    <div class="box-body table-responsive display-none " id="boxId-3">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>E-mail</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                            
                                    @foreach($users as $user)
                                    @foreach($user->users as $user)
                                    @foreach($user->users as $user)
                                <tr>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->status()}}</td>
                                </tr>
                                    @endforeach
                                    @endforeach
                                    @endforeach
                            </tbody>

                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
            </section>
        </div>
        <!-- /.row (main row) -->

        <div class="row">
            <!-- Left col -->
            <section class="col-lg-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Rede Nível 4</h3>
                        <div class="box-tools pull-right">
                            <button type="button" data-box="4" class="btn btn-box-tool btn-add-widget btn-open-box">
                                <i class="fa fa-plus" aria-hidden="true"></i>
                            </button>
                        </div>
                    </div>
                    <div class="box-body table-responsive display-none " id="boxId-4">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>E-mail</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                            
                                    @foreach($users as $user)
                                    @foreach($user->users as $user)
                                    @foreach($user->users as $user)
                                    @foreach($user->users as $user)
                                <tr>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->status()}}</td>
                                </tr>
                                    @endforeach
                                    @endforeach
                                    @endforeach
                                    @endforeach
                            </tbody>

                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
            </section>
        </div>
        <!-- /.row (main row) -->

        <div class="row">
            <!-- Left col -->
            <section class="col-lg-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Rede Nível 5</h3>
                        <div class="box-tools pull-right">
                            <button type="button" data-box="5" class="btn btn-box-tool btn-add-widget btn-open-box">
                                <i class="fa fa-plus" aria-hidden="true"></i>
                            </button>
                        </div>
                    </div>
                    <div class="box-body table-responsive display-none " id="boxId-5">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>E-mail</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                            
                                    @foreach($users as $user)
                                    @foreach($user->users as $user)
                                    @foreach($user->users as $user)
                                    @foreach($user->users as $user)
                                    @foreach($user->users as $user)
                                <tr>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->status()}}</td>
                                </tr>
                                    @endforeach
                                    @endforeach
                                    @endforeach
                                    @endforeach
                                    @endforeach
                            </tbody>

                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
            </section>
        </div>
        <!-- /.row (main row) -->

        <div class="row">
            <!-- Left col -->
            <section class="col-lg-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Rede Nível 6</h3>
                        <div class="box-tools pull-right">
                            <button type="button" data-box="6" class="btn btn-box-tool btn-add-widget btn-open-box">
                                <i class="fa fa-plus" aria-hidden="true"></i>
                            </button>
                        </div>
                    </div>
                    <div class="box-body table-responsive display-none " id="boxId-6">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>E-mail</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                            
                                    @foreach($users as $user)
                                    @foreach($user->users as $user)
                                    @foreach($user->users as $user)
                                    @foreach($user->users as $user)
                                    @foreach($user->users as $user)
                                    @foreach($user->users as $user)
                                <tr>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->status()}}</td>
                                </tr>
                                    @endforeach
                                    @endforeach
                                    @endforeach
                                    @endforeach
                                    @endforeach
                                    @endforeach
                            </tbody>

                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
            </section>
        </div>
        <!-- /.row (main row) -->

        <div class="row">
            <!-- Left col -->
            <section class="col-lg-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Rede Nível 7</h3>
                        <div class="box-tools pull-right">
                            <button type="button" data-box="7" class="btn btn-box-tool btn-add-widget btn-open-box">
                                <i class="fa fa-plus" aria-hidden="true"></i>
                            </button>
                        </div>
                    </div>
                    <div class="box-body table-responsive display-none " id="boxId-7">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>E-mail</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                            
                                    @foreach($users as $user)
                                    @foreach($user->users as $user)
                                    @foreach($user->users as $user)
                                    @foreach($user->users as $user)
                                    @foreach($user->users as $user)
                                    @foreach($user->users as $user)
                                    @foreach($user->users as $user)
                                <tr>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->status()}}</td>
                                </tr>
                                    @endforeach
                                    @endforeach
                                    @endforeach
                                    @endforeach
                                    @endforeach
                                    @endforeach
                                    @endforeach
                            </tbody>

                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
            </section>
        </div>
        <!-- /.row (main row) -->

        <div class="row">
            <!-- Left col -->
            <section class="col-lg-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Rede Nível 8</h3>
                        <div class="box-tools pull-right">
                            <button type="button" data-box="8" class="btn btn-box-tool btn-add-widget btn-open-box">
                                <i class="fa fa-plus" aria-hidden="true"></i>
                            </button>
                        </div>
                    </div>
                    <div class="box-body table-responsive display-none " id="boxId-8">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>E-mail</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                            
                                    @foreach($users as $user)
                                    @foreach($user->users as $user)
                                    @foreach($user->users as $user)
                                    @foreach($user->users as $user)
                                    @foreach($user->users as $user)
                                    @foreach($user->users as $user)
                                    @foreach($user->users as $user)
                                    @foreach($user->users as $user)
                                <tr>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->status()}}</td>
                                </tr>
                                    @endforeach
                                    @endforeach
                                    @endforeach
                                    @endforeach
                                    @endforeach
                                    @endforeach
                                    @endforeach
                                    @endforeach
                            </tbody>

                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
            </section>
        </div>
        <!-- /.row (main row) -->

        <div class="row">
            <!-- Left col -->
            <section class="col-lg-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Rede Nível 9</h3>
                        <div class="box-tools pull-right">
                            <button type="button" data-box="9" class="btn btn-box-tool btn-add-widget btn-open-box">
                                <i class="fa fa-plus" aria-hidden="true"></i>
                            </button>
                        </div>
                    </div>
                    <div class="box-body table-responsive display-none " id="boxId-9">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>E-mail</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                            
                                    @foreach($users as $user)
                                    @foreach($user->users as $user)
                                    @foreach($user->users as $user)
                                    @foreach($user->users as $user)
                                    @foreach($user->users as $user)
                                    @foreach($user->users as $user)
                                    @foreach($user->users as $user)
                                    @foreach($user->users as $user)
                                    @foreach($user->users as $user)
                                <tr>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->status()}}</td>
                                </tr>
                                    @endforeach
                                    @endforeach
                                    @endforeach
                                    @endforeach
                                    @endforeach
                                    @endforeach
                                    @endforeach
                                    @endforeach
                                    @endforeach
                            </tbody>

                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
            </section>
        </div>
        <!-- /.row (main row) -->

        <div class="row">
            <!-- Left col -->
            <section class="col-lg-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Rede Nível 10</h3>
                        <div class="box-tools pull-right">
                            <button type="button" data-box="10" class="btn btn-box-tool btn-add-widget btn-open-box">
                                <i class="fa fa-plus" aria-hidden="true"></i>
                            </button>
                        </div>
                    </div>
                    <div class="box-body table-responsive display-none " id="boxId-10">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>E-mail</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                            
                                    @foreach($users as $user)
                                    @foreach($user->users as $user)
                                    @foreach($user->users as $user)
                                    @foreach($user->users as $user)
                                    @foreach($user->users as $user)
                                    @foreach($user->users as $user)
                                    @foreach($user->users as $user)
                                    @foreach($user->users as $user)
                                    @foreach($user->users as $user)
                                    @foreach($user->users as $user)
                                <tr>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->status()}}</td>
                                </tr>
                                    @endforeach
                                    @endforeach
                                    @endforeach
                                    @endforeach
                                    @endforeach
                                    @endforeach
                                    @endforeach
                                    @endforeach
                                    @endforeach
                                    @endforeach
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
$('.newInvitation').on('click', function() {
    $('#newInvitation').modal('show');
});

$('.btn-open-box').on('click', function(){
    box = $(this).data('box');
    $('#boxId-'+box).slideToggle('slow');
});
</script>
@endsection

@section('modals')
<!--Inclur idioma-->
<div class="modal fade" tabindex="-1" role="dialog" id="newInvitation">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Gerar Convite</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xs-4">
                        <p><b>Gerar Convite:</b></p>
                    </div>
                    <div class="col-xs-8">
                        <div class="input-group">
                            <input type="text" value="{{url('user/cadastro')}}/{{auth()->guard('user')->user()->id}}"
                                class="form-control" readonly>
                            <span class="input-group-addon generate-invitation" onclick="copyClipboard();"
                                id="copyClipboard" data-container="body" data-toggle="popover" data-placement="top"
                                data-content="Link Copiado.">
                                <i class="fa fa-files-o" aria-hidden=""></i>
                            </span>
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <div class="row">
                    <div class="col-sm-12">
                        <button type="submit" class="btn btn-primary" data-dismiss="modal">Fechar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.Incluir Idioma -->

@endsection