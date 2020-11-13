@extends('user.templates.default')

@section('title', 'Início')

@section('description', 'Descrição')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="row">
            <div class="col-sm-6">
                <h1>Início</h1>
            </div>
            <div class="col-sm-6">
                <div class="cycle-select">
                    <p>Ciclo do painel:</p>
                    <select name="cycle" id="cycle" required>
                        @foreach($dates as $date)
                        <option value="{{$date}}" {{end($dates) ? 'selected' : ""}}>{{$date}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-lg-5">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Graduações</h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-6">
                                <img class="graduation-img" src="{{ asset('images/'.$user->getMaxGraduation())}}.png">
                                <p class="text-center">Graduação<br>máxima alcançada</p>
                            </div>
                            <div class="col-md-6">
                                <img class="graduation-img" src="{{ asset('images/'.$user->getGraduation())}}.png">
                                <p class="text-center">Graduação<br>do mês atual</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bonus">
                <!-- Conteudo carregado via ajax -->
            </div>

        </div>
        @if(count($premiums))
        <div class="row">
            <!-- Left col -->
            <section class="col-lg-8">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Lista de Prêmios</h3>
                    </div>
                    <div class="box-body table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Imagem</th>
                                    <th>Nome</th>
                                    <th>Graduação</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($premiums as $premium)
                                <tr>

                                    <td>
                                        <img src="{{asset('uploads/premium/thumbnail/'.$premium->file)}}" alt="Prêmio">
                                    </td>
                                    <td>{{$premium->name}}</td>
                                    <td>{{$premium->getGraduation()}}</td>
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
        @endif
        @if(count($banners))
        <!-- Main row -->
        <div class="row">
            <!-- Left col -->
            <section class="col-lg-12">
                <div id="slider" class="carousel slide" data-ride="carousel">
                    <!-- Wrapper for slides -->
                    <div class="carousel-inner">
                        @foreach($banners as $key => $banner)
                        <div class="item @if($key === 0) active @endif">
                            @if($banner->target !== null)
                            <img src="{{ asset('uploads/banner/original/'.$banner->file)}}"
                                alt="{{$banner->description}}" class="banner-dashboard cursor" @if($banner->target == 0)
                            onclick="window.location.href='{{$banner->link}}'" @else
                            onclick="window.open('{{$banner->link}}', '_blank');" @endif>
                            @else
                            <img src="{{ asset('uploads/banner/original/'.$banner->file)}}"
                                alt="{{$banner->description}}" class="banner-dashboard">
                            @endif
                        </div>
                        @endforeach
                    </div>

                    <!-- Left and right controls -->
                    <a class="left carousel-control" href="#slider" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="right carousel-control" href="#slider" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right"></span>
                        <span class="sr-only">Next</span>
                    </a>
            </section>
        </div>
        <!-- /.row (main row) -->
        @endif
    </section>
    <!-- /.content -->
</div>

@stop

@section('scripts')
<script type="text/javascript">
$('document').ready(function() {
    getCycle();
});
$('#cycle').on('change', function() {
    getCycle();
});

function getCycle() {
    let cycle = $('#cycle').val();
    let array_cycle = cycle.split("/");
    $.ajax({
        type: 'GET',
        url: "{{route('get-bonus')}}",
        data: {
            month: array_cycle[0],
            year: array_cycle[1]
        },
        beforeSend: function() {},
        success: function(data) {
            $('.bonus').html(data);
        }
    });
}
</script>
@endsection