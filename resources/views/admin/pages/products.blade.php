@extends('admin.templates.default')

@section('title', 'Realizar pedido')

@section('description', 'Descrição')

@section('content')

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="row">
        <div class="col-sm-6">
          <h1>Realizar pedido</h1>
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
      <?php for ($i=0; $i < 3; $i++) { ?>
      <div class="row">
        <?php for ($j=0; $j < 4; $j++) { ?>
        <div class="col-xs-6 col-md-3">
          <div class="info-box product-box">
            <img src="{{ asset('dist/img/product.jpg')}}">
            <div class="product-body">
              <h3>Suco de uva sem conservantes</h3>
              <h4>R$20,00</h4>
            </div>
            <div class="product-footer">
              <div class="row">
                <div class="col-xs-12">
                  <button class="more-info"><i class="fa fa-info" aria-hidden="true"></i></button>
                  <button class="add-cart">ADD AO CARRINHO</button>
                </div>
              </div>
            </div>
          </div>
        </div>
        <?php } ?>
      </div>
      <?php } ?>
    </section>
    <!-- /.content -->
  </div>

@stop