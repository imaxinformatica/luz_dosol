@extends('user.templates.default')

@section('title', 'Dados financeiros')

@section('description', 'Descrição')

@section('content')

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="row">
        <div class="col-sm-6">
          <h1>Dados financeiros</h1>
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
        <section class="col-lg-6">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Dados bancários</h3>
            </div>
            <form method="POST" action="#">
              {{csrf_field()}}
              <div class="box-body">
                <div class="form-group row">
                  <div class="col-xs-12">
                    <label>Nome do titular da conta</label>
                    <input type="text" class="form-control">
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-xs-12">
                    <label>CPF do titular da conta</label>
                    <input type="text" class="form-control">
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-xs-9 col-sm-4">
                    <label>Agência</label>
                    <input type="text" class="form-control">
                  </div>
                  <div class="col-xs-3 col-sm-2">
                    <label>Dígito</label>
                    <input type="text" class="form-control">
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-xs-9 col-sm-4">
                    <label>Conta corrente</label>
                    <input type="text" class="form-control">
                  </div>
                  <div class="col-xs-3 col-sm-2">
                    <label>Dígito</label>
                    <input type="text" class="form-control">
                  </div>
                </div>
              </div>
              <div class="box-footer">
                <button type="button" class="btn btn-primary">Atualizar</button>
              </div>
            </form>
          </div>
        </section>
      </div>
    </section>
  </div>

@stop