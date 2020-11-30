@extends('admin.templates.default')

@section('title', 'Usuários - Rede '. $user->name)

@section('description', 'Descrição')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="row">
                <div class="col-sm-6">
                    <h1>Rede {{$user->name}}</h1>
                </div>
            </div>
        </section>
        <!-- Main content -->
        <section class="content">

            <!-- Main row -->
            <div class="row">
                <!-- Left col -->
                <section class="col-lg-12">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Rede</h3>
                        </div>
                        <div class="box-body table-responsive">
                            <div class="row">
                                <div class="col-md-12">
                                    <div id="box-child-{{ $user->id }}" class="child">
                                        @foreach ($user->children as $child)
                                            <div class="row">
                                                <div class="col-sm-1">
                                                    <button type="button" class="btn btn-box-tool toggleChild"
                                                        data-child="{{ $child->id }}"><i id="icon-{{ $child->id }}"
                                                            class="fa fa-plus"></i>
                                                    </button>
                                                </div>
                                                <div class="col-sm-3">
                                                    <p><b>Nome:</b> {{ $child->name }}</p>
                                                </div>
                                                <div class="col-sm-3">
                                                    <p><b>Graduação:</b>
                                                        {{$child->graduation_name }}
                                                    </p>
                                                </div>
                                                <div class="col-sm-3">
                                                    <p><b>Status:</b>
                                                        {{ $child->status()}}
                                                    </p>
                                                </div>
                                                <div class="col-sm-2">
                                                    <p><b>Nível 1</b></p>
                                                </div>
                                            </div>
                                            @if (count($child->children) > 0)
                                                @component('user.components.user', ['user' => $child, 'count' => 2, 'active' => 1])
                                                @endcomponent
                                            @endif
                                        @endforeach
                                    </div>
                                </div>

                            </div>
                            <!-- /.box-body -->
                        </div>
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

        $('.btn-open-box').on('click', function() {
            box = $(this).data('box');
            $('#boxId-' + box).slideToggle('slow');
        });
        $('.toggleChild').on('click', function(e) {
            let idChild = $(this).data('child');
            $(`#box-child-${idChild}`).toggleClass('display-none');
            toggleIcon($(`#icon-${idChild}`).first());
        });

        function toggleIcon(element) {
            if (element.hasClass('fa-plus')) {
                element.removeClass('fa-plus');
                element.addClass('fa-minus');
            } else {
                element.removeClass('fa-minus');
                element.addClass('fa-plus');
            }
        }

    </script>
@endsection

@section('modals')
    <!--Gerar Convite-->
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
                                <input type="text"
                                    value="{{ url('user/cadastro') }}/{{ $user->id }}"
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
                            <button type="button" class="btn btn-primary" data-dismiss="modal">Fechar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.Gerar Convite -->

@endsection
