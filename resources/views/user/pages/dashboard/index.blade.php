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
                        <option value="{{$date}}" {{end($dates) ? 'selected' : ""}} >{{$date}}</option>
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
                                <img class="graduation-img" src="{{ asset('images/'.$user->getGraduation())}}">
                                <p class="text-center">Graduação<br>máxima alcançada</p>
                            </div>
                            <div class="col-md-6">
                                <img class="graduation-img" src="{{ asset('images/'.$user->getGraduation())}}">
                                <p class="text-center">Graduação<br>do mês atual</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if($user->status == 1)
            <div class="col-lg-7">
                <div class="row">
                    <div class="col-xs-12 col-sm-6">
                        <!-- small box -->
                        <div class="small-box bg-green">
                            <div class="inner">
                                <p>Bônus de consumo</p>
                                <h3 class="bonus"></h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6">
                        <!-- small box -->
                        <div class="small-box bg-yellow">
                            <div class="inner">
                                <p>Comissões da rede</p>
                                <h3 class="commission"></h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <!-- small box -->
                        <div class="small-box bg-aqua">
                            <div class="inner">
                                <p>Bônus total</p>
                                <h3 class="total"></h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @else
            <div class="col-lg-4">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Ativação pendente</h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="inner">
                                    <p>Ative-se agora mesmo, realize a sua primeira compra deste ciclo, para poder
                                        verificar seu saldo.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
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
$('document').ready(function(){
    getCycle();
});
$('#cycle').on('change', function(){
    getCycle();
});

function getCycle(){
    let cycle = $('#cycle').val();
    let array_cycle = cycle.split("/");
    $.ajax({
        type: 'GET',
        url: "{{route('get-bonus')}}",
        data: {
            month: array_cycle[0],
            year: array_cycle[1]
        },
        beforeSend: function() {
            $('.bonus').html('Buscando...');
            $('.commission').html('Buscando...');
            $('.total').html('Buscando...');
        },
        success: function(data) {
            $('.bonus').html('R$ ');
            $('.bonus').append(data['bonus']);
            $('.commission').html('R$ ');
            $('.commission').append(data['commission']);
            $('.total').html('R$ ');
            $('.total').append(data['total']);
        }
    });
}
</script>
@endsection