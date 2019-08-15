@extends('admin.templates.default')

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
                    <select>
                        <option>Maio de 2019</option>
                        <option>Abril de 2019</option>
                        <option>Março de 2019</option>
                        <option>Fevereiro de 2019</option>
                        <option>Janeiro de 2019</option>
                        <option>Dezembro de 2018</option>
                        <option>Novembro de 2018</option>
                        <option>Outubro de 2018</option>
                        <option>Setembro de 2018</option>
                        <option>Agosto de 2018</option>
                        <option>Julho de 2018</option>
                        <option>Junho de 2018</option>
                    </select>
                </div>
            </div>
        </div>
    </section>

    @isset($_GET['alert'])
    <section class="content-header">
        <!-- Main row -->
        <div class="row">
            <!-- Left col -->
            <section class="col-sm-12">
                <div class="alert alert-{{$_GET['type-alert']}} alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    {{$_GET['alert']}}
                </div>
            </section>
        </div>
    </section>
    @endisset

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
                                <img class="graduation-img" src="{{ asset('dist/img/ouro.png')}}">
                                <p class="text-center">Graduação<br>máxima alcançada</p>
                            </div>
                            <div class="col-md-6">
                                <img class="graduation-img" src="{{ asset('dist/img/bronze.png')}}">
                                <p class="text-center">Graduação<br>do mês atual</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="row">
                    <div class="col-xs-12 col-sm-6">
                        <!-- small box -->
                        <div class="small-box bg-green">
                            <div class="inner">
                                <p>Bônus de consumo</p>
                                <h3>R$2.300,00</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-6">
                        <!-- small box -->
                        <div class="small-box bg-yellow">
                            <div class="inner">
                                <p>Comissões da rede</p>
                                <h3>R$8.321,00</h3>
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
                                <h3>R$10.621,00</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

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
                            onclick="window.open('{{$banner->link}}', '_blank');"  @endif>
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

    </section>
    <!-- /.content -->
</div>

@stop