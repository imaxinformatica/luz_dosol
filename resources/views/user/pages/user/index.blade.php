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
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-lg-12">
                <div class="box">
                    <div class="box-body table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th scope="col"></th>
                                    <th scope="col">1º Nivel</th>
                                    <th scope="col">2º Nivel</th>
                                    <th scope="col">3º Nivel</th>
                                    <th scope="col">4º Nivel</th>
                                    <th scope="col">5º Nivel</th>
                                    <th scope="col">6º Nivel</th>
                                    <th scope="col">7º Nivel</th>
                                    <th scope="col">8º Nivel</th>
                                    <th scope="col">9º Nivel</th>
                                    <th scope="col">10º Nivel</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><b>Pessoas Totais</b></td>
                                    <td class="total-1">0</td>
                                    <td class="total-2">0</td>
                                    <td class="total-3">0</td>
                                    <td class="total-4">0</td>
                                    <td class="total-5">0</td>
                                    <td class="total-6">0</td>
                                    <td class="total-7">0</td>
                                    <td class="total-8">0</td>
                                    <td class="total-9">0</td>
                                    <td class="total-10">0</td>
                                </tr>
                                <tr>
                                    <td><b>Ativadas</b></td>
                                    @if($user->status == 1)
                                    <td class="active-1">0</td>
                                    <td class="active-2">0</td>
                                    <td class="active-3">0</td>
                                    <td class="active-4">0</td>
                                    <td class="active-5">0</td>
                                    <td class="active-6">0</td>
                                    <td class="active-7">0</td>
                                    <td class="active-8">0</td>
                                    <td class="active-9">0</td>
                                    <td class="active-10">0</td>
                                    @else
                                    <td colspan="10" style="text-align: center;">Disponível após a ATIVAÇÃO</td>
                                    @endif
                                </tr>
                                <tr>
                                    <td><b>Desativadas</b></td>
                                    @if($user->status == 1)
                                    <td class="desactive-1">0</td>
                                    <td class="desactive-2">0</td>
                                    <td class="desactive-3">0</td>
                                    <td class="desactive-4">0</td>
                                    <td class="desactive-5">0</td>
                                    <td class="desactive-6">0</td>
                                    <td class="desactive-7">0</td>
                                    <td class="desactive-8">0</td>
                                    <td class="desactive-9">0</td>
                                    <td class="desactive-10">0</td>
                                    @else
                                    <td colspan="10" style="text-align: center;">Disponível após a ATIVAÇÃO</td>
                                    @endif
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
        <!-- Main row -->
        <div class="row">
            <!-- Left col -->
            <section class="col-lg-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Sua Rede</h3>
                        <div class="box-tools">

                            <p>
                                <b>Totais:</b> <span class="totais"></span>
                                <b>Ativados:</b> <span class="ativados"></span>
                                <b>Desativados:</b> <span class="desativados"></span>
                            </p>
                        </div>
                    </div>
                    <div class="box-body table-responsive">
                        <div class="row">
                            <div class="col-md-12">
                                <div id="box-child-{{ $user->id }}" class="child">
                                    @foreach ($user->children as $child)
                                    <div class="row">
                                        <div class="col-sm-1">
                                            <button type="button"
                                                class="btn btn-box-tool toggleChild status-total-2 status-{{$child->status}} status-{{$child->status}}-2"
                                                data-child="{{ $child->id }}"><i id="icon-{{ $child->id }}"
                                                    class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                        <div class="col-sm-3">
                                            <p><b>Nome:</b> {{ $child->name }}</p>
                                        </div>
                                        <div class="col-sm-3">
                                            <p><b>Graduação:</b>
                                                {{ $user->status == 1 ? $child->graduation_name : 'disponível após ATIVAÇÃO' }}
                                            </p>
                                        </div>
                                        <div class="col-sm-3">
                                            <p><b>Status:</b>
                                                {{ $user->status == 1 ? $child->status() : 'disponível após ATIVAÇÃO' }}
                                            </p>
                                        </div>
                                        <div class="col-sm-2">
                                            <p><b>Nível 1</b></p>
                                        </div>
                                    </div>
                                    @if (count($child->children) > 0)
                                    @component('user.components.user', ['user' => $child, 'count' => 2, 'active' =>
                                    $user->status])
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
        $('.totais').text(document.getElementsByClassName('toggleChild').length);
        $('.ativados').text(document.getElementsByClassName('status-1').length);
        $('.desativados').text(document.getElementsByClassName('status-0').length);
        for(i = 1; i <= 10; i++){
            $(`.total-${i}`).text(document.getElementsByClassName(`status-total-${i+1}`).length);
            let status = `{{$user->status}}`;
            let active = document.getElementsByClassName(`status-1-${i+1}`).length;
            let desactive = document.getElementsByClassName(`status-0-${i+1}`).length;
            if(status == 1){
                $(`.active-${i}`).text(active);
                $(`.desactive-${i}`).text(desactive);
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
                                value="{{ url('user/cadastro') }}/{{ auth()->guard('user')->user()->id }}"
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