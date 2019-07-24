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
        <!-- Indicators -->
        <ol class="carousel-indicators">
          <li data-target="#slider" data-slide-to="0" class="active"></li>
          <li data-target="#slider" data-slide-to="1"></li>
        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner">

          <div class="item active">
            <img src="{{ asset('dist/img/banner1.jpg')}}" alt="Slider" style="width:100%;">
          </div>

          <div class="item">
            <img src="{{ asset('dist/img/banner2.jpg')}}" alt="Slider" style="width:100%;">
          </div>
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