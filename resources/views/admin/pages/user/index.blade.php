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
                                <div class="col-sm-6">
                                    <label>Nome</label>
                                    <input type="text" class="form-control" value="{{request('name')}}" name="name">
                                </div>
                                <div class="col-sm-6">
                                    <label>E-mail</label>
                                    <input type="text" class="form-control" value="{{request('email')}}" name="email">
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
                        <div class="box-tools">
                            <?php

                            $paginate = $users;

                            $link_limit = 7;

                            $filters = '&name='.request('name');
                            $filters .= '&email='.request('email');

                            ?>
                            @if($paginate->lastPage() > 1)
                            <ul class="pagination pagination-sm no-margin pull-right">
                                <li class="{{ ($paginate->currentPage() == 1) ? ' disabled' : '' }}">
                                    <a href="{{ $paginate->url(1) . $filters}}">«</a>
                                </li>
                                @for($i = 1; $i <= $paginate->lastPage(); $i++)
                                    <?php
                          $half_total_links = floor($link_limit / 2);
                          $from = $paginate->currentPage() - $half_total_links;
                          $to = $paginate->currentPage() + $half_total_links;
                          if ($paginate->currentPage() < $half_total_links) {
                             $to += $half_total_links - $paginate->currentPage();
                          }
                          if ($paginate->lastPage() - $paginate->currentPage() < $half_total_links) {
                              $from -= $half_total_links - ($paginate->lastPage() - $paginate->currentPage()) - 1;
                          }
                          ?>
                                    @if ($from < $i && $i < $to) <li
                                        class="{{ ($paginate->currentPage() == $i) ? ' active' : '' }}">
                                        <a href="{{ $paginate->url($i) . $filters}}">{{ $i }}</a>
                                        </li>
                                        @endif
                                        @endfor
                                        <li
                                            class="{{ ($paginate->currentPage() == $paginate->lastPage()) ? ' disabled' : '' }}">
                                            <a href="{{ $paginate->url($paginate->lastPage()) . $filters}}">»</a>
                                        </li>
                            </ul>
                            @endif
                        </div>
                    </div>
                    <div class="box-body table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Código</th>
                                    <th>Nome</th>
                                    <th>E-mail</th>
                                    <th>Status</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($users as $user)
                                <tr>
                                    <td>{{str_pad($user->id, 5, 0, STR_PAD_LEFT )}}</td>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->status()}}</td>
                                    <td>

                                        <a href="{{ route('admin.user.status', ['user' => $user])}}" title="Editar"
                                            class="act-list">
                                            @if($user->status == 0)
                                            <i class="fa fa-toggle-off" aria-hidden="true"></i>
                                            @else
                                            <i class="fa fa-toggle-on" aria-hidden="true"></i>
                                            @endif
                                        </a>
                                        <a href="#" data-user_id="{{$user->id}}" title="Alterar Senha"
                                            class="act-list change-password">
                                            <i class="fa fa-lock" aria-hidden="true"></i>
                                        </a>
                                        <!-- <a href="#" data-user_id="{{$user->id}}" title="Vincular Usuário a Rede"
                                            class="act-list attach-user">
                                            <i class="fa fa-users" aria-hidden="true"></i>
                                        </a> -->
                                        <a href="{{ route('admin.user.edit', ['user' => $user])}}" title="Editar"
                                            class="act-list">
                                            <i class="fa fa-pencil-square" aria-hidden="true"></i>
                                        </a>

                                        <a href="{{ route('admin.user.delete', ['user' => $user])}}" title="Excluir"
                                            class="act-list act-delete">
                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6">Ainda nenhum pedido foi realizado</td>
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