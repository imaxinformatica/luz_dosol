@extends('admin.templates.default')

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
                <button class="btn-header" onclick="window.location.href='{{route('admin.user.create')}}'">Novo</button>
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
        <div class="row">
            <section class="col-lg-12">
                <div class="box">
                    <form id="filterForm" method="GET" autocomplete="off">
                        <div class="box-header">
                            <h3 class="box-title">Filtrar resultados</h3>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-sm-2">
                                    <div class="form-group">

                                        <label>Código</label>
                                        <input type="text" class="form-control" value="{{request('id')}}" name="id">
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">

                                        <label>Nome</label>
                                        <input type="text" class="form-control" value="{{request('name')}}" name="name">
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">

                                        <label>E-mail</label>
                                        <input type="text" class="form-control" value="{{request('email')}}" name="email">
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">

                                        <label>Ano Inicial</label>
                                        <select name="year_init" id="year_init" class="form-control">
                                            <option selected disabled>Selecione..</option>
                                        @for($i= 0; $i < 15; $i ++)
                                        <option  {{($i+2019) == request('year_init') ? "selected" : ""}} value="{{$i+2019}}">{{$i+2019}}</option>
                                        @endfor
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">

                                        <label>Ano Final</label>
                                        <select name="year_final" id="year_final" class="form-control">
                                            <option selected disabled>Selecione..</option>
                                        @for($i= 0; $i < 15; $i ++)    
                                        <option {{($i+2019) == request('year_final') ? "selected" : ""}} value="{{$i+2019}}">{{$i+2019}}</option>
                                        @endfor
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Filtrar</button>
                            <button type="button" class="btn btn-default clear-filters">Limpar</button>
                        </div>
                    </form>
            </section>
        </div>

        <!-- Main row -->
        <div class="row">
            <!-- Left col -->
            <section class="col-lg-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Lista de usuários</h3>
                    </div>
                    <div class="box-body table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Código</th>
                                    <th>Nome</th>
                                    <th>E-mail</th>
                                    <th>Platina</th>
                                    <th>Diamante</th>
                                    <th>Mestre</th>
                                    <th>Imperador/Imperatriz</th>
                                    <th>Principe/Princesa</th>
                                    <th>Rei/Rainha</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($users as $user)
                                <tr>
                                    <td>{{str_pad($user->id, 5, 0, STR_PAD_LEFT )}}</td>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->getTotalPlatinumGraduation(request('year_init'), request('year_final'))}}</td>
                                    <td>{{$user->getTotalDiamondGraduation(request('year_init'), request('year_final'))}}</td>
                                    <td>{{$user->getTotalMasterGraduation(request('year_init'), request('year_final'))}}</td>
                                    <td>{{$user->getTotalEmperorGraduation(request('year_init'), request('year_final'))}}</td>
                                    <td>{{$user->getTotalPrinceGraduation(request('year_init'), request('year_final'))}}</td>
                                    <td>{{$user->getTotalKingGraduation(request('year_init'), request('year_final'))}}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6">Ainda nenhum usuário com estas graduações</td>
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
$('.change-password').on('click', function() {
    let user_id = $(this).data('user_id');
    $('#changePassword form input[name="user_id"]').val(user_id);
    $('#changePassword').modal('show');
});

$('.attach-user').on('click', function() {
    let user_id = $(this).data('user_id');
    $('#attachUser form input[name="user_id"]').val(user_id);
    $('#attachUser').modal('show');
});
</script>
@endsection

@section('modals')

<!--Alterar Senha-->
<div class="modal fade" id="changePassword">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Alterar Senha</h4>
            </div>
            <form action="{{ route('admin.user.password')}}" method="post">
                {{csrf_field()}}
                <input type="hidden" name="user_id" value="">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="password">Senha</label>
                                <input type="password" name="password" class="form-control" id="password">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="password_confirmation">Confirmação de Senha</label>
                                <input type="password" name="password_confirmation" class="form-control"
                                    id="password_confirmation">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary" id="confirm">Confirmar</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!--/.Alterar Senha-->

<!--Vincular Usuário a rede-->
<div class="modal fade" id="attachUser">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Vincular Usuário</h4>
            </div>
            <form action="{{ route('admin.user.attach')}}" method="post">
                {{csrf_field()}}
                <input type="hidden" name="user_id" value="">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="email">E-mail</label>
                                <input type="email" name="email" class="form-control" id="email">
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary" id="confirm">Confirmar</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!--/.Vincular Usuário a rede-->

@endsection